<?php

namespace Modules\Accounting\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountingAccountType extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getAccountTypeNameAttribute()
    {
        $name = !empty($this->business_id) ? $this->name : __('accounting::lang.' . $this->name);

        return $name;
    }

    public function getAccountTypeDescriptionAttribute()
    {
        if (empty($this->descriptiion)) {
            return '';
        }

        $descriptiion = !empty($this->business_id) ?
            $this->descriptiion : __('accounting::lang.' . $this->descriptiion);

        return $descriptiion;
    }

    /**
     * Get the parent of the type
     */
    public function parent()
    {
        return $this->belongsTo('Modules\Accounting\Entities\AccountingAccountType', 'parent_id', 'id');
    }

    public static function accounting_primary_type()
    {
        $accounting_primary_type = [
            'asset' => ['id' => 1, 'label' => __('accounting::lang.asset')],
            'liability' => ['id' => 2, 'label' => __('accounting::lang.liability')],

            'expenses' => ['id' => 3, 'label' => __('accounting::lang.expenses')],
            'income' => ['id' => 4, 'label' => __('accounting::lang.income')],
            'equity' => ['id' => 5, 'label' => __('accounting::lang.equity')],
        ];

        return $accounting_primary_type;
    }
}