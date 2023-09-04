<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\staffs;
use App\Model\branches;
use App\Model\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
class staffsController extends Controller
{
    public function index()
    {
        $branches = branches::all();
        return view('admin-views.staffs.index', compact('branches'));
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request->search;

        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $staffs = staffs::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('sub_name', 'like', "%{$value}%")
                        ->orWhere('sub_code', 'like', "%{$value}%")
                        ->orWhere('department', 'like', "%{$value}%")
                        ->orWhere('year', 'like', "%{$value}%")
                        ->orWhere('publication', 'like', "%{$value}%");
                }
                    });
                    $query_param = ['search' => $request->search];
                } else {
                    $staffs = staffs::query();
                }
                
                $staffss = $staffs->with('branches')->latest()->paginate(Helpers::getPagination())->appends($query_param);
        
                return view('admin-views.staffs.list', compact('staffss', 'search'));
            }

     public function preview($id)
     {
        $staffs = staffs::where('id', $id)->first();
        return view('admin-views.staffs.view', compact('staffs'));
    }

    public function store(Request $request)
    {

        $staffs = new staffs();
        $staffs->name = $request->name;
        $staffs->email = $request->email;
        $staffs->mobile = $request->mobile;
        $staffs->password = $request->password;
        $staffs->salary = $request->salary;
        $staffs->dob = $request->dob;
        $staffs->bank_name = $request->bank_name;
        $staffs->branch = $request->branch;
        $staffs->bank_account_number = $request->bank_account_number;
        $staffs->ifsc_code = $request->ifsc_code;
        $staffs->balance = $request->balance;
        $staffs->earn = $request->earn;
        $staffs->incentives = $request->incentives;
        $staffs->branch_id = $request->branch_id;
        $staffs->save();

        Toastr::success(translate('staffs added successfully!'));
        return redirect('admin/staffs/list');
    }

    public function edit($id)
    {
        $staffs = staffs::find($id);
        $branches = branches::pluck('name', 'id');
        return view('admin-views.staffs.edit', compact('staffs', 'branches'));
    }

    public function update(Request $request, $id)
    {
      

        $staffs = staffs::findOrFail($id);
        $staffs->name = $request->name;
        $staffs->email = $request->email;
        $staffs->mobile = $request->mobile;
        $staffs->password = $request->password;
        $staffs->salary = $request->salary;
        $staffs->dob = $request->dob;
        $staffs->bank_name = $request->bank_name;
        $staffs->branch = $request->branch;
        $staffs->bank_account_number = $request->bank_account_number;
        $staffs->ifsc_code = $request->ifsc_code;
        $staffs->balance = $request->balance;
        $staffs->earn = $request->earn;
        $staffs->incentives = $request->incentives;
        $staffs->branch_id = $request->branch_id;
        $staffs->save();

        Toastr::success(translate('staffs details updated successfully!'));
        return redirect('admin/staffs/list');
    }

    public function delete(Request $request)
    {
        $staffs = staffs::findOrFail($request->id);
        $staffs->delete();

        Toastr::success(translate('staffs deleted successfully!'));
        return back();
    }
}
