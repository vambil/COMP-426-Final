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
    Child.prototype.getFunds = function () {
        return this.funds;
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
var Expense = /** @class */ (function () {
    function Expense(amount, store) {
        this.amount = amount;
        this.store = store;
    }
    Expense.prototype.getAmount = function () {
        return this.amount;
    };
    Expense.prototype.getStore = function () {
        return this.store;
    };
    return Expense;
}());
//# sourceMappingURL=Expense.js.map
var Fund = /** @class */ (function () {
    function Fund(amount, stores) {
        this.amount = amount;
        this.stores = stores;
        this.expenses = [];
    }
    Fund.prototype.getAmount = function () {
        return this.amount;
    };
    Fund.prototype.getStores = function () {
        return this.stores;
    };
    Fund.prototype.getExpenses = function () {
        return this.expenses;
    };
    Fund.prototype.addExpense = function (expense) {
        this.expenses[this.expenses.length] = expense;
        this.amount -= expense.getAmount();
    };
    return Fund;
}());
//# sourceMappingURL=Fund.js.map
var Requests = /** @class */ (function () {
    function Requests(child, fund) {
        this.child = child;
        this.fund = fund;
    }
    Requests.prototype.getChild = function () {
        return this.child;
    };
    Requests.prototype.getFund = function () {
        return this.fund;
    };
    return Requests;
}());
//# sourceMappingURL=Requests.js.map


var vibhu = new Parent();

var george = new Child(vibhu);
var tyler = new Child(vibhu);
var sahil = new Child(vibhu);
george.addBanned("Pornxxx");
george.receiveFund(new Fund(100, ["Target"]));
george.pay(new Expense(20, "Target"));
george.receiveFund(new Fund(40, ["Sex City", "Toys R Us","Target"]));
tyler.request(50,"Taco Bell");
vibhu.approveRequest(0);
george.pay(new Expense(5, "Dildo World"));
console.log(vibhu.getChildren());
console.log(vibhu.getRequests());
console.log(tyler.getFunds());
console.log(george.getBanned());
console.log(george.getApproved());
console.log(george.getFunds());