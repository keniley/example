<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UpdateMeRequest;
use App\Model\Admin;
use App\Events\Admin\LoggedIn;
use App\Events\Admin\LoggedOut;

class AuthController extends Controller
{
    /**
     * Show admin login page
     */
    public function show()
    {
        if (Auth::guard('admin')->check() === true) {
            return redirect(route('admin.home'));
        }

        return view('admin.login');        
    }

    /**
     * Login action
     *
     * @param Illuminate\Http\Request $request
     */
    public function login(Request $request)
    {
        $params = $request->all();

        if ($this->checkLogin($params)) {
            event(new LoggedIn(Auth::guard('admin')->user()));

            return response()->json(['system' => ['code' => 200, 'message' => 'OK']]);
        }

        return response()->json(['system' => ['code' => 401, 'message' => 'Unauthorized']], 401);
    }

    /**
     * Logout action
     */
    public function logout()
    {
        event(new LoggedOut(Auth::guard('admin')->user()));

        Auth::guard('admin')->logout();
        
        return redirect()->route('admin.login');
    }

    /**
     * Show my account page
     */
    public function me()
    {
        return view('admin.me', ['admin' => Auth::guard('admin')->user()]);  
    }

    /**
     * Update my account
     *
     * @param App\Http\Requests\Admin\UpdateMeRequest $request
     */
    public function updateme(UpdateMeRequest $request)
    {
        $request->flashOnly([]);

        $admin = Admin::find(Auth::guard('admin')->id());

        if($admin) {
            $data = $request->validated();
            $password = $data['password'] ?? null;

            unset($data['password']);

            $admin->fill($data);

            if($password !== '' && $password !== null) {
                $admin->password = bcrypt($password);
            }

            $admin->save();
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }

    /**
     * Login logic
     *
     * @param array $params
     *
     * @return bool
     */
    private function checkLogin(array $params): bool
    {
        return Auth::guard('admin')
                    ->attempt([
                        'email' => $params['username'], 
                        'password' => $params['password'],
                        'active' => 1,
                    ]);
    }
}
