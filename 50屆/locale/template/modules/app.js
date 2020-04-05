class App {
    constructor(router, id = "app") {
        this.selector = `#${id}`;
        this.router = router;
        this.matchRoutes = [];
        this.rendering = false;
        this.history = new History(this);
        this.request = new Request(this);
        this.alert = new Alert();
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
            props: ['to', 'redirect', 'name', 'role'],
            data() {
                return {
                    match: new RegExp(this.to).test(cleanPath(location.pathname, true))
                }
            },
            // template: `<a :class="{active: match}" :href="to" @click.prevent="link(to)"><slot></slot></a>`,
            render(h) {
                let tag = this.role || 'a';
                return h(tag, {
                    class: {
                        active: this.match
                    },
                    attrs: {
                        href: this.to,
                    },
                    on: {
                        click: e => {
                            if (typeof this.$listeners.click === 'function')
                                this.$listeners.click();

                            e.preventDefault();
                            this.link(this.to, this.redirect !== undefined && this.redirect !== false);
                        }
                    }
                }, this.$slots.default);
            },
            methods: {
                link: (to, redirect = false) => redirect ? this.history.redirect(to) : this.history.to(to)
            }
        });

        Vue.component('router-view', {
            props: ['name'],
            render(h) {
                // console.log('router-view', this, this.$parent.view);
                if (this.$parent.view === '') {
                    return h('div', {
                        class: 'fadeIn'
                    }, this.$slots.default);
                } else {
                    return h(this.$parent.view, {
                        class: 'fadeIn'
                    });
                }
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
                    route: this.history,
                    request: this.request,
                    alert: this.alert,
                    ...(typeof script.data === 'function' ? script.data() : script.data)
                },
                components: {},
                template,
            });
        });

    }

    async render() {
        this.rendering = true;
        this.app.spinner.show = true;
        console.log('start render');
        let path = cleanPath(location.pathname, true);
        let fullMatch = false;
        let lengthRecords = [];

        for (let route of this.router.routes) {
            route.enable = false;
            let currentFullMatch = route.path.split('/').length === path.split('/').length;
            let regexp = currentFullMatch ? route.fullMatchRegExp : route.pathRegExp;

            if (regexp.test(path)) {
                if (
                    /\*\/$/.test(route.path) &&
                    this.router.routes.some(r => r.enable) &&
                    fullMatch
                )
                    continue

                let len = route.path.split('/').length;
                if (!/\*\/$/.test(route.path) && lengthRecords.includes(len))
                    continue;

                lengthRecords.push(len);
                fullMatch = fullMatch || currentFullMatch;
                route.enable = true;
            }
        }

        for (let route of this.router.routes) {
            if (route.enable && route.action) {
                this.matchRoutes.push(route);
                // await route.action(this, route.path.split('/').length === path.split('/').length, route);
            }
        }

        // console.table('matchRoute', this.matchRoutes.map(x => ({
        //     path: x.path,
        //     enable: x.enable,
        //     // pathRegExp: x.pathRegExp
        // })))

        while (this.matchRoutes.length > 0) {
            let route = this.matchRoutes.shift();
            await route.action(this, route.path.split('/').length === path.split('/').length, route);
            // await (new Promise(async resolve => {
            //     setTimeout(async () => {
            //         await route.action(this, route.path.split('/').length === path.split('/').length, route);
            //         resolve();
            //     }, 1000);
            // }))
        }


        if (this.rendering && this.matchRoutes.length === 0) {
            this.rendering = false;
            (function setRouteLinkActive(node) {
                if (node.$options._componentTag === 'router-link') {
                    node.match = new RegExp(node.to).test(path);
                }

                for (let child of node.$children) {
                    setRouteLinkActive(child);
                }
            })(this.app);

            console.log('end render', path);
            if (!this.request.pending)
                this.app.spinner.show = false;

            console.log('end render show - false');
        }

        // console.table(this.router.routes.map(x => ({
        //     path: x.path,
        //     enable: x.enable,
        //     action: x.action.toString(),
        //     // pathRegExp: x.pathRegExp
        // })))

    }
}

export default App;