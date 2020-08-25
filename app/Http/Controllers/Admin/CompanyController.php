<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyUpdateRequest;
use App\Model\Company;

class CompanyController extends Controller
{
    /**
     * Show detail of company
     *
     * @param Illuminate\Http\Request $request
     */
    public function show(Request $request)
    {
        $company = Company::find(1);

        return view('admin.company-show', ['company' => $company]);
    }

    /**
     * Update company
     *
     * @param App\Http\Requests\Admin\CompanyUpdateRequest $request
     */
    public function update(CompanyUpdateRequest $request)
    {
        $request->flashOnly([]);

        $company = Company::find(1);

        if($company) {
            $data = $request->validated();
            $company->fill($data);
            $company->save();
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }
}
