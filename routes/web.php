<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Report\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    //dashboard
    Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

    //profile
    Route::get('/profile', 'Profile\ProfileController@index');
    Route::post('/editProfile', 'Profile\ProfileController@editProfile')->name('editProfile');
    Route::post('/editPassword', 'Profile\ProfileController@resetPassowrd')->name('resetPassword');

    //commitment
    Route::get('/commitment', 'Commitment\CommitmentController@index') ->name('commitment.index');
    Route::post('/addCommitment', 'Commitment\CommitmentController@addCommitment')->name('addCommitment');
    Route::post('/updateCommitment', 'Commitment\CommitmentController@updateCommitment')->name('updateCommitment');
    Route::post('/deleteCommitment', 'Commitment\CommitmentController@deleteCommitment')->name('deleteCommitment');
    Route::post('/forceCompleteCommitment', 'Commitment\CommitmentController@forceCompleteCommitment')->name('forceCompleteCommitment');

    //transaction
    Route::get('/transaction', 'Transaction\TransactionController@index') ->name('transaction.index');
    Route::post('/transactionIn', 'Transaction\TransactionController@transactionIn')->name('transaction.transactionIn');
    Route::post('/transactionOut', 'Transaction\TransactionController@transactionOut')->name('transaction.transactionOut');
    Route::post('/transactionOutByCommitment', 'Transaction\TransactionController@transactionOutByCommitment') ->name('transaction.transactionOutByCommitment');
    Route::get('/transactionOut', 'Transaction\TransactionController@transactionOutForm')->name('transaction.transactionOutForm');

    //Saving


        Route::get('/saving','Saving\SavingController@index')->name('saving.index');
        Route::post('/savingIn', 'Saving\SavingController@savingIn') ->name('saving.savingIn');
        Route::post('/savingOut', 'Saving\SavingController@savingOut')->name('saving.savingOut');



    //Setting
    Route::get('/setting', 'Setting\SettingController@index')->name('setting');

    //summary
    Route::get('/summary', 'Summary\SummaryController@index')->name('summary.index');

    //toJson
    Route::post('/tojson/commitmentList', 'ToJson\ToJsonController@commitmentList')->name('commitmentList');
    Route::get('/tojson/overviewDashboard', 'ToJson\ToJsonController@overviewDashboard')->name('overviewDashboard');
    Route::get('/tojson/graphTransactionYear', 'ToJson\ToJsonController@graphTransactionYear')->name('graphTransactionYear');
    Route::get('/tojson/chartIncomeDetail', 'ToJson\ToJsonController@chartIncomeDetail')->name('chartIncomeDetail');
    Route::get('/tojson/chartExpensesDetail', 'ToJson\ToJsonController@chartExpensesDetail')->name('chartExpensesDetail');
    Route::get('/tojson/savingFlow', 'ToJson\ToJsonController@savingFlow')->name('savingFlow');
    Route::get('/tojson/savingAndMoney', 'ToJson\ToJsonController@savingAndMoney')->name('savingAndMoney');

    Route::group([
        'prefix' => 'report/',
        'as' => 'report.'
    ], function (){

        Route::get('',[ReportController::class, 'index'])->name('index'); #report/
    });

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
});


