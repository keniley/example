<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alerts';

    /**
     * Primary key name
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Set primary key incrementing to false
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Set primary key type
     *
     * @var string
     */
    protected $keyType = 'string';
}
