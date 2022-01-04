<!DOCTYPE html>
<html lang="en">
   @include('private_master.head')
   <body>
   @include('private_master.sidebar')
   <div class="main-content">
   @include('private_master.navbar')
   @yield('top-header')
    <div class="container-fluid mt--7">
   @yield('content')
    <div class="modal fade" id="expensesModal" tabindex="-1" role="dialog" aria-labelledby="expensesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('transaction.transactionOut') }}">
                    @csrf
                    <div class="modal-body" id="transactionOut">
                        <h6 class="heading-small text-muted mb-4">Transaction OUT</h6>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Kategori</label>
{{--                                    <select class="form-control form-control-alternative" required name="kategori_id">--}}
{{--                                        <option value="">Select</option>--}}
{{--                                        @foreach($expensesList as $expenses)--}}
{{--                                            <option value="{{ $expenses->id }}">{{ $expenses->title }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Total In (RM)</label>
                                    <input type="number" step="0.01" name="total" class="form-control form-control-alternative" placeholder="Total " autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Reason</label>
                                    <input type="text" name="reason" class="form-control form-control-alternative" placeholder="Reason" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label">Date : {{ \Carbon\Carbon::today()->format('d-m-Y') }}</label>
                                </div>
                            </div>
                        </div>
                        <hr class="my-1" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('private_master.footer')
    </div>
   </div>
      @include('private_master.jscript')
        <script>
       $( document ).ready(function() {
           $('#transactionIn select').change(function(){
               var reason = $(this).find('option:selected').text();
               $("#transactionIn input[type='text']").val(reason);
           });

           $('#transactionOut select').change(function(){
               var reason = $(this).find('option:selected').text();
               $("#transactionOut input[type='text']").val(reason);
           });

           $('#commitmentId').change(function() {
               var id = $(this).val();
               if(id != ''){
                   $.ajax({
                       url:"/tojson/commitmentList",
                       method:"POST",
                       data:{
                           "_token": "{{ csrf_token() }}",
                           id:id
                       },
                       dataType:"json",
                       success:function(data){
                           if(data.unlimit == 0){
                               var gotBalance = data.balance - data.monthly;
                               $('#infoBalance').text("Your Balance: RM " + data.balance);
                               $('#commitmentInput').val((gotBalance < 0) ? data.balance : data.monthly);
                           } else{
                               $('#infoBalance').text('');
                               $('#commitmentInput').val(data.monthly);
                           }

                       }
                   });
               } else {
                   $('#commitmentInput').val('');
               }
           });
       });
   </script>
      @yield('script')
   </body>
</html>
