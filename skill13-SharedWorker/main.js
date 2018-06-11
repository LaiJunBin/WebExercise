var data = null;
var browser = [];

onconnect = function (e) {

    for (let i = 0; i < e.ports.length; i++) {
        e.ports[i].onmessage = function (e) {
            data = e.data;
            browser.forEach((port) => {
                port.postMessage(data.value);
            });
        }
        browser.push(e.ports[i]);
    }

}