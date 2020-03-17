'use strict';

async function post(url, payload) {
    return fetch(url, {
        method: 'post',
        body: JSON.stringify(payload)
    }).then(res => res.json());
}

function cleanPath(path, strict = false) {
    path = path.replace(/\.\//g, '').replace(/\/\//g, '/').replace(/\/$/, '');
    return strict ? path + '/' : path;
}

function getComponentName(path) {
    return cleanPath(path).split('/').slice(-1)[0];
}

function loadComponent(component) {
    let baseURL = cleanPath(Router.baseURL + component, true);
    let scriptURL = baseURL + getComponentName(component) + '.js';
    let templateURL = baseURL + getComponentName(component) + '.html';
    return Promise.all([
        import(scriptURL).then(res => res.default),
        fetch(templateURL).then(res => res.text()).then(text => {
            let domParser = new DOMParser();
            let doc = domParser.parseFromString(text, 'text/html');
            return doc.querySelector('template');
        })
    ]).then(res => {
        let script = res[0];
        let template = res[1];
        return {
            script,
            template
        };
    });
}

function registerComponent(tag, component) {
    return loadComponent(component).then(({
        script,
        template
    }) => {
        Vue.component(tag, {
            ...script,
            template,
        });
    });
}

class History {
    constructor(app) {
        this.app = app;

        window.addEventListener('popstate', e => {
            this.app.render();
        })
    }

    to(url, data = {}) {
        history.pushState(data, null, url);
        this.app.render();
    }

    back() {
        history.back();
    }

    redirect(url, data) {
        history.replaceState(data, null, url);
        this.app.render();
    }
}

class Router {
    constructor() {
        this.routes = [];

        Router.baseURL = (document.querySelector('base') || {}).href || '';
        Router.baseURL = Router.baseURL.replace(location.origin, '');
    }

    async initialize(routes) {
        for (let route of routes) {
            await this.compileRoute(route, Router.baseURL);
        }
    }

    async compileRoute(routeParams, url, depth = 0, parent = null) {
        let action = null;
        let path = cleanPath(url + routeParams.path, true);
        let name = routeParams.name;

        if (routeParams.redirect) {
            action = app => {
                for (let route of app.router.routes) {
                    route.enable = false;
                }
                app.history.redirect(cleanPath(url + routeParams.redirect));
            }
        } else if (routeParams.component) {
            name = name || getComponentName(routeParams.component);
            await loadComponent(routeParams.component).then(({
                script,
                template
            }) => {
                action = (app, fullMatch) => {
                    let components = [app.app];

                    if (parent != null) {
                        components = (function findComponent(node, target = []) {
                            if (node.$options._componentTag === parent) {
                                target.push(node);
                                return target;
                            }

                            for (let child of node.$children) {
                                target = findComponent(child, target);
                            }
                            return target;
                        })(app.app);
                    }

                    Vue.component(name, {
                        ...script,
                        template,
                        components: {},
                        data() {
                            return {
                                view: '',
                                ...(typeof script.data === 'function' ? script.data() : script.data)
                            }
                        },
                    });

                    for (let component of components) {
                        if (fullMatch)
                            component.view = '';

                        component.view = name;
                    }
                }
            });

        }

        this.routes.push(new Route({
            name,
            path,
            action,
            depth
        }));

        if (routeParams.children) {
            for (let r of routeParams.children) {
                await this.compileRoute(r, path, depth + 1, name);
            }
        }
    }
}

class Route {
    constructor(options) {
        this.name = options.name || null;
        this.path = options.path || null;
        this.action = options.action || null;
        this.depth = options.depth || 0;
        this.enable = false;
    }
}

class App {
    constructor(router, id = "app") {
        this.selector = `#${id}`;
        this.router = router;
        this.history = new History(this);
        this.app = null;

        this.initialize();
    }

    initialize() {
        this.initComponents();
        this.installApp().then(() => {
            this.render();
        });
    }

    initComponents() {
        var app = this;

        customElements.define('app-root', class extends HTMLElement {
            constructor() {
                super();
                let id = this.getAttribute('id') || app.selector.substr(1);
                let div = document.createElement('div');
                div.id = id;
                this.replaceWith(div);
            }
        })

        Vue.component('router-link', {
            props: ['to', 'name'],
            template: `<a :href="to" @click.prevent="link(to)"><slot></slot></a>`,
            methods: {
                link: to => this.history.to(to)
            }
        });

        Vue.component('router-view', {
            props: ['name'],
            render(h) {
                return h(this.$parent.view);
            }
        });
    }

    installApp() {
        return loadComponent('app').then(({
            script,
            template
        }) => {
            this.app = new Vue({
                ...script,
                el: this.selector,
                data: {
                    view: '',
                    ...(typeof script.data === 'function' ? script.data() : script.data)
                },
                components: {},
                template
            });
        });

    }

    async render() {
        let path = cleanPath(location.pathname, true);
        let fullMatch = false;

        for (let route of this.router.routes) {
            route.enable = false;
            let regex = new RegExp(route.path);
            if (regex.test(path)) {
                fullMatch = fullMatch || route.path.length === path.length;
                if (
                    /\*\/$/.test(route.path) &&
                    this.router.routes.some(r => r.enable) &&
                    fullMatch
                )
                    continue

                route.enable = true;
            }
        }

        for (let route of this.router.routes) {
            if (route.enable && route.action) {
                await route.action(this, route.path.length === path.length);
            }
        }
    }
}

import('./routes.js').then(res => {
    let routes = res.default;
    const router = new Router();

    router.initialize(routes).then(() => {
        import('./components.js').then((initComponents) => {
            initComponents.default.then(() => {
                const app = new App(router);
            });
        });
    });
});