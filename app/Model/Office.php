<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Datatable;
use App\Interfaces\DatatableInterface;

class Office extends Model implements DatatableInterface
{
    use Datatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offices';

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
    protected $datatable = ['id', 'active', 'title', 'default'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => \App\Events\Office\Updated::class,
        'created' => \App\Events\Office\Created::class,
        'deleted' => \App\Events\Office\Deleted::class,
    ];
}
