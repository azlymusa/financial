<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loan\CompleteRequest;
use App\Http\Requests\Loan\DeleteRequest;
use App\Http\Requests\Loan\StoreRequest;
use App\Http\Requests\Loan\UpdateRequest;
use App\Loan;
use http\Env\Request;
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
}
