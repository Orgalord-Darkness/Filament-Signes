<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class OrderScope implements Scope
{
    public function __construct($fieldName, $order = 'ASC')
    {
        // $this->fieldName = $fieldName;
        // $this->order = $order;
    }
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // if (is_array($this->fieldName)) {
        //     foreach ($this->fieldName as $field) {
        //         $builder->orderBy($field, $this->order);
        //     }
        // } else {
        //     $builder->orderBy($this->fieldName, $this->order);
        // }
    }
}