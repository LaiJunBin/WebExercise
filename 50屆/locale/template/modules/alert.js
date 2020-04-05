class Alert {

    constructor() {

    }

    async showMessage(message, options = {}) {
        return new Promise(resolve => {
            return this.present({
                ...options,
                messageBody: message,
                resolve
            });
        });
    }

    async confirm(message, defaultValue = false, options = {}) {
        return new Promise(resolve => {
            return this.present({
                buttonWidth: '40%',
                ...options,
                confirm: true,
                messageBody: message,
                resolve,
            });
        });
    }

    async prompt(message, defaultValue = null, options = {}) {
        var input = document.createElement('input');
        input.style.border = '1px solid #333';
        input.style.borderRadius = '3px';
        input.style.padding = '5px 3px';
        input.style.width = '80%';
        input.style.fontSize = '20px';
        input.style.marginTop = '3px';

        for (let option in options) {
            if (option in input.__proto__) {
                input[option] = options[option];
            }
        }

        return new Promise(resolve => {
            return this.present({
                padding: '0',
                ...options,
                headerText: message,
                messageBody: input,
                textAlign: 'center',
                resolve,
                callback: function () {
                    input.focus();
                }
            });
        }).then((res) => {
            if (res.type === 'success')
                res.value = +input.value || input.value || defaultValue;
            return res;
        });
    }

    present(options = {}) {
        var createButton = function (options = {}) {
            let button = document.createElement('button');
            button.innerText = options.buttonText || 'OK';
            button.style.background = '#ebbb72';
            button.style.border = '0';
            button.style.borderRadius = '5px';
            button.style.width = options.buttonWidth || '80%';
            button.style.height = '30px';
            button.style.margin = '8px';
            button.style.cursor = 'pointer';

            button.addEventListener('mouseover', function () {
                this.style.background = '#ebbb7277';
            });

            button.addEventListener('mouseleave', function () {
                this.style.background = '#ebbb72';
            });

            button.addEventListener('click', () => {
                document.removeEventListener('keydown', globalEnterEvent);
                alert.style.transform = 'scale(0)';
                setTimeout(() => {
                    ele.remove();
                    options.resolve({
                        type: 'success',
                        value: options.value
                    });
                }, 350);
            });

            return button;
        }

        let ele = document.createElement('div');
        ele.style.width = '100vw';
        ele.style.height = '100vh';
        ele.style.background = '#ddd3';
        ele.style.position = 'fixed';
        ele.style.left = 0;
        ele.style.top = 0;
        ele.style.display = 'flex';
        ele.style.alignItems = 'center';
        ele.style.justifyContent = 'center';

        let alert = document.createElement('div');
        alert.style.transform = 'scale(0)';
        alert.style.transition = 'transform .35s';
        alert.style.background = '#fff';
        alert.style.border = '1px solid #333';
        alert.style.borderRadius = '7px';
        alert.style.minWidth = '250px';
        alert.style.maxWidth = '80%';
        alert.style.minHeight = '100px';
        alert.style.fontSize = '20px';
        alert.style.textAlign = 'center';
        alert.style.position = 'fixed';

        let header = document.createElement('div');
        header.style.background = '#39f6';
        header.style.padding = '10px';
        header.style.marginBottom = '5px';
        header.style.cursor = 'grab';
        header.innerText = options.headerText || 'Message';

        let msg = document.createElement('div');
        msg.append(options.messageBody);
        msg.style.textAlign = options.textAlign || 'left';
        msg.style.padding = options.padding || '0 10px';
        msg.style.wordBreak = 'break-word';
        var buttons = [];

        if (options.confirm) {
            buttons.push(createButton(Object.assign({
                buttonText: 'Yes',
                value: true
            }, options)));
            buttons.push(createButton(Object.assign({
                buttonText: 'No',
                value: false
            }, options)));
        } else {
            buttons.push(createButton(options));
            var globalEnterEvent = function (e) {
                if (e.keyCode == 13) {
                    buttons[options.defaultButton || 0].click();
                }
            }

            document.addEventListener('keydown', globalEnterEvent)
        }

        ele.addEventListener('mousedown', function (e) {
            if (e.target === ele) {
                ele.addEventListener('mouseup', function (e) {
                    if (e.target === ele) {
                        document.removeEventListener('keydown', globalEnterEvent);
                        alert.style.transform = 'scale(0)';
                        setTimeout(() => {
                            ele.remove();
                            options.resolve({
                                type: 'cancel',
                                value: null
                            });
                        }, 350);
                    }
                }, {
                    once: true
                });
            }
        });

        header.addEventListener('mousedown', function (e) {
            header.style.cursor = 'grabbing';
            var {
                offsetX,
                offsetY
            } = e;
            var mousemoveEvent = function (e) {
                let {
                    clientX,
                    clientY
                } = e;
                alert.style.left = `${clientX - offsetX}px`;
                alert.style.top = `${clientY - offsetY}px`;
            }
            document.addEventListener('mousemove', mousemoveEvent);
            document.addEventListener('mouseup', function () {
                header.style.cursor = 'grab';
                document.removeEventListener('mousemove', mousemoveEvent);
            }, {
                once: true
            });
        });

        alert.appendChild(header);
        alert.appendChild(msg);
        for (let button of buttons)
            alert.appendChild(button);
        ele.append(alert);
        document.body.appendChild(ele);

        setTimeout(() => {
            alert.style.transform = 'scale(1)';
        }, 25);

        if (options.callback !== undefined)
            options.callback();
    }

}

export default Alert;