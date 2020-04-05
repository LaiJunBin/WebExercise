export default [{
    path: '/',
    beforeAction(app, fullMatch) {
        if (localStorage.user) {
            app.user = JSON.parse(localStorage.user);
        }

        if (fullMatch)
            return app.route.redirect('home');
    },
    children: [{
        path: '/home',
        component: './app/home',
        beforeAction(app) {
            if (localStorage.user) {
                app.user = JSON.parse(localStorage.user);
            }

            if (app.user.username === undefined) {
                return app.route.redirect('login');
            }
        },
        children: [{
            path: '/{id}',
            component: './app/home/test'
        }]
    }, {
        path: '/login',
        component: 'app/login',
        beforeAction(app) {
            if (localStorage.user) {
                app.user = JSON.parse(localStorage.user);
            }

            if (app.user.username !== undefined) {
                return app.route.redirect('home');
            }
        },
    }]
}, {
    path: '*',
    redirect: '/home'
}];