'use strict';

(async () => {
    const config = (await import('./config.js')).default;
    const functions = (await import('./functions.js')).default;

    if (!config.debug)
        window.console.log = () => {};

    for (let functionName in functions) {
        window[functionName] = functions[functionName];
    }

    for (let prototypeFile of config.prototype) {
        await import(`./modules/prototype/${prototypeFile}.js`);
    }

    for (let sharedModuleFile of config.shared) {
        let module = (await import(`./modules/${sharedModuleFile}.js`)).default;
        window[module.name] = module;
    }

    let routes = (await import(config.routes)).default;
    let router = new Router();
    router.initialize(routes).then(async () => {
        for (let component of config.components) {
            await registerComponent(component);
        }

        const app = new App(router);
    });
})();

// import('./routes.js').then(res => {
//     let routes = res.default;
//     const router = new Router();

//     router.initialize(routes).then(() => {
//         import('./components.js').then((initComponents) => {
//             initComponents.default.then(() => {
//                 const app = new App(router);
//             });
//         });
//     });
// });