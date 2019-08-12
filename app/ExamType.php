<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $table="examtypes";
    protected $fillable = ['title', 'description', 'status'];
}
