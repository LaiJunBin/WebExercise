class Request {
    constructor(app) {
        this.app = app;
        this.pending = false;
        this.count = 0;
    }

    async request(method, url, payload) {
        let body = method.toUpperCase() === 'GET' ? null : JSON.stringify(payload);
        this.count += 1;
        this.pending = true;
        this.app.app.spinner.show = true;
        return fetch(url, {
                method: method,
                body
            }).then(res => res.text())
            .then(res => {
                try {
                    return JSON.parse(res);
                } catch (e) {
                    return res;
                }
            }).then(res => {
                this.count -= 1;
                if (this.count === 0) {
                    this.pending = false;
                    this.app.app.spinner.show = false;
                }
                return res;
            });;
    }

    async get(url) {
        return this.request('get', url, {});
    }

    async post(url, payload) {
        return this.request('post', url, payload);
    }

    async patch(url, payload) {
        return this.request('patch', url, payload);
    }

    async delete(url) {
        return this.request('delete', url, {});
    }
}

export default Request;