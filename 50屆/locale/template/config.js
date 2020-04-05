export default {
    debug: true,
    routes: './routes.js',

    shared: [
        'app',
        'request',
        'history',
        'router',
        'route',
        'alert',
    ],
    prototype: [
        'Array'
    ],
    components: [{
        tag: 'app-header',
        path: './app/components/header'
    }, {
        tag: 'app-error-messages',
        path: './app/components/error-messages'
    }, {
        tag: 'app-spinner',
        path: './app/components/spinner',
        render: true
    }],
}