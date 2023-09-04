<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Publisher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $publisher = Publisher::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('users.name', 'like', "%{$value}%")
                        ->orWhere('users.email', 'like', "%{$value}%")
                        ->orWhere('publishers.name', 'like', "%{$value}%")
                        ->orWhere('publishers.sub_name', 'like', "%{$value}%")
                        ->orWhere('publishers.sub_code', 'like', "%{$value}%")
                        ->orWhere('publishers.year', 'like', "%{$value}%")
                        ->orWhere('publishers.regulation', 'like', "%{$value}%")
                        ->orWhere('publishers.department', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $publisher = new Publisher();
        }

        $publishers = $publisher->join('users', 'publishers.user_id', '=','users.id')
        ->select('publishers.id AS id','users.name AS user_name','users.email','publishers.*','publishers.status AS status','publishers.name AS name')
        ->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.publish.list', compact('publishers', 'search',));
    }

    public function edit($id)
    {
        $publisher = Publisher::join('users', 'publishers.user_id', '=', 'users.id')
                        ->select('publishers.*', 'users.name as user_name','users.email','publishers.*','publishers.status AS status')
                        ->where('publishers.id', $id)
                        ->first();
        return view('admin-views.publish.edit', compact('publisher'));
    }
    


    public function update(Request $request, $id)
    {

        $publisher = Publisher::find($id);
        $publisher->status = $request->status;
        $publisher->save();
        Toastr::success(translate('Publication Details updated successfully!'));
        return redirect('admin/publish/list');
    }


    public function delete(Request $request)
    {
        $order = Order::find($request->id);
        $order->delete();
        Toastr::success(translate('Order Deleted Successfully!'));
        return back();
    }
}
