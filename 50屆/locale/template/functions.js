export default {

    findComponent(node, tag, output = null) {
        if (node.$options._componentTag === tag) {
            output = node;
            return output;
        }

        for (let child of node.$children) {
            output = findComponent(child, tag, output);
        }

        return output;
    },

    cleanPath(path, strict = false) {
        path = path.replace(/\.\//g, '').replace(/\/\//g, '/').replace(/\/$/, '');
        return strict ? path + '/' : path;
    },

    getComponentName(path) {
        return cleanPath(path).split('/').slice(-1)[0];
    },

    loadComponent(component) {
        if (typeof component === 'string') {
            component = {
                path: component
            };
        }

        let baseURL = cleanPath(Router.baseURL + component.path, true);
        let scriptURL = baseURL + getComponentName(component.path) + '.js';
        let templateURL = baseURL + getComponentName(component.path) + '.html';
        let processes = [
            import(scriptURL).then(res => res.default)
        ];

        if (component.render !== true) {
            processes.push(fetch(templateURL).then(res => res.text()).then(text => {
                let domParser = new DOMParser();
                let doc = domParser.parseFromString(text, 'text/html');
                return doc.querySelector('template');
            }));
        }

        return Promise.all(processes).then(res => {
            let script = res[0];
            let template = res[1];
            return {
                script,
                template
            };
        });
    },

    registerComponent(component) {
        return loadComponent(component).then(({
            script,
            template
        }) => {
            Vue.component(component.tag, {
                ...script,
                template,
                created() {
                    if (typeof script.created === 'function')
                        script.created.apply(this);

                    Object.assign(this, this.$vnode.data.attrs);
                    this.route = this.$root.route;
                    this.request = this.$root.request;
                    this.alert = this.$root.alert;
                }
            });
        });
    },

}