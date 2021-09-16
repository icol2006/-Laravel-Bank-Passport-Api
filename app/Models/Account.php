<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account_number', 'name', 'current_balance', 'user_id'];

    /**
     * Retrieve the current balance divided by 100 since
     * the system stores the amount in cents
     *
     * @return float
     */
    public function getDecimalCurrentBalanceAttribute() : float {
        return $this->current_balance / 100;
    }

    /**
     * Movement relationship
     */
    public function movements() {
        return $this->hasMany(Movement::class);
    }

    /**
     * Sets the account number
     *
     * @return void
     */
    public function setAccountNumber() {
        $timestamp = nowLocal()->getTimestamp();
        $userId = $this->user_id;
        $this->account_number = "{$timestamp}{$userId}";
    }

    public  function Register(int $user_id,string $name="", int $current_balance=0) : Account {
        $this->account_number=Str::uuid();
        $this->name=$name;
        $this->current_balance=$current_balance;
        $this->user_id=$user_id;
        $this->save();

        return $this;
    }

    /**
     * Retrieves the relationship with the user
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
