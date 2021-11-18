<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Http\Validators\CompanyRequestValidator;

class CompanyController extends Controller
{

    use CompanyRequestValidator;

    /**
     * Show user companies
     */
    public function index(){

  /*      return Company::where('user_id', Auth::id())->get();*/

        return Auth::user()->companies()->get();
    }


    /**
     * Add new company
     */
    public function store(Request $request)
    {

        //Validate request
        $this->validateStore($request);


        try {

            //Create new company

            Auth::user()->companies()->create([
                'title' =>  $request->title,
                'description' => $request->description,
                'phone' => $request->phone,
            ]);
         /*   $company = new Company();
            $company->title = $request->title;
            $company->description = $request->description;
            $company->phone = $request->phone;
            $company->user_id =Auth::id();
            $company->save();*/


            return response()->json(['message' => 'Successful addition of the company']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
