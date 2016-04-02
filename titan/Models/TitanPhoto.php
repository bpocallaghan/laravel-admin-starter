<?php

namespace Titan\Models;

use Illuminate\Database\Eloquent\Model;

class TitanPhoto extends Model
{
    protected $guarded = ['id'];

    protected $baseDir = 'uploads/images';
}