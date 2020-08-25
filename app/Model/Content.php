<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Datatable;
use App\Interfaces\DatatableInterface;
use App\Model\Url;

class Content extends Model implements DatatableInterface
{
    use Datatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contents';

    protected $datatable = ['id', 'active', 'title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'title', 'body', 'seo_description', 'seo_title', 'create_admin_id', 'update_admin_id'];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => \App\Events\Conent\Created::class,
        'deleted' => \App\Events\Conent\Deleted::class,
    ];

    public function historyUrls()
    {
        return Url::where([
            ['object_id','=',$this->id],
            ['controller','=','ContentController'],
            ['is_historic', '=', 1]
        ])->orderBy('created_at', 'desc')->get();
    }

    public function activeUrl()
    {
        return Url::where([
            ['object_id','=',$this->id],
            ['controller','=','ContentController'],
            ['is_historic', '=', 0]
        ])->first();
    }

    public function adminCreate()
    {
        return $this->hasOne('App\Model\Admin', 'id', 'create_admin_id');
    }

    public function adminUpdate()
    {
        return $this->hasOne('App\Model\Admin', 'id', 'update_admin_id');
    }
}
