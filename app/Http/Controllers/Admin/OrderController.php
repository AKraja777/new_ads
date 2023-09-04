<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $order = Order::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('users.name', 'like', "%{$value}%")
                        ->orWhere('users.email', 'like', "%{$value}%")
                        ->orWhere('books.name', 'like', "%{$value}%")
                        ->orWhere('books.sub_name', 'like', "%{$value}%")
                        ->orWhere('books.sub_code', 'like', "%{$value}%")
                        ->orWhere('books.price', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $order = new Order();
        }

        $orders = $order->join('users', 'orders.user_id', '=','users.id')
        ->join('books', 'orders.book_id', '=','books.id')
        ->select('orders.id AS id','users.name AS user_name','users.email','orders.*','books.name','books.price','books.sub_name','books.sub_code','orders.created_at as ordered_date','orders.status AS status')
        ->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.order.list', compact('orders', 'search',));
    }

    public function edit($id)
    {
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
                        ->join('books', 'orders.book_id', '=', 'books.id')
                        ->select('orders.*', 'users.name as user_name','users.email','books.*','orders.created_at AS ordered_date','orders.id AS id','orders.status AS status','orders.image AS proof_image')
                        ->where('orders.id', $id)
                        ->first();
        return view('admin-views.order.edit', compact('order'));
    }
    


    public function update(Request $request, $id)
    {

        $order = Order::find($id);
        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->save();
        Toastr::success(translate('Order Details updated successfully!'));
        return redirect('admin/list');
    }


    public function delete(Request $request)
    {
        $order = Order::find($request->id);
        $order->delete();
        Toastr::success(translate('Order Deleted Successfully!'));
        return back();
    }
}
