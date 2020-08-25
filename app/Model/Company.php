<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Datatable;
use App\Interfaces\DatatableInterface;

class Company extends Model implements DatatableInterface
{
    use Datatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
    protected $datatable = ['id', 'active', 'title', 'type', 'default'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'updated' => \App\Events\Company\Updated::class,
        'created' => \App\Events\Company\Created::class,
        'deleted' => \App\Events\Company\Deleted::class,
    ];
}
