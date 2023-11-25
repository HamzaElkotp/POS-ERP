<?php

namespace Modules\Lens\Entities;

use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Len extends Model
{
    use  HasFactory;
    // use SoftDeletes;
    public $table = 'lens';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lens_type',
        'signal_type_id',
        'lens_diameter_id',
        'sph_from_id',
        'sph_to_id',
        'allowed_disc',
        'notes',
        'branch_id',
        'business_id',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function signal_type()
    {
        return $this->belongsTo(Signaltype::class, 'signal_type_id');
    }

    public function lens_diameter()
    {
        return $this->belongsTo(LensDiameter::class, 'lens_diameter_id');
    }

    public function sph_from()
    {
        return $this->belongsTo(SphFrom::class, 'sph_from_id');
    }

    public function sph_to()
    {
        return $this->belongsTo(SphTo::class, 'sph_to_id');
    }

    public function len_lenses_diams()
    {
        return $this->hasMany(LensDiam::class, 'len_id','id');
    }
    public function len_lenses_diams2()
    {
        return $this->hasMany(LensDiam2::class, 'len_id','id');
    }
    public function len_lenses_diams3()
    {
        return $this->hasMany(LensDiam3::class, 'len_id','id');
    }

    // public function get_lens_diams( )
    // {
    //     $cyl = 's100';
    //     $lens_diam = LenDiams::where('len_id','=',4)
    //                         //   ->where('sph','=',$sph)
    //                         //   ->select('len_id','sph',$cyl)
    //                         ->get();
    //             //   dd( $lens_diam);
    //           return response()->json($lens_diam);
    // }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }


    // public function categoryProducts()
    // {
    //     return $this->hasMany(Product::class, 'category_id', 'id');
    // }

}