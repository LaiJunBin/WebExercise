export default [{
    path: '/home',
    component: './app/home'
}, {
    path: '/login',
    component: 'app/login'
}, {
    path: '*',
    redirect: '/home'
}];