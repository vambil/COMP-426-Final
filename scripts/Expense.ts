class Expense {

    private amount: number;
    private store: string;

    constructor(amount: number, store: string) {
        this.amount = amount;
        this.store = store;
    }

    getAmount() {
        return this.amount;
    }

    getStore() {
        return this.store;
    }
}