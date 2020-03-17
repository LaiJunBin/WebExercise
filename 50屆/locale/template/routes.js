export default [{
    path: '/home',
    component: './app/home',
    children: [{
        path: '/route-test',
        component: './app/home/test'
    }]
}, {
    path: '/login',
    component: 'app/login'
}, {
    path: '*',
    redirect: '/home'
}];