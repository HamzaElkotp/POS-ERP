<?php

namespace Modules\Lens\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class LenTransaction extends Model
{
    use  HasFactory;
    // use SoftDeletes;
    public $table = 'len_transaction';

    protected $fillable = [
        'quantity' ,
                'price',
                'purch_price' ,
                'lens_diam_id',
                'sph' ,
                'cyl' ,
                'sub_total',
                'disc'

    ];
}