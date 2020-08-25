<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Larapp\Options\Model\Option;
use App\Events;

class SettingsController extends Controller
{
    /**
     * Show lits of options
     */
    public function index()
    {
        return view('admin.settings-index');
    }

    /**
     * Update options
     *
     * @param Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $options = $request->only('options');

        foreach($options['options'] as $option => $value) {
            $model = Option::find($option);
            if($model) {
                $model->value = $value;
                $model->save();
                event(new Events\Options\RowUpdated($model));
            }
        }

        event(new Events\Options\AllUpdated());

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);

    }
}
