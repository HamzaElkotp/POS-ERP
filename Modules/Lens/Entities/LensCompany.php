<?php

namespace Modules\Lens\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;
use Sqits\UserStamps\Concerns\HasUserStamps;

class LensCompany extends Model
{
    use HasFactory;
    use HasUserStamps;

    public $table = 'lens_companies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function lensCompProducts()
    {
        return $this->hasMany(Product::class, 'lens_comp_id', 'id');
    }
    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::deleting(function($item) {
    //         $relationMethods = ['orders','mony_exports','mony_imports','orders_return'];
    
    //         foreach ($relationMethods as $relationMethod) {
    //             if ($item->$relationMethod()->count() > 0) {
                   
    //                 return false;
    //              //  return redirect()->back()->with('success', 'Data Added successfully.');
    //             }
    //         }
    //     });
    // }

}
