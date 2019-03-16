<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ManyToManyRoleUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ManyToManyRoleUser';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ManyToManyRoleUserId';

}
