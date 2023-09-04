<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\app_update;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class app_updateController extends Controller
{
    

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $app_update = app_update::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q
                        ->orWhere('link', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%")
                        ->orWhere('version', 'like', "%{$value}%");
                       

                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $app_update = new app_update();
        }

        $app_update = $app_update->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.app_update.list', compact('app_update', 'search'));
    }

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $book = book::where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%")
    //                 ->orWhere('mobile', 'like', "%{$value}%")
    //                 ->orWhere('email', 'like', "%{$value}%")
    //                 ->orWhere('vehicle_number', 'like', "%{$value}%")
    //                 ->orWhere('pincode', 'like', "%{$value}%");
    //         }
    //     })->get();
    //     return response()->json([
    //         'view' => view('admin-views.book.partials._table', compact('books'))->render()
    //     ]);
    // }


    public function preview($id)
    {
        $app_update = app_update::where(['id' => $id])->first();
        return view('admin-views.app_update.view', compact('app_update'));
    }


    public function edit($id)
    {
        $app_update = app_update::find($id);
        return view('admin-views.app_update.edit', compact('app_update'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
         
            'link' => 'required',
            'version' => 'required',
            'description' => 'required',
            

        ], [
            
            'link.required' => translate('link is required!'),
            'version.required' => translate('version  is required!'),
            'description.required' => translate('description  is required!'),
           

        ]);

        $app_update = app_update::find($id);
        $app_update->link = $request->link;
        $app_update->version = $request->version;
        $app_update->description = $request->description;
        $app_update->save();

        Toastr::success(translate('app_update Details updated successfully!'));
        return redirect('admin/app_update/list');
    }
}
