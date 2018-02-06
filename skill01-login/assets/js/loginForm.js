var loginForm = document.getElementById('loginForm');
if (loginForm !== null) {
    loginForm.addEventListener('submit', function (evt) {
        var username = loginForm.username.value;
        var password = loginForm.password.value;
        var loginData = new FormData();
        loginData.append('username', username);
        loginData.append('password', password);
        req = new XMLHttpRequest();
        req.open("POST", './assets/php/login.php');
        req.onload = function () {
            alert(this.responseText);
        };
        req.send(loginData);
        evt.preventDefault();
    }, false);
}
