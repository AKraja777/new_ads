<?php

/*namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Session;
use App\Model\Course;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class sessionController extends Controller
{
    public function index()
{
    $courses = course::all(); // Fetch all courses from the database
    
    return view('admin-views.session.index', compact('courses'));
}

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $session = session::where(function ($q) use ($key) {
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
            $session = new session();
        }

        $sessions = $session->with('course')->latest()->paginate(Helpers::getPagination())->appends($query_param);
    return view('admin-views.session.list', compact('sessions', 'search'));
}

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $session = session::where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%")
    //                 ->orWhere('mobile', 'like', "%{$value}%")
    //                 ->orWhere('email', 'like', "%{$value}%")
    //                 ->orWhere('vehicle_number', 'like', "%{$value}%")
    //                 ->orWhere('pincode', 'like', "%{$value}%");
    //         }
    //     })->get();
    //     return response()->json([
    //         'view' => view('admin-views.session.partials._table', compact('sessions'))->render()
    //     ]);
    // }


    public function preview($id)
    {
        $session = session::where(['id' => $id])->first();
        return view('admin-views.session.view', compact('session'));
    }

    public function store(Request $request)
    {
        

        $session = new session();
        $session->tittle = $request->tittle;
        $session->course_id = $request->course_id;
        $session->video_link = $request->video_link;
         $session->video_duration = $request->video_duration;
        $session->description = $request->description;
        $session->save();

        Toastr::success(translate('session added successfully!'));
        return redirect('admin/session/list');
    }

    public function edit($id)
    {
        $session = session::find($id);
        $courses = course::pluck('course_tittle', 'id'); // Fetch all courses as options for the dropdown
        return view('admin-views.session.edit', compact('session', 'courses'));
    }

    public function update(Request $request, $id)
    {
       

        $session = session::find($id);
        $session->tittle = $request->tittle;
        $session->course_id = $request->course_id;
        $session->video_link = $request->video_link;
        $session->video_duration = $request->video_duration;
        $session->description = $request->description;
        $session->save();

        Toastr::success(translate('session Details updated successfully!'));
        return redirect('admin/session/list');
    }

    public function delete(Request $request)
    {
        $session = session::find($request->id);
        if (Storage::disk('public')->exists('session/' . $session['image'])) {
            Storage::disk('public')->delete('session/' . $session['image']);
        }
        $session->delete();
        Toastr::success(translate('session Removed Successfully!'));
        return back();
    }
}
