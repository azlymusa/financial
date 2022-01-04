<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;


class Loan extends Model
{
    use SoftDeletes;

    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'total', 'balance', 'monthly', 'status', 'recurring_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function logs(){
        return $this->hasMany(LoanLog::class, 'loan_id', 'id');
    }

    public function getBalanceStatus(){
        if($this->unlimit == 0){
            return number_format(($this->total - $this->balance) / $this->total * 100, 2);
        } else {
            return $this->total;
        }
    }

    public function getProgressbarColourAttribute()
    {

        if ($this->getBalanceStatus() <= 20) {
            return 'bg-gradient-danger';
        } elseif ($this->getBalanceStatus() >= 21 && $this->getBalanceStatus() <= 40) {
            return 'bg-gradient-warning';
        } elseif ($this->getBalanceStatus() >= 41 && $this->getBalanceStatus() <= 60){
            return 'bg-gradient-info';
        }elseif($this->getBalanceStatus() >= 61 && $this->getBalanceStatus() <= 80) {
            return 'bg-gradient-primary';
        }else{
            return 'bg-gradient-success';
        }
    }

    public function scopeSumMonthly(Builder $query){
        return $query->where('status', 1)->sum('monthly');
    }


}
