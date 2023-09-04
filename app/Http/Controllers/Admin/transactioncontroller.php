<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\transaction;
use App\Model\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class transactionController extends Controller
{
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request->search;

        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $transaction = transaction::where(function ($q) use ($key) {
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
            $transaction = transaction::query();
        }
        
        $transactions = $transaction->with('user')->latest()->paginate(Helpers::getPagination())->appends($query_param);

        return view('admin-views.transaction.list', compact('transactions', 'search'));
    }
}