<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Model\withdrawal;
use App\Model\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class WithdrawalController extends Controller
{
    public function list(Request $request)
    {
        $query_param = [];
        $search = $request->search;

        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $withdrawal = Withdrawal::where(function ($q) use ($key) {
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
            $withdrawal = Withdrawal::query();
        }
        
        $withdrawals = $withdrawal->with('user')->latest()->paginate(Helpers::getPagination())->appends($query_param);

        return view('admin-views.withdrawal.list', compact('withdrawals', 'search'));
    }
    public function updateStatus(Request $request)
    {
        $status = $request->input('status');
        $withdrawalIds = $request->input('withdrawal_ids');

        foreach ($withdrawalIds as $withdrawalId) {
            $withdrawal = Withdrawal::find($withdrawalId);
            if ($withdrawal) {
                $withdrawal->status = $status;
                $withdrawal->save();
            }
        }

        return response()->json(['success' => true]);
    }


}
