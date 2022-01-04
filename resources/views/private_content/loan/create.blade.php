<div class="modal fade" id="addLoan" tabindex="-1" role="dialog" aria-labelledby="addLoanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('loan.store') }}">
                @csrf
                <div class="modal-body">
                    <h6 class="heading-small text-muted mb-4">Loan details</h6>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Loan</label>
                                <input type="text" name="title" class="form-control form-control-alternative" placeholder="Loan" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Recurring Date</label>
                                <select name="recurring_at" class="form-control form-control-alternative" >
                                    @foreach(range(1, 30) as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4" id="boxTotal">
                            <div class="form-group">
                                <label class="form-control-label">Total</label>
                                <input type="number" name="total" step=0.01 class="form-control form-control-alternative" placeholder="Total " autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4" id="boxBalance">
                            <div class="form-group">
                                <label class="form-control-label">Balance</label>
                                <input type="number" name="balance" step=0.01 class="form-control form-control-alternative" placeholder="Balance " autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-4" id="boxMonthly">
                            <div class="form-group">
                                <label class="form-control-label">Monthly</label>
                                <input type="number" name="monthly" step=0.01 class="form-control form-control-alternative" placeholder="Monthly" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1" />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="limit" id="inputLimit" value="0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
