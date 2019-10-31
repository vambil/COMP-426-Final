class Parent {

    private children: Child[];
    private requests: Requests[];

    constructor() {
        this.children = [];
        this.requests = [];
    }

    getChildren() {
        return this.children;
    }

    getRequests() {
        return this.requests;
    }

    addChild(child: Child) {
        this.children[this.children.length] = child;
        this.updateTables();
    }

    removeChild(child: Child) {
        for (let i = 0; i < this.children.length; i++) {
            if (this.children[i] === child) {
                this.children.splice(i,1);
            }
        }
        this.updateTables();
    }

    sendFund(child: Child, fund: Fund) {
        child.receiveFund(fund);
    }

    receiveRequest(request: Requests) {
        this.requests[this.requests.length] = request;
        this.updateTables();
    }

    approveRequest(index: number) {
        let request: Requests = this.requests[index];
        request.getChild().receiveFund(request.getFund());
        this.requests.splice(index, 1);
        this.updateTables();
    }

    denyRequest(index: number) {
        this.requests.splice(index,1);
        this.updateTables();
    }

    notify(child: Child, store: string) {
        child.addApproved(store);
    }

    updateTables() {
        
    }
}