<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\branches;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class branchesController extends Controller
{
    public function index()
    {
        return view('admin-views.branches.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $branches = branches::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('sub_name', 'like', "%{$value}%")
                        ->orWhere('sub_code', 'like', "%{$value}%")
                        ->orWhere('department', 'like', "%{$value}%")
                        ->orWhere('year', 'like', "%{$value}%")
                        ->orWhere('publication', 'like', "%{$value}%");

                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $branches = new branches();
        }

        $branchess = $branches->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.branches.list', compact('branchess', 'search'));
    }

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $branches = branches::where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%")
    //                 ->orWhere('mobile', 'like', "%{$value}%")
    //                 ->orWhere('email', 'like', "%{$value}%")
    //                 ->orWhere('vehicle_number', 'like', "%{$value}%")
    //                 ->orWhere('pincode', 'like', "%{$value}%");
    //         }
    //     })->get();
    //     return response()->json([
    //         'view' => view('admin-views.branches.partials._table', compact('branchess'))->render()
    //     ]);
    // }


    public function preview($id)
    {
        $branches = branches::where(['id' => $id])->first();
        return view('admin-views.branches.view', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $branches = new branches();
        $branches->name = $request->name;
        $branches->mobile = $request->mobile;
        $branches->short_code = $request->short_code;
        $branches->support_lan = $request->support_lan;
        $branches->save();

        Toastr::success(translate('branches added successfully!'));
        return redirect('admin/branches/list');
    }

    public function edit($id)
{
    $branches = branches::find($id);
    return view('admin-views.branches.edit', compact('branches'));
}


    public function update(Request $request, $id)
    {
       

        $branches = branches::find($id);
        $branches->name = $request->name;
        $branches->mobile = $request->mobile;
        $branches->short_code = $request->short_code;
        $branches->support_lan = $request->support_lan;
        $branches->save();

        Toastr::success(translate('branches Details updated successfully!'));
        return redirect('admin/branches/list');
    }

    public function delete(Request $request)
    {
        $branches = branches::find($request->id);
        if (Storage::disk('public')->exists('branches/' . $branches['image'])) {
            Storage::disk('public')->delete('branches/' . $branches['image']);
        }
        $branches->delete();
        Toastr::success(translate('branches Removed Successfully!'));
        return back();
    }
}
