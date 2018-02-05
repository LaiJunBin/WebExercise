document.title = '登入';
var loginForm = document.getElementById('loginForm');
var joinMemberFormButton = document.getElementById('joinMemberFormButton');
if (loginForm !== null) {
    loginForm.addEventListener('submit', function (evt) {
        evt.preventDefault();
    }, false);
}
if (joinMemberFormButton != null) {
    joinMemberFormButton.addEventListener('click', function () {
        req = new XMLHttpRequest();
        req.open('get', './assets/html/joinMemberForm.html');
        req.onload = function () {
            var main = document.getElementById('main');
            document.title = '註冊';
            main.innerHTML = this.responseText;
            addScript('#main', './assets/js/join.js');
            addScript('#main', './assets/js/backHome.js');
        };
        req.send();
    }, false);
}
