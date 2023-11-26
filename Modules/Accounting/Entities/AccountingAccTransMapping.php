<?php

namespace Modules\Accounting\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountingAccTransMapping extends Model
{
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}

