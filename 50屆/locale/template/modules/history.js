class History {
    constructor(app) {
        this.app = app;

        window.addEventListener('popstate', e => {
            this.app.render();
        })
    }

    async to(url, data = {}) {
        // data['prev'] = location.pathname;
        history.pushState(data, null, url);
        console.log('to', url);
        this.app.render();
        return true;
    }

    back() {
        history.back();
    }

    async redirect(url, data = {}) {
        console.log('redirect', url);
        // data['prev'] = (history.state && history.state.prev) || location.pathname;
        history.replaceState(data, null, url);
        this.app.render();
        return true;
    }
}

export default History;