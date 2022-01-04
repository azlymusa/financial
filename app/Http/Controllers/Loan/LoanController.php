<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\CompleteRequest;
use App\Http\Requests\Loan\DeleteRequest;
use App\Http\Requests\Loan\StoreRequest;
use App\Http\Requests\Loan\UpdateRequest;
use App\Loan;
use App\LoanLog;
use App\Repositories\CashFlowRepository;
use App\TransactionLogs;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class LoanController extends Controller
{

    public function index(){

        $loans = Loan::where([
            'user_id' =>  auth()->user()->id,
            'status'  => 1
        ])->latest()
            ->paginate(5);

        $completed = Loan::where([
            'user_id' =>  auth()->user()->id,
            'status'  => 2
        ])->latest()
            ->paginate(5);

        return view('private_content.loan', compact('loans', 'completed'));
    }

    public function store(StoreRequest $request){

        $loan          = new Loan();
        $loan->user_id = auth()->user()->id;
        $loan->title   = $request->title;
        $loan->recurring_at = $request->recurring_at;
        $loan->total   = $request->total;
        $loan->balance = $request->balance;
        $loan->monthly = $request->monthly;
        $loan->status  = 1;
        $loan->save();

        $loan = strip_tags($loan->title);
        Alert::success($loan, "Loan Added");
        return redirect()->back();
    }

    public function update(UpdateRequest $request){

        $loan = Loan::where('user_id', auth()->user()->id)->findOrFail($request->id);

        $loan->title = $request->title;
        $loan->recurring_at = $request->recurring_at;
        $loan->total = $request->total;
        $loan->balance = $request->balance;
        $loan->monthly = $request->monthly;
        $loan->save();

        $title = strip_tags($loan->title);
        Alert::success($title, 'Loan Updated');
        return redirect()->back();
    }

    public function delete(DeleteRequest $request){

        $loan = Loan::where('user_id', auth()->user()->id)->findOrFail($request->id);
        $loan->delete();

        $title = strip_tags($loan->title);
        Alert::success($title, 'Loan Deleted');
        return redirect()->back();
    }

    public function complete(CompleteRequest $request){

        $loan = Loan::where('user_id', auth()->user()->id)->findOrFail($request->id);
        $loan->status = 2;
        $loan->save();

        $title = strip_tags($loan->title);
        Alert::success($title, 'Commitment Force Complete');
        return redirect()->back();
    }

    public function testRun(){
        return self::run();
    }

    public static function run(){

        $loans    = Loan::where('status', 1)->get();
        $inserted = 0;

        foreach ($loans as $loan){

            $date =  Carbon::parse(date('Y').'-'.date('m').'-'.$loan->recurring_at);

            if($date->isPast()){
                $check = $loan->logs()
                    ->whereMonth('date', date('m'))
                    ->whereYear('date', date('Y'))
                    ->first();

                #insert dat
                if(!$check){

                    $inserted++;

                    $balance = $loan->balance - $loan->monthly;
                    $balance = ($balance < 0) ? 0 : $balance;

                    $log           = new LoanLog();
                    $log->loan_id  = $loan->id;
                    $log->date     = $date;
                    $log->total    = $loan->monthly;
                    $loan->balance = $log->balance = $balance;

                    $log->save();
                    $loan->save();

                    $transaction              = new TransactionLogs;
                    $transaction->user_id     = $loan->user_id;
                    $transaction->log_reason  = $loan->title;
                    $transaction->log_rm      = $loan->monthly;
                    $transaction->kategori_id = 4;
                    $transaction->save();


                    $cfr = new CashFlowRepository();
                    $cfr->moneyTrigger(false, $loan->monthly,$loan->user_id);

                    if($balance == 0){
                        $loan->status = 2;
                        $loan->save();
                    }
                }
            }
        }

        return json_encode(['total inserted' => $inserted]);

    }
}
