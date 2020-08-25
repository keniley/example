<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Datatable;
use App\Interfaces\DatatableInterface;

class Message extends Model implements DatatableInterface
{
    use Datatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Select column for datatable
     *
     * @var array
     */
    protected $datatable = ['id', 'created_at', 'email', 'type', 'name', 'phone', 'read_at'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => \App\Events\Message\Updated::class,
        'created' => \App\Events\Message\Created::class,
        'deleted' => \App\Events\Message\Deleted::class,
    ];
}
