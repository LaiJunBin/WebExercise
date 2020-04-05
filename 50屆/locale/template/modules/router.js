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
        let path = cleanPath(url + (routeParams.path || '/'), true);
        let name = routeParams.name;

        if (routeParams.redirect) {
            action = async app => {
                for (let route of app.router.routes) {
                    route.enable = false;
                }
                await app.history.redirect(cleanPath(url + routeParams.redirect));
            }
        } else if (routeParams.component) {
            name = name || getComponentName(routeParams.component);
            await loadComponent(routeParams.component).then(({
                script,
                template
            }) => {
                action = async (app, fullMatch, route) => {
                    return new Promise(async resolve => {
                        if (typeof routeParams.beforeAction === 'function') {
                            let res = await routeParams.beforeAction(app.app, fullMatch);

                            if (res === false)
                                return;
                        }

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

                        let paramsMap = {};
                        if (route.paramKeys.length > 0) {
                            let params = location.pathname.match(route.pathRegExp);
                            for (let i = 1; i < params.length; i++) {
                                paramsMap[route.paramKeys[i - 1]] = params[i];
                            }
                        }


                        if (name in Vue.options.components)
                            resolve();

                        Vue.component(name, {
                            ...script,
                            template,
                            components: {},
                            data() {
                                return {
                                    view: '',
                                    route: app.history,
                                    request: app.request,
                                    alert: app.alert,
                                    ...paramsMap,
                                    ...(typeof script.data === 'function' ? script.data() : script.data)
                                }
                            },

                            created() {
                                if (typeof script.created === 'function')
                                    script.created.apply(this);


                                resolve();
                            }
                        });



                        for (let component of components) {
                            if (fullMatch) {
                                component.view = '';
                            }

                            component.view = name;
                        }

                    });
                }
            });

        } else {
            action = async (app, fullMatch) => {
                return new Promise(async resolve => {

                    let components = (function findComponent(node, target = []) {
                        if (node.$options._componentTag === parent) {
                            target.push(node);
                            return target;
                        }

                        for (let child of node.$children) {
                            target = findComponent(child, target);
                        }
                        return target;
                    })(app.app);

                    if (typeof routeParams.beforeAction === 'function')
                        await routeParams.beforeAction(app.app, fullMatch);

                    resolve();
                });
            }
        }


        let pathRegExp = new RegExp(path.replace(new RegExp('{([^}]*)}', 'g'), '([^/]+)') + '?');
        let fullMatchRegExp = new RegExp(path.replace(new RegExp('{([^}]*)}', 'g'), '([^/]+)') + '?$');
        if (routeParams.path === '*') {
            pathRegExp = new RegExp(cleanPath(url + '.' + (routeParams.path || '/'), true) + '?$');
            fullMatchRegExp = new RegExp(cleanPath(url + '.' + (routeParams.path || '/'), true) + '?$');
        }

        let index = this.routes.findIndex(x => x.path === path);
        if (index !== -1)
            this.routes.splice(index, 1);

        this.routes.push(new Route({
            name,
            path,
            action,
            depth,

            pathRegExp,
            fullMatchRegExp,
            paramKeys: path.match(new RegExp(path.replace(new RegExp('{([^}]*)}', 'g'), '{(.*)}'))).slice(1),
        }));

        if (routeParams.children) {
            for (let r of routeParams.children) {
                await this.compileRoute(r, path, depth + 1, name || parent);
            }
        }
    }
}


export default Router;