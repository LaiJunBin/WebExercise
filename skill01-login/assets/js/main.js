addCSS('head', './assets/css/main.css');
req = new XMLHttpRequest();
req.open('get', './assets/html/loginForm.html');
req.onload = function () {
    var main = document.getElementById('main');
    addScript('#main', './assets/js/loginForm.js');
    main.innerHTML = this.responseText;
};
req.send();