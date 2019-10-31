class Fund {

    private amount: number;
    private stores: string[];
    private expenses: Expense[];

    constructor(amount: number, stores: string[]) {
        this.amount = amount;
        this.stores = stores;
        this.expenses = [];
    }

    getAmount() {
        return this.amount;
    }

    getStores() {
        return this.stores;
    }

    getExpenses() {
        return this.expenses;
    }

    addExpense(expense: Expense) {
        this.expenses[this.expenses.length] = expense;
        this.amount -= expense.getAmount();
    }

    addFund(fund: Fund) {
        this.amount += fund.getAmount();
    }
}