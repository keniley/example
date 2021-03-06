<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GdprAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gdpr_actions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
