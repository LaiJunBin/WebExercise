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