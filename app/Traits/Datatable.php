<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

trait Datatable
{
    public function datatable(Request $request): array
    {
        $params = $this->convertDatatable($request);
        
        $query = DB::table($this->table)->select($this->getSelect());
        $metadata['count'] = $query->count();
        $metadata['selected'] = $metadata['count'];
        $metadata['page'] = $params['page'];
        $metadata['order'] = ['column' => $params['order']['column'], 'type' => $params['order']['type']];
        $metadata['limit'] = $params['limit'];
        $where = [];

        if(array_key_exists('filter', $params) && !empty($params['filter'])) {
            foreach($params['filter'] as $key => $item) {
                $subkey = key($item);
                $where[] = $this->prepareWhere($key, $subkey, $item[$subkey]);
            }
            $query = $query->where($where);
        }
        if(!empty($where)) {
            $metadata['selected'] = $query->count();    
        }
        
        $metadata['pages'] = ceil($metadata['selected'] / $metadata['limit']);

        $query = $query->orderBy($params['order']['column'], $params['order']['type']);

        $skip = ($params['page'] * $params['limit']) - $params['limit'];
        $query = $query->skip($skip)->take($params['limit']);

        $data = $query->get();
        
        return [
            'metadata' => $metadata,
            'data' => $data
        ];
    }

    private function prepareWhere($column, $rule, $value)
    {
        if($rule === 'like') {
            $value = '%'.$value.'%';
        }
        
        return [$column, $rule, $value];
    }

    private function getSelect()
    {
        if(property_exists($this, 'datatable') && is_array($this->datatable)) {
            return $this->datatable;
        }

        return ['*'];
    }

    protected function convertDatatable(Request $request): array
    {
        $array = $request->validate([
            'limit' => 'required|numeric',
            'page' => 'required|numeric|min:1',
            'order.column'   => 'required',
            'order.type'   => 'required|in:asc,desc',
            'filter'   => 'required|array',
        ]);

        foreach($array['filter'] as $mainKey => $mainItem) {
            if($mainKey !== 'search') {
                foreach($mainItem as $key => $item) {
                    if($item === '_all') {
                        unset($array['filter'][$mainKey]);
                    }
                }    
            }
        }
        
        if($array['filter']['search']['like'] !== '' && $array['filter']['search']['like'] !== null) {
            $key = $array['filter']['search']['where'];
            $array['filter'][$key] = [];
            $array['filter'][$key]['like'] = $array['filter']['search']['like'];
        }

        unset($array['filter']['search']);
        
        return $array;
    }
}
