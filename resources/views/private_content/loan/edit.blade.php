<div class="modal fade" id="updateLoanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('loan.update') }}">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-4">Edit Loan</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Loan</label>
                                    <input type="text" name="title" id="forTitle" class="form-control form-control-alternative" placeholder="Loan" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="recurring_at">Recurring Date</label>
                                    <select id="forRecurring" name="recurring_at" class="form-control form-control-alternative" >
                                        @foreach(range(1, 30) as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4" id="updateTotal">
                                <div class="form-group">
                                    <label class="form-control-label">Total</label>
                                    <input type="number" name="total" step=0.01 id="forTotal" class="form-control form-control-alternative" placeholder="Total " autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-4" id="updateBalance">
                                <div class="form-group">
                                    <label class="form-control-label">Balance</label>
                                    <input type="number" name="balance" step=0.01 id="forBalance" class="form-control form-control-alternative" placeholder="Balance " autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-4" id="updateMonthly">
                                <div class="form-group" >
                                    <label class="form-control-label">Monthly</label>
                                    <input type="number" name="monthly" step=0.01 id="forMonthly" class="form-control form-control-alternative" placeholder="Monthly" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1" />
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="forId" >
                    <input type="hidden" name="limit" id="forLimit">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
