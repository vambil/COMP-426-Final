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