<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\AssignOp\Mod;
use Titan\Models\TitanCMSModel;
use Titan\Models\Traits\ModifyBy;

/**
 * Class Document
 * @mixin \Eloquent
 */
class Document extends Model
{
    use SoftDeletes, ModifyBy;

    protected $table = 'documents';

    protected $guarded = ['id'];

    public function documentable()
    {
        return $this->morphTo();
    }
}