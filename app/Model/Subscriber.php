<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => \App\Events\Subscriber\Updated::class,
        'created' => \App\Events\Subscriber\Created::class,
        'deleted' => \App\Events\Subscriber\Deleted::class,
    ];
}
