var Parent = /** @class */ (function () {
    function Parent() {
        this.children = [];
        this.requests = [];
    }
    Parent.prototype.getChildren = function () {
        return this.children;
    };
    Parent.prototype.getRequests = function () {
        return this.requests;
    };
    Parent.prototype.addChild = function (child) {
        this.children[this.children.length] = child;
    };
    Parent.prototype.removeChild = function (child) {
        for (var i = 0; i < this.children.length; i++) {
            if (this.children[i] === child) {
                this.children.splice(i, 1);
            }
        }
    };
    Parent.prototype.sendFund = function (child, fund) {
        child.receiveFund(fund);
    };
    Parent.prototype.receiveRequest = function (request) {
        this.requests[this.requests.length] = request;
    };
    Parent.prototype.approveRequest = function (index) {
        var request = this.requests[index];
        request.getChild().receiveFund(request.getFund())
        this.requests.splice(index, 1);;
    };
    Parent.prototype.denyRequest = function (index) {
        this.requests.splice(index, 1);
    };
    return Parent;
}());
//# sourceMappingURL=Parent.js.map