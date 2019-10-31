var Child = /** @class */ (function () {
    function Child(parent) {
        this.parent = parent;
        this.funds = [];
        this.banned = [];
        this.approved = [];
        this.parent.addChild(this);
    }
    Child.prototype.request = function (amount, stores) {
        this.parent.receiveRequest(new Requests(this, new Fund(amount, stores)));
    };
    Child.prototype.receiveFund = function (fund) {
        this.funds[this.funds.length] = fund;
    };
    Child.prototype.getBanned = function () {
        return this.banned;
    };
    Child.prototype.getApproved = function () {
        return this.approved;
    };
    Child.prototype.getTotalAmount = function () {
        var total = 0;
        for (var i = 0; i < this.funds.length; i++) {
            total += this.funds[i].getAmount();
        }
        return total;
    };
    Child.prototype.getAllExpenses = function () {
        var all = [];
        for (var i = 0; i < this.funds.length; i++) {
            all.concat(this.funds[i].getExpenses());
        }
        return all;
    };
    Child.prototype.addBanned = function (store) {
        this.removeApproved(store);
        this.removeBanned(store);
        this.banned[this.banned.length] = store;
    };
    Child.prototype.addApproved = function (store) {
        this.removeApproved(store);
        this.removeBanned(store);
        this.approved[this.approved.length] = store;
    };
    Child.prototype.removeBanned = function (store) {
        for (var i = 0; i < this.banned.length; i++) {
            if (this.banned[i] === store) {
                this.banned.splice(i, 1);
            }
        }
    };
    Child.prototype.removeApproved = function (store) {
        for (var i = 0; i < this.approved.length; i++) {
            if (this.approved[i] === store) {
                this.approved.splice(i, 1);
            }
        }
    };
    Child.prototype.pay = function (expense) {
        var best_Fund = [];
        for (var i = 0; i < this.funds.length; i++) {
            if (this.acceptableFund(this.funds[i], expense)) {
                if (best_Fund.length === 0) {
                    best_Fund[0] = this.funds[i];
                }
                else if (this.funds[i].getStores().length < best_Fund[0].getStores().length) {
                    best_Fund[0] = this.funds[i];
                }
                else if (this.funds[i].getStores().length === best_Fund[0].getStores().length && this.funds[i].getAmount() >= best_Fund[0].getAmount()) {
                    best_Fund[0] = this.funds[i];
                }
            }
        }
        if (best_Fund.length === 0) {
            return false;
        }
        best_Fund[0].addExpense(expense);
        return true;
    };
    Child.prototype.acceptableFund = function (fund, expense) {
        if (fund.getStores().length === 0) {
            return fund.getAmount() >= expense.getAmount() && this.banned.indexOf(expense.getStore()) === -1;
        }
        return fund.getAmount() >= expense.getAmount() && fund.getStores().indexOf(expense.getStore()) >= 0;
    };
    return Child;
}());
//# sourceMappingURL=Child.js.map