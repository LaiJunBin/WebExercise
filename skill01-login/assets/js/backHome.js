var backHomeButton = document.getElementById('backHomeButton');
if (backHomeButton != null) {
    backHomeButton.addEventListener('click', function () {
        req = new XMLHttpRequest();
        req.open('get', './assets/html/loginForm.html');
        req.onload = function () {
            var main = document.getElementById('main');
            addScript('#main', './assets/js/loginForm.js');
            main.innerHTML = this.responseText;
        };
        req.send();
    }, false);
}