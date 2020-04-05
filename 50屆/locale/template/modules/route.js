class Route {
    constructor(options) {
        this.name = options.name || null;
        this.path = options.path || null;
        this.action = options.action || null;
        this.depth = options.depth || 0;
        this.enable = false;

        this.pathRegExp = options.pathRegExp || [];
        this.fullMatchRegExp = options.fullMatchRegExp || [];
        this.paramKeys = options.paramKeys || [];

    }
}

export default Route;