<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class InstallController extends Controller
{
    public function step0()
    {
        return view('installation.step0');
    }

    public function step1(Request $request)
    {
        if (Hash::check('step_1', $request['token'])) {
            $permission['curl_enabled'] = function_exists('curl_version');
            $permission['db_file_write_perm'] = is_writable(base_path('.env'));
            $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
            return view('installation.step1', compact('permission'));
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step0');
    }

    public function step2(Request $request)
    {
        if (Hash::check('step_2', $request['token'])) {
            return view('installation.step2');
        }
        session()->flash('error', 'Access denied!');
        return redirect()->route('step0');
    }

    public function step3(Request $request)
    {
        return view('installation.step3');
    }

    public function step4(Request $request)
    {
        return view('installation.step4');
    }

    public function step5(Request $request)
    {
        return view('installation.step5');
    }

    public function purchase_code(Request $request)
    {
        Helpers::setEnvironmentValue('SOFTWARE_ID', 'MzAzMjAzMzg=');
        Helpers::setEnvironmentValue('BUYER_USERNAME', $request['username']);
        Helpers::setEnvironmentValue('PURCHASE_CODE', $request['purchase_key']);

        $post = [
            'name' => $request['name'],
            'email' => $request['email'],
            'username' => $request['username'],
            'purchase_key' => $request['purchase_key'],
            'domain' => preg_replace("#^[^:/.]*[:/]+#i", "", url('/')),
        ];

        session()->flash('success', 'Your software has been activated for this domain "' . $post['domain'] . '".');
        return redirect()->route('step3', ['token' => $request['token']]);//s3
    }

    public function system_settings(Request $request)
    {
        if (!Hash::check('step_6', $request['token'])) {
            session()->flash('error', 'Access denied!');
            return redirect()->route('step0');
        }

        DB::table('admins')->insertOrIgnore([
            'f_name' => $request['admin_name'],
            'email' => $request['admin_email'],
            'password' => bcrypt($request['admin_password']),
            'phone' => $request['admin_phone'],
            'admin_role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('branches')->insertOrIgnore([
            'id' => 1,
            'name' => 'Main Branch',
            'email' => $request['admin_email'],
            'password' => bcrypt($request['admin_password']),
            'coverage' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('admin_roles')->insertOrIgnore([
            'id' => 1,
            'name' => 'Master Admin',
            'module_access' => null,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('business_settings')->where(['key' => 'restaurant_name'])->update([
            'value' => $request['web_name']
        ]);

        $previousRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.php');
        $newRouteServiceProvier = base_path('app/Providers/RouteServiceProvider.txt');
        copy($newRouteServiceProvier, $previousRouteServiceProvier);
        //sleep(5);
        return view('installation.step6');
    }

    public function database_installation(Request $request)
    {
        return redirect()->route('step4', ['token' => $request['token']]);
    }

    public function import_sql()
    {
        return view('installation.step5');
    }

    public function force_import_sql()
    {
        try {
            Artisan::call('db:wipe');
            $sql_path = base_path('installation/backup/database.sql');
            DB::unprepared(file_get_contents($sql_path));
            return  redirect()->route('step5',['token' => bcrypt('step_5')]);
        } catch (\Exception $exception) {
            session()->flash('error', 'Check your database permission!');
            return back();
        }
    }

    function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "")
    {

        if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        } else {
            return false;
        }
    }
}
