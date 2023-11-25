<?php

namespace Modules\Lens\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LensDiam3 extends Model
{
    use  HasFactory;

    public $table = 'lens_diam3';

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    protected $fillable = [
        '0.00',
        '0.25',
        '0.50',
        '0.75',
        '1.00',
        '1.25',
        '0.50',
        '0.75',
        '2.00',
        '2.25',
        '2.50',
        '2.75',
        '3.00',
        '3.25',
        '3.50',
        '3.75',
        '4.00',
        '4.25',
        '4.50',
        '4.75',
        '5.00',
        '5.25',
        '5.50',
        '5.75',
        '6.00',
    ];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

    // public function len()
    // {
    //     return $this->belongsTo(Len::class, 'Len_id');
    // }
    public function len()
    {
        return $this->belongsTo(Len::class, 'Len_id');
    }

}
