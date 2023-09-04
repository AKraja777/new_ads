<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\notification;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class notificationController extends Controller
{
    public function index()
    {
        return view('admin-views.notification.index');
    }
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request->search;

        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $notification = notification::where(function ($q) use ($key) {
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
        $notification = new notification();
    }

    $notification = $notification->latest()->paginate(Helpers::getPagination())->appends($query_param);
    return view('admin-views.notification.list', compact('notification', 'search'));
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
    ]);

    $notification = new notification();
    $notification->title = $request->title;
    $notification->description = $request->description;
    $notification->save();

    Toastr::success(translate('notification added successfully!'));
    return redirect('admin/notification/list');
}

public function delete(Request $request)
{
    $notification = notification::find($request->id);
    $notification->delete();
    
    Toastr::success(translate('notification Removed Successfully!'));
    return back();
}
}