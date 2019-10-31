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