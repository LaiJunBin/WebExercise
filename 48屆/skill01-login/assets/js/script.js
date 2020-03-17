function addScript(selector, path) {
    var node = document.querySelectorAll(selector);
    var script = document.createElement('script');
    script.src = path;
    node[0].append(script)
}
function addCSS(selector, path) {
    var node = document.querySelectorAll(selector);
    var style = document.createElement('link');
    style.setAttribute('href', path);
    style.setAttribute('rel', 'stylesheet');
    style.setAttribute('type', 'text/css')
    node[0].append(style);
}
function updateContent(selector, method, path, scripts = []) {
    req = new XMLHttpRequest();
    req.open(method, path);
    req.onload = function () {
        var node = document.querySelectorAll(selector);
        for (script of scripts) {
            addScript(selector, script);
        }
        node[0].innerHTML = this.responseText;
    };
    req.send();
}