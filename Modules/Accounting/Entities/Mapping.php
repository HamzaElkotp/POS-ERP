<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapping extends Model
{
    use HasFactory;

    // protected $fillable = [];
    protected $guarded = ['id'];
    protected static function newFactory()
    {
        return \Modules\Accounting\Database\factories\MappingFactory::new();
    }
}
