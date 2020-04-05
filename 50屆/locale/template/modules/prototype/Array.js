Array.prototype.copy = function () {
    return JSON.parse(JSON.stringify(this));
}

Array.prototype.sum = function () {
    return this.reduce((a, b) => (+a) + (+b), 0);
}

Array.prototype.random = function () {
    return this[Math.floor(Math.random() * this.length)];
}