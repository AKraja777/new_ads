<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\ads;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class adsController extends Controller
{
    public function index()
    {
        return view('admin-views.ads.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request->search;

        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $ads = ads::where(function ($q) use ($key) {
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
        $ads = new ads();
    }

    $ads = $ads->latest()->paginate(Helpers::getPagination())->appends($query_param);
    return view('admin-views.ads.list', compact('ads', 'search'));
}

public function preview($id)
{
    $ads = ads::findOrFail($id);
    return view('admin-views.ads.view', compact('ads'));
}


    public function store(Request $request)
    {
        $ads = new ads();
        $ads->image = Helpers::upload('ads/', 'png', $request->file('image'));
        $ads->save();

        Toastr::success(translate('ads added successfully!'));
        return redirect('admin/ads/list');
    }

    public function edit($id)
    {
        $ads = ads::findOrFail($id);
        return view('admin-views.ads.edit', compact('ads'));
    }


    public function update(Request $request, $id)
    {
        $ads = ads::find($id);
        $ads->image = $request->has('image') ? Helpers::update('ads/', $ads->image, 'png', $request->file('image')) : $ads->image;
        $ads->save();

        Toastr::success(translate('ads details updated successfully!'));
        return redirect('admin/ads/list');
    }

    public function delete(Request $request)
    {
        $ads = ads::find($request->id);
        if (Storage::disk('public')->exists('ads/' . $ads->image)) {
            Storage::disk('public')->delete('ads/' . $ads->image);
        }
        $ads->delete();
        Toastr::success(translate('ads removed successfully!'));
        return back();
    }
}
