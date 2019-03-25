<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManyToManyPolyRelationTaggle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ManyToManyPolyRelationTaggle';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ManyToManyPolyRelationTaggleId';
}
