<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\DatatableInterface;
use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Model\Admin;

class AdminController extends Controller
{
    /**
     * Show list of admins
     * if request wants json, we show datatable response
     *
     * @param Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {
        if($request->wantsJson()) {
            $admin = new Admin();
            if($admin instanceof DatatableInterface) {
                $list = $admin->datatable($request);
                $list['system'] = ['code' => 200, 'message' => 'OK'];
                return response()->json($list);    
            }
        }

        return view('admin.admin-index');
    }

    /**
     * Show template for modal window
     */
    public function new()
    {
        return view('admin.modal.admin-new');
    }

    /**
     * Show detail of admin
     *
     * @param Illuminate\Http\Request $request
     * @param string $id
     */
    public function show(Request $request, string $id)
    {
        $admin = Admin::find($id);

        return view('admin.admin-show', ['admin' => $admin, 'id' => $id]);    
    }

    /**
     * Update admin
     *
     * @param App\Http\Requests\Admin\AdminUpdateRequest $request
     * @param string $id
     */
    public function update(AdminUpdateRequest $request, string $id)
    {        
        $request->flashOnly([]);

        $admin = Admin::find($id);

        if($admin) {
            $admin = $this->modify($admin, $request->validated());
            $admin->save();
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }

    /**
     * Store new admin
     *
     * @param App\Http\Requests\Admin\AdminCreateRequest $request
     */
    public function store(AdminCreateRequest $request)
    {
        $data = $request->validated();

        $admin = new Admin();
        $admin->email = $data['email'];
        $admin->name = '';
        $admin->password = '';
        $admin->save();

        return redirect('/admin/admins/'.$admin->id);
    }

    /**
     * Update logic
     *
     * @param App\Model\Admin $admin
     * @param array $data
     *
     * @return App\Model\Admin
     */
    private function modify(Admin $admin, array $data): Admin
    {
        $password = $data['password'] ?? null;

        unset($data['password']);

        $admin->fill($data);

        if($password !== '' && $password !== null) {
            $admin->password = bcrypt($password);
        }    

        return $admin;
    }
}
