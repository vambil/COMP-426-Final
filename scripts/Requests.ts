class Requests {

    private child: Child;
    private fund: Fund;

    constructor(child: Child, fund: Fund) {
        this.child = child;
        this.fund = fund;
    }

    getChild() {
        return this.child;
    }

    getFund() {
        return this.fund;
    }
}