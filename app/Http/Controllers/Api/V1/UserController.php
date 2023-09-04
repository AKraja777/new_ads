<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Book;
use App\Model\Cart;
use App\Model\Course;
use App\Model\Categories;
use App\Model\Session;
use App\Model\app_update;
use App\Model\enrolled_course;
use App\Model\Order;
use App\Model\Publisher;
use App\Model\Comment;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{
    public function login(Request $request)
{
    $mobile = $request->input('mobile');
    $device_id = $request->input('device_id');

    if (empty($mobile) || empty($device_id)) {
        return response()->json([
            'success' => false,
            'message' => 'Mobile or device_id is empty.',
        ], 200);
    }

    // Check if a user with the given mobile number exists in the database
    $user = User::where('mobile', $mobile)->first();
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid mobile.',
        ], 200);
    }

    return response()->json([
        'success' => true,
        'message' => 'Logged in successfully.',
        'data' => $user,
    ], 201);
}

//signin
public function Register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'mobile' => 'required',
        'device_id' => 'required',
        'age' => 'required',
        'gender' => 'required',
        'city' => 'required',
        'support_lan' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 200);
    }

    $name = $request->input('name');
    $mobile = $request->input('mobile');
    $device_id = $request->input('device_id');
    $age = $request->input('age');
    $city = $request->input('city');
    $gender = $request->input('gender');
    $support_lan = $request->input('support_lan');

    $existingUser = User::where('mobile', $mobile)->first();
    if ($existingUser) {
        return response()->json([
            'success' => false,
            'message' => 'User already exists.',
        ], 200);
    }

    // Generate a random refer_code for the user
    $referCode = Str::random(8);

    // Fetch the admin's refer_code based on the provided referred_by value
    $referredBy = $request->referred_by;
    if (!empty($referredBy)) {
        $adminCode = substr($referredBy, 0, -4); // Adjust the length based on your admin REFER_CODE format
        $adminRefer = Admin::where('refer_code', $adminCode)->first();

        if ($adminRefer) {
            $adminReferCode = $adminRefer->refer_code;
        }
    }

    // Define a default MAIN_REFER if needed
    define('MAIN_REFER', 'CMD');

    // Determine the final refer_code for the user
    if (!empty($adminReferCode)) {
        $nextUserNumber = User::max('id') + 1; // Get the next user ID
        $userReferCode = MAIN_REFER . sprintf('%04d', $nextUserNumber); // Generate user REFER_CODE with leading zeros
        $refer_code = $adminReferCode . $userReferCode; // Combine admin and user REFER_CODE
    } else {
        $refer_code = MAIN_REFER . sprintf('%04d', User::max('id') + 1); // Use default if admin REFER_CODE not found
    }

    // Create the user and save the refer_code
    $user = new User;
    $user->name = $name;
    $user->mobile = $mobile;
    $user->device_id = $device_id;
    $user->age = $age;
    $user->city = $city;
    $user->gender = $gender;
    $user->support_lan = $support_lan;
    $user->refer_code = $refer_code;
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'Registered successfully.',
        'data' => $user,
    ], 201);
}

//update profile
public function update_profile(Request $request)
{
    $user_id = $request->input('user_id');

    if (empty($user_id)) {
        return response()->json([
            'success' => false,
            'message' => 'User ID is empty',
        ], 400);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    // Update user details based on the request data
    $user->name = $request->input('name');
    $user->age = $request->input('age');
    $user->city = $request->input('city');
    $user->gender = $request->input('gender');
    $user->support_lan = $request->input('support_lan');
    // Add more fields to update as needed

    // Save the updated user details
    $user->save();

    return response()->json([
        'success' => true,
        'message' => 'User details updated successfully',
        'data' => $user,
    ], 200);
}

//upload image
public function upload_image(Request $request)
{
    $user_id = $request->input('user_id');

    if (empty($user_id)) {
        return response()->json([
            'success' => false,
            'message' => 'User ID is empty',
        ], 400);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    $validator = Validator::make($request->all(), [
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
        ], 400);
    }

    $image = $request->file('image');
    if (!empty($image)) {
        // Assuming you have a valid image upload logic
        $imagePath = Helpers::upload('user/', 'png', $image);
        $user->image = $imagePath;
    }

    $user->save();

    $userDetails = [
        'image' =>  $user->image,
    ];

    return response()->json([
        'success' => true,
        'message' => 'Image upload successful',
        'data' => [$userDetails],
    ], 200);
}

  
    
  //userdetails
public function user_details(Request $request)
{    
    $user_id = $request->input('user_id');
    if(empty($user_id)){
        return response()->json([
            'success'=>false,
            'message' => 'User ID is empty',
        ], 200);
    }

    $user = User::where('id', $user_id)->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }

    $userData = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'mobile' => $user->mobile,
        'password' => $user->password,
        'refer_code' => $user->refer_code,
        'status' => $user->status,
        'joined_date' => $user->joined_date,
        'image' => $user->image,
    ];

    return response()->json([
        'success' => true,
        'message' => 'Details retrieved successfully',
        'data' => [$userData],
    ], 201);
}


// course update details
public function update_course(Request $request)
{
    $course_id = $request->input('course_id');
    if (empty($course_id)) {
        return response()->json([
            'success' => false,
            'message' => 'Course ID is empty',
        ], 400);
    }

    $course = Course::find($course_id);

    if (!$course) {
        return response()->json([
            'success' => false,
            'message' => 'Course not found',
        ], 404);
    }

    $name = $request->input('name');
    $image = $request->file('image');

    if (!empty($name)) {
        $course->name = $name;
    }

    if (!empty($image)) {
        // Assuming you have a valid image upload logic
        $imagePath = Helpers::upload('course/', 'png', $image);
        $course->image = $imagePath;
    }

    $course->save();

    $courseDetails = [
        'id' => $course->id,
        'name' => $course->name,
        'image' => asset('storage/app/public/course/' . $course->image),
    ];

    return response()->json([
        'success' => true,
        'message' => 'Course details updated successfully',
        'data' => $courseDetails,
    ], 200);
}


    //app_update
    public function app_update(Request $request)
{
    $app_updates = app_update::all(); // Assuming 'AppUpdate' is the correct model name

    if ($app_updates->isEmpty()) {
        return response()->json([
            "success" => false,
            'message' => "App Updates Not Found",
        ], 404);
    }

    $app_updateDetails = $app_updates->toArray();

    return response()->json([
        "success" => true,
        'message' => 'App Updates Retrieved Successfully',
        'data' => $app_updateDetails,
    ], 200);
}
    
    
    
//courselist
public function course_list(Request $request)
{
    $courses = Course::all();

    if ($courses->isEmpty()) {
        return response()->json([
            "success" => false,
            'message' => "No courses found",
        ], 404);
    }

    $responseData = [];

    foreach ($courses as $course) {
        $courseDetails = $course->toArray();

        $responseData[] = [
            'id' => $courseDetails['id'],
            'author' => $courseDetails['author'],
            'course_tittle' => $courseDetails['course_tittle'],
            'image' => asset('storage/app/public/course/' . $courseDetails['image']),
        ];
    }

    return response()->json([
        "success" => true,
        'message' => 'Courses listed successfully',
        'data' => $responseData,
    ], 200);
}

//sessionlist
public function session_list(Request $request)
{
    $course_id = $request->input('course_id');

    if (empty($course_id)) {
        return response()->json([
            'success' => false,
            'message' => 'Course ID is empty',
        ], 400);
    }

    $sessions = Session::where('course_id', $course_id)->get();

    if ($sessions->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No sessions found for the given course ID',
        ], 404);
    }

    $responseData = [];

    foreach ($sessions as $session) {
        $sessionDetails = $session->toArray();

        $responseData[] = [
            'id' => $sessionDetails['id'],
            'tittle' => $sessionDetails['tittle'],
            'video_link' => $sessionDetails['video_link'],
            'video_duration' => $sessionDetails['video_duration'],
        ];
    }

    return response()->json([
        "success" => true,
        'message' => 'Sessions listed successfully',
        'data' => $responseData,
    ], 200);
}

//my course list
public function my_course_list(Request $request)
{
    $user_id = $request->input('user_id');
    $courses = null;

    if (empty($user_id)) {
        $courses = Course::all();
    } else {
        $courses = Course::where('user_id', $user_id)->get();
    }

    if ($courses->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No courses found',
        ], 404);
    }

    $responseData = [];

    foreach ($courses as $course) {
        $courseDetails = $course->toArray();

        $responseData[] = [
            'id' => $courseDetails['id'],
            'author' => $courseDetails['author'],
            'course_tittle' => $courseDetails['course_tittle'],
            'image' => asset('storage/app/public/course/' . $courseDetails['image']),
        ];
    }

    return response()->json([
        "success" => true,
        'message' => 'Courses listed successfully',
        'data' => $responseData,
    ], 200);
}


//add categories
public function add_categories(Request $request)
{
    $category_id = $request->input('category_id');
    $name = $request->input('name');

    if (empty($category_id)) {
        return response()->json([
            'success' => false,
            'message' => 'Category ID is empty',
        ], 200);
    }
    if (empty($name)) {
        return response()->json([
            'success' => false,
            'message' => 'Name is empty',
        ], 200);
    }

    $existingCategory = categories::where('name', $name)
        ->orWhere('id', $category_id)
        ->first();

    if ($existingCategory) {
        return response()->json([
            'success' => false,
            'message' => 'Category already exists',
        ], 200);
    }

    $category = new categories();
    $category->name = $name;
    $category->save();

    return response()->json([
        'success' => true,
        'message' => 'Category added successfully',
        'data' => [
            'id' => $category->id,
            'name' => $category->name,
        ],
    ], 201);
}





/*public function enrolled_course(Request $request)
{
    $user_id = $request->input('user_id');
    $course_id = $request->input('course_id');
    $enroll_date = $request->input('enroll_date');
 
    if (empty($user_id)) {
        return response()->json([
            'success' => false,
            'message' => 'user_id is empty',
        ], 200);
    }
    if (empty($course_id)) {
        return response()->json([
            'success' => false,
            'message' => 'course_id is empty',
        ], 200);
    }
    if (empty($enroll_date)) {
        return response()->json([
            'success' => false,
            'message' => 'enroll_date is empty',
        ], 200);
    }


    // Check if the enrollment already exists
    $enrolled_course = enrolled_course::where('user_id', $user_id)
                                      ->where('course_id', $course_id)
                                      ->first();

    if ($enrolled_course) {
        // Enrollment already exists
        return response()->json([
            'success' => false,
            'message' => ' already enrolled ',
        ], 200);
    } else {
        // Enrollment doesn't exist, create a new entry
        $enrolled_course = new enrolled_course();
        $enrolled_course->user_id = $user_id;
        $enrolled_course->course_id = $course_id;
        $enrolled_course->enroll_date = $enroll_date;
        $enrolled_course->save();

        return response()->json([
            'success' => true,
            'message' => 'enrolled_course added successfully',
            'data' => $enrolled_course,
        ], 201);
    }
}
//my enrolled_course
public function my_enrolled_course(Request $request)
{
    $user_id = $request->input('user_id');

    if (empty($user_id)) {
        return response()->json([
            'success' => false,
            'message' => 'user_id is empty',
        ], 400);
    }

    $user = User::find($user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
    }


    $enrolled_courses = enrolled_course::where('user_id', $user_id)
        ->join('course', 'enrolled_course.course_id', '=', 'course.id')
        ->select('course.id', 'course.name', 'course.image')
        ->get();

    if ($enrolled_courses->isEmpty()) {
        return response()->json([
            'success' => true,
            'message' => ' enrolled courses not found for the user',
        ], 200);
    }

    $data = $enrolled_courses->map(function ($enrolled_course) {
        return [
            'id' => $enrolled_course->id,
            'name' => $enrolled_course->name,
            'image' => asset('storage/app/public/course/' . $enrolled_course->image),
        ];
    });

    return response()->json([
        'success' => true,
        'message' => 'Enrolled courses fetched successfully',
        'data' => $data,
    ], 200);
}*/
}
