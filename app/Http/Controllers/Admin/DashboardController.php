<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Branch;
use App\Model\Income;
use App\Model\Categories;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\app_update;
use App\Model\Review;
use App\Model\User;
use App\Model\withdrawal;
use App\Model\session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function fcm($id)
    {
        $fcm_token = Admin::find(auth('admin')->id())->fcm_token;
        $data = [
            'title' => 'New auto generate message arrived from admin dashboard',
            'description' => $id,
            'order_id' => '',
            'image' => '',
            'type'=>'order_status',
        ];
        Helpers::send_push_notif_to_device($fcm_token, $data);

        return "Notification sent to admin";
    }

    public function dashboard()
    {
        $joineddateCount = User::whereDate('joined_date', Carbon::now())->count();
        $registereddateCount = User::whereDate('registered_date', Carbon::now())->count();
        $activeUserCount = User::where('status', 1)->count();
        $tamilUserCount = User::where('support_lan', 'tamil')->count();
        $kannadaUserCount = User::where('support_lan', 'kannada')->count();
        $otherUserCount = User::whereNotIn('support_lan', ['tamil', 'kannada'])->count();
        $totalUnpaidWithdrawals = Withdrawal::where('status', 0)->sum('amount');
        $data = self::order_stats_data();
    
        $data['user'] = User::count();
        $data['withdrawal'] = User::count();
        $data['app_update'] = User::count();
    
        return view('admin-views.dashboard', compact('data', 'registereddateCount', 'activeUserCount', 'joineddateCount', 'tamilUserCount', 'kannadaUserCount', 'otherUserCount', 'totalUnpaidWithdrawals'));
    }
    

    public function order_stats(Request $request)
    {
        session()->put('statistics_type', $request['statistics_type']);
        $data = self::order_stats_data();

        return response()->json([
            'view' => view('admin-views.partials._dashboard-order-stats', compact('data'))->render()
        ], 200);
    }

    public function order_stats_data() {
        $today = session()->has('statistics_type') && session('statistics_type') == 'today' ? 1 : 0;
        $this_month = session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 1 : 0;

    }


}
