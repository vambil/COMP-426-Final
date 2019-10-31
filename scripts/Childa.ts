class Child {

    private parent: Parent;
    private funds: Fund[];
    private banned: string[];
    private approved: string[];

    constructor(parent: Parent) {
        this.parent = parent;
        this.funds = [];
        this.banned = [];
        this.approved = [];

        this.parent.addChild(this);
    }

    request(amount: number, stores: string[]) {
        this.parent.receiveRequest(new Requests(this, new Fund(amount, stores)));
    }

    receiveFund(fund: Fund) {
        for (let i = 0; i < this.funds.length; i++) {
            if (this.funds[i].getStores() === fund.getStores()) {
                this.funds[i].addFund(fund);
                return;
            }
        }

        this.funds[this.funds.length] = fund;
        this.updateTables();
    }

    getParent() {
        return this.parent;
    }

    getFunds() {
        return this.funds;
    }

    getBanned() {
      return this.banned;
    }

    getApproved() {
      return this.approved;
    }

    getTotalAmount() {
        let total: number = 0;
        for (let i = 0; i < this.funds.length; i++) {
            total += this.funds[i].getAmount();
        }
        return total;
    }

    getAllExpenses() {
        let all: Expense[] = [];
        for (let i = 0; i < this.funds.length; i++) {
            all.concat(this.funds[i].getExpenses());
        }
        return all;
    }

    addBanned(store: string) {
        this.removeApproved(store);
        this.removeBanned(store);
        this.banned[this.banned.length] = store;
        this.updateTables();
    }

    addApproved(store: string) {
        this.removeApproved(store);
        this.removeBanned(store);
        this.approved[this.approved.length] = store;
        this.updateTables();
    }

    removeBanned(store: string) {
        for (let i = 0; i < this.banned.length; i++) {
            if (this.banned[i] === store) {
                this.banned.splice(i,1);
            }
        }
        this.updateTables();
    }

    removeApproved(store: string) {
        for (let i = 0; i < this.approved.length; i++) {
            if (this.approved[i] === store) {
                this.approved.splice(i,1);
            }
        }
        this.updateTables();
    }
    removeFundAmount(amount: number) {
        for (let i = 0; i < this.funds.length; i++) {
            if (this.funds[i].getAmount() === amount) {
                this.funds.splice(i,1);
                i=i-1;
            }
        }
        this.updateTables();
    }
    pay(expense: Expense) {
        if (this.banned.indexOf(expense.getStore()) >= 0) {
            return false;
        }
        if (this.approved.indexOf(expense.getStore()) === -1) {
            this.parent.notify(this, expense.getStore());
            for (let i = 0; i < this.funds.length; i++) {
                if (this.funds[i].getStores.length === 0) {
                    if (this.funds[i].getAmount() < expense.getAmount()) {
                        return false;
                    }
                    this.funds[i].addExpense(expense);
                    this.updateTables();
                    return true;
                }
            }
            return false;
        } else {
            let best_fund: Fund[] = [];
            for (let i = 0; i < this.funds.length; i++) {
                let totalpossible: number = 0;
                if (this.funds[i].getStores().indexOf(expense.getStore()) >= 0) {
                    if (best_fund.length === 0) {
                        best_fund[0] = this.funds[i];
                        totalpossible += this.funds[i].getAmount();
                    }
                    else if (this.funds[i].getStores().length < best_fund[0].getStores().length) {
                        best_fund[0] = this.funds[i];
                        totalpossible += this.funds[i].getAmount();
                    }
                    else if (this.funds[i].getStores().length > best_fund[0].getStores().length) {
                        totalpossible += this.funds[i].getAmount();
                    }
                    else if (this.funds[i].getStores().length === best_fund[0].getStores().length && this.funds[i].getAmount() < best_fund[0].getAmount()) {
                        totalpossible += this.funds[i].getAmount();
                    }
                    else if (this.funds[i].getStores().length === best_fund[0].getStores().length && this.funds[i].getAmount() >= best_fund[0].getAmount()) {
                        best_fund[0] = this.funds[i];
                        totalpossible += this.funds[i].getAmount();
                        if (totalpossible < expense.getAmount()) {
                            return false
                        }
                        if (best_fund[0].getAmount() < expense.getAmount()) {
                            best_fund[0].addExpense(expense);
                            let new_Fund: Fund = new Fund(-best_fund[0].getAmount(),best_fund[0].getStores());
                            expense.addFund(new_Fund);
                            i=-1;
                            best_fund=[];
                        }
                    }
                }
            }
            if (best_fund.length === 0) {
                return false;
            }
            best_fund[0].addExpense(expense);
            this.removeFundAmount(0);
            return true;
        }
    }

    updateTables() {

    }
}