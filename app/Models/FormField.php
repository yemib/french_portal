<?php

// app/Models/FormField.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
   
    protected $guarded = [];

    protected $casts = [
        'required' => 'boolean',
    ];

    public function group()
    {
        return $this->belongsTo(FieldGroup::class, 'field_group_id');
    }
}
