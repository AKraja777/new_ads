<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\staffs;
use App\Model\Admin;
use App\Model\branches;
use App\Model\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Exports\VerifiedUsersExport;
use Maatwebsite\Excel\Facades\Excel; 

class UserController extends Controller
{
    public function exportAllUsers()
    {
        // Fetch verified users from the database
        $allUsers = User::all();
    
        // Prepare data for export (e.g., transform to an array or collection)
        $data = [];
        foreach ($allUsers as $user) {
            $data[] = [
                'ID' => $user->id,
                'Name' => $user->name,
                'Mobile' => $user->mobile,
                'status' => $user->status,
                'joined_date' => $user->joined_date,
                'balance' => $user->balance,
                'referred_by' => $user->referred_by,
                'refer_code' => $user->refer_code,
                'account_num' => $user->account_num,
                'holder_name' => $user->holder_name,
                'bank' => $user->bank,
                'branch' => $user->branch,
                'upi' => $user->upi,
                'device_id' => $user->device_id,
                'withdrawal_status' => $user->withdrawal_status,
                'fcm_id' => $user->fcm_id,
                'min_withdrawal' => $user->min_withdrawal,
                'register_bonus_sent' => $user->register_bonus_sent,
                'refer_bonus_sent' => $user->refer_bonus_sent,
                'generate_coin' => $user->generate_coin,
                'total_ads_viewed' => $user->total_ads_viewed,
                'trail_completed' => $user->trail_completed,
                'registered_date' => $user->registered_date,
                'basic_wallet' => $user->basic_wallet,
                'premium_wallet' => $user->premium_wallet,
                'total_ads' => $user->total_ads,
                'today_ads' => $user->today_ads,
                'target_refers' => $user->target_refers,
                'current_refers' => $user->current_refers,
                'age' => $user->age,
                'city' => $user->city,
                'gender' => $user->gender,
                'support_lan' => $user->support_lan,
                'support_id' => $user->support_id,
                'lead_id' => $user->lead_id,
                'branch_id' => $user->branch_id,
                'ifsc' => $user->ifsc,
                'earn' => $user->earn,
                'total_referals' => $user->total_referals,
                // ... add more columns as needed
            ];
        }
    
        // Set CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="verified_users.csv"',
        ];
    
        // Create a stream for CSV content
        $handle = fopen('php://temp', 'w+');
        
        // Add headers to the CSV
        fputcsv($handle, array_keys($data[0]));
    
        // Add data rows to the CSV
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
    
        // Move the pointer to the beginning of the stream
        rewind($handle);
    
        // Get the contents of the stream
        $csvContent = stream_get_contents($handle);
    
        // Close the stream
        fclose($handle);
    
        // Create a response with CSV content and headers
        return Response::make($csvContent, 200, $headers);
    }
    public function exportVerified()
    {
        // Fetch verified users from the database
        $verifiedUsers = User::where('status', 1)->get();
    
        // Prepare data for export (e.g., transform to an array or collection)
        $data = [];
        foreach ($verifiedUsers as $user) {
            $data[] = [
                'ID' => $user->id,
                'Name' => $user->name,
                'Mobile' => $user->mobile,
                'status' => $user->status,
                'joined_date' => $user->joined_date,
                'balance' => $user->balance,
                'referred_by' => $user->referred_by,
                'refer_code' => $user->refer_code,
                'account_num' => $user->account_num,
                'holder_name' => $user->holder_name,
                'bank' => $user->bank,
                'branch' => $user->branch,
                'upi' => $user->upi,
                'device_id' => $user->device_id,
                'withdrawal_status' => $user->withdrawal_status,
                'fcm_id' => $user->fcm_id,
                'min_withdrawal' => $user->min_withdrawal,
                'register_bonus_sent' => $user->register_bonus_sent,
                'refer_bonus_sent' => $user->refer_bonus_sent,
                'generate_coin' => $user->generate_coin,
                'total_ads_viewed' => $user->total_ads_viewed,
                'trail_completed' => $user->trail_completed,
                'registered_date' => $user->registered_date,
                'basic_wallet' => $user->basic_wallet,
                'premium_wallet' => $user->premium_wallet,
                'total_ads' => $user->total_ads,
                'today_ads' => $user->today_ads,
                'target_refers' => $user->target_refers,
                'current_refers' => $user->current_refers,
                'age' => $user->age,
                'city' => $user->city,
                'gender' => $user->gender,
                'support_lan' => $user->support_lan,
                'support_id' => $user->support_id,
                'lead_id' => $user->lead_id,
                'branch_id' => $user->branch_id,
                'ifsc' => $user->ifsc,
                'earn' => $user->earn,
                'total_referals' => $user->total_referals,
                // ... add more columns as needed
            ];
        }
    
        // Set CSV headers
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="verified_users.csv"',
        ];
    
        // Create a stream for CSV content
        $handle = fopen('php://temp', 'w+');
        
        // Add headers to the CSV
        fputcsv($handle, array_keys($data[0]));
    
        // Add data rows to the CSV
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
    
        // Move the pointer to the beginning of the stream
        rewind($handle);
    
        // Get the contents of the stream
        $csvContent = stream_get_contents($handle);
    
        // Close the stream
        fclose($handle);
    
        // Create a response with CSV content and headers
        return Response::make($csvContent, 200, $headers);
    }
    public function exportUnverified()
{
    // Fetch unverified users from the database
    $unverifiedUsers = User::where('status', 0)->get();
    
    // Prepare data for export (e.g., transform to an array or collection)
    $data = [];
    foreach ($unverifiedUsers as $user) {
        $data[] = [
            'ID' => $user->id,
            'Name' => $user->name,
            'Mobile' => $user->mobile,
            'status' => $user->status,
            'joined_date' => $user->joined_date,
            'balance' => $user->balance,
            'referred_by' => $user->referred_by,
            'refer_code' => $user->refer_code,
            'account_num' => $user->account_num,
            'holder_name' => $user->holder_name,
            'bank' => $user->bank,
            'branch' => $user->branch,
            'upi' => $user->upi,
            'device_id' => $user->device_id,
            'withdrawal_status' => $user->withdrawal_status,
            'fcm_id' => $user->fcm_id,
            'min_withdrawal' => $user->min_withdrawal,
            'register_bonus_sent' => $user->register_bonus_sent,
            'refer_bonus_sent' => $user->refer_bonus_sent,
            'generate_coin' => $user->generate_coin,
            'total_ads_viewed' => $user->total_ads_viewed,
            'trail_completed' => $user->trail_completed,
            'registered_date' => $user->registered_date,
            'basic_wallet' => $user->basic_wallet,
            'premium_wallet' => $user->premium_wallet,
            'total_ads' => $user->total_ads,
            'today_ads' => $user->today_ads,
            'target_refers' => $user->target_refers,
            'current_refers' => $user->current_refers,
            'age' => $user->age,
            'city' => $user->city,
            'gender' => $user->gender,
            'support_lan' => $user->support_lan,
            'support_id' => $user->support_id,
            'lead_id' => $user->lead_id,
            'branch_id' => $user->branch_id,
            'ifsc' => $user->ifsc,
            'earn' => $user->earn,
            'total_referals' => $user->total_referals,
        ];
    }
    
    // Set CSV headers
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="unverified_users.csv"',
    ];
    
    // Create a stream for CSV content
    $handle = fopen('php://temp', 'w+');
    
    // Add headers to the CSV
    fputcsv($handle, array_keys($data[0]));
    
    // Add data rows to the CSV
    foreach ($data as $row) {
        fputcsv($handle, $row);
    }
    
    // Move the pointer to the beginning of the stream
    rewind($handle);
    
    // Get the contents of the stream
    $csvContent = stream_get_contents($handle);
    
    // Close the stream
    fclose($handle);
    
    // Create a response with CSV content and headers
    return Response::make($csvContent, 200, $headers);
}

    
    public function index()
    {
        return view('admin-views.user.index');
    }

    public function list(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Define the status variable
    
        $users = User::query();
    
        if ($request->has('search')) {
            $key = explode(' ', $request->search);
            $users = $users->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('mobile', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request->search];
        } else {
            $query_param = [];
        }
    
        // Apply the status filter if it's present
        if ($status !== null) {
            $users = $users->where('status', $status);
            $query_param['status'] = $status; // Include status in query parameters
        }
    
        $users = $users->with('staffs')->latest()->paginate(Helpers::getPagination())->appends($query_param);
    
        return view('admin-views.user.list', compact('users', 'status', 'search'));
    }
    

    public function preview($id)
    {
        $user = User::findOrFail($id);
        return view('admin-views.user.view', compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'balance' => 'required',
            'referred_by' => 'required',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->balance = $request->balance;
        $user->mobile = $request->mobile;
        $user->referred_by = $request->referred_by;
        $user->save();
    
        // Generate and update the referral code
         $referredBy = $request->referred_by;
    $user_id = $user->id;

    if (empty($referredBy)) {
        $refer_code = MAIN_REFER . sprintf('%04d', $user_id); // Pad user ID with leading zeros
    } else {
        $adminCode = substr($referredBy, 0, -5);
        $adminReferCode = Admin::where('refer_code', $adminCode)->first();

        if ($adminReferCode) {
            $refer_code = $adminCode . sprintf('%04d', $user_id); // Pad user ID with leading zeros
        } else {
            $refer_code = MAIN_REFER . sprintf('%04d', $user_id); // Pad user ID with leading zeros
        }
    }
    
        $user->refer_code = $refer_code;
        $user->save();
    
        Toastr::success(translate('User added successfully!'));
        return redirect('admin/user/list');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $staffs = Staffs::pluck('name', 'id');
        $branches = branches::pluck('name', 'id'); // Fetching branch names
        return view('admin-views.user.edit', compact('user', 'staffs', 'branches'));
    }
    public function update(Request $request, $id)
    {
      

        $user = User::findOrFail($id);
        $user->mobile = $request->mobile;
        $user->joined_date = $request->joined_date;
        $user->earn = $request->earn;
        $user->balance = $request->balance;
        $user->device_id = $request->device_id;
        $user->referred_by = $request->referred_by;
        $user->refer_code = $request->refer_code;
        $user->withdrawal_status = $request->withdrawal_status;
        $user->status = $request->status;
        $user->min_withdrawal = $request->min_withdrawal;
        $user->account_num = $request->account_num;
        $user->holder_name = $request->holder_name;
        $user->bank = $request->bank;
        $user->branch = $request->branch;
        $user->ifsc = $request->ifsc;
        $user->basic_wallet = $request->basic_wallet;
        $user->premium_wallet = $request->premium_wallet;
        $user->total_ads = $request->total_ads;
        $user->today_ads = $request->today_ads;
        $user->target_refers = $request->target_refers;
        $user->current_refers = $request->current_refers;
        $user->gender = $request->gender;
        $user->support_lan = $request->support_lan;
        $user->support_id = $request->support_id;
        $user->lead_id = $request->lead_id;
        $user->branch_id = $request->branch_id;
        $user->save();

        Toastr::success(translate('User details updated successfully!'));
        return redirect('admin/user/list');
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        Toastr::success(translate('User deleted successfully!'));
        return back();
    }
}
