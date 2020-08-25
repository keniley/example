<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\OfficeUpdateRequest;
use App\Http\Requests\Admin\OfficeCreateRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\DatatableInterface;
use App\Model\Office;

class OfficeController extends Controller
{
    /**
     * Show list of offices
     * if request wants json, we show datatable response
     *
     * @param Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {
        if($request->wantsJson()) {
            $office = new Office();
            if($office instanceof DatatableInterface) {
                $list = $office->datatable($request);
                $list['system'] = ['code' => 200, 'message' => 'OK'];
                return response()->json($list);    
            }
        }

        return view('admin.office-index');
    }

    /**
     * Show template for modal window
     */
    public function new()
    {
        return view('admin.modal.office-new');
    }

    /**
     * Show detail of office
     *
     * @param Illuminate\Http\Request $request
     * @param string $id
     */
    public function show(Request $request, string $id)
    {
        $office = Office::find($id);

        return view('admin.office-show', ['office' => $office, 'id' => $id]);
    }

    /**
     * Update office
     *
     * @param App\Http\Requests\Admin\OfficeUpdateRequest $request
     * @param string $id
     */
    public function update(OfficeUpdateRequest $request, string $id)
    {
        $request->flashOnly([]);

        $office = Office::find($id);

        if($office) {
            $data = $request->validated();
            $office->fill($data);
            $office->save();
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }

    /**
     * Store new office
     *
     * @param App\Http\Requests\Admin\OfficeCreateRequest $request
     */
    public function store(OfficeCreateRequest $request)
    {
        $data = $request->validated();
        $office = new Office();
        $office->title = $data['title'];
        $office->map = '';
        $office->save();

        return redirect('/admin/office/'.$office->id);
    }
}
