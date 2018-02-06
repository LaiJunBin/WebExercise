addCSS('head', './assets/css/main.css');
window.onhashchange = function () {
    route = location.hash.replace('#/', '');
    switch (route) {
        case '':
        case 'login':
            document.title = '登入';
            updateContent('#main', 'get', './assets/html/loginForm.html', ['./assets/js/loginForm.js']);
            break;
        case 'join':
            document.title = '註冊';
            updateContent('#main', 'get', './assets/html/joinMemberForm.html',
                ['./assets/js/loginForm.js', './assets/js/join.js']);
            break;
        case 'search':
            document.title = '查詢';
            updateContent('#main', 'get', './assets/html/search.html', ['./assets/js/search.js']);
            break;
        default:
            updateContent('#main', 'get', './assets/html/error404.html');
            break;

    }
}
window.onhashchange();