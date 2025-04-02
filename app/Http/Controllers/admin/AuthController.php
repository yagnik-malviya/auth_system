<?php

namespace App\Http\Controllers\admin;

use App\Helper\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->ajax())
        {
            //VALIDATION START
            $rules = array(
                'userName'  => 'required|exists:admins,userName',
                'password'  => 'required',
            );

            $validatorMesssages = array(
                'userName.required'=>'Please Enter User Name.',
                'password.required'=>'Please Enter Password.',
            );

            $validator = Validator::make($request->all(), $rules, $validatorMesssages);

            if ($validator->fails()) {

                $error=json_decode($validator->errors());
                return response()->json(['status' => 401,'error1' => $error]);
            }
            //VALIDATION END

            if(Auth::guard('admin')->attempt(['userName' => $request->userName, 'password' => $request->password]))
            {
                $redirect = route('admin.dashboard');
                return response()->json(['status' => 1,'redirect' => $redirect]);
            }
            else{
                return response()->json(['status' => 401,'error1' => ['password' => 'Password Not valid']]);
            }
        }
        return view('admin.auth.login');
    }

    public function forgot_password(Request $request)
    {
        if($request->ajax())
        {
            //VALIDATION START
            $rules = array(
                'email'  => 'required|exists:users,email',
            );

            $validatorMesssages = array(
                'email.required'=>'Please Enter Email.',
            );

            $validator = Validator::make($request->all(), $rules, $validatorMesssages);

            if ($validator->fails()) {

                $error=json_decode($validator->errors());
                return response()->json(['status' => 401,'error1' => $error]);
            }
            //VALIDATION END

            $token = Str::random(100);
            $admin = Admin::where('email',$request->email)->first();
            $admin->remember_token = $token;
            $admin->save();

            // $link = route('admin.reset_password').'/?'.$token;

            // try {
            //     Mail::send('admin.mail_template.forgotmail', ['link' => $link], function ($m) use ($admin)
            //     {
            //         $m->to($admin->email)->subject("Reset your password");
            //     });
            // } catch (\Throwable $th) {}

            return response()->json(['status' => 1,'message' => 'Please Check Mail']);

        }
        return view('admin.auth.forgot_password');
    }

    public function reset_password(Request $request)
    {
        if($request->ajax())
        {
           //VALIDATION START
           $rules = array(
            'new_password'  => 'required',
            'conform_password'  => 'required|same:new_password',
            );

            $validatorMesssages = array(
                'new_password.required'=>'Please Enter New Password.',
                'conform_password.required'=>'Please Enter Conform Password.',
            );

            $validator = Validator::make($request->all(), $rules, $validatorMesssages);

            if ($validator->fails()) {

                $error=json_decode($validator->errors());
                return response()->json(['status' => 401,'error1' => $error]);
            }
            //VALIDATION END

            $token = explode('?', $request->url);
            // $token = explode('?', 'http://localhost:8080/parezelsus/public/reset_password?123132');

            if(count($token) > 1)
            {
                if(!empty($token[1]))
                {
                    $admin = Admin::where('remember_token',$token[1])->first();
                    if(!empty($admin))
                    {
                        $admin->password = Hash::make($request->new_password);
                        $admin->remember_token = Null;
                        $admin->save();

                        $redirect = route('admin.login');
                        return response()->json(['status' => 1,'redirect' => $redirect]);
                    }
                }
            }
            return response()->json(['status' => 401,'error1' => ['conform_password' => 'This link is Not Valid']]);
        }
        return view('admin.auth.reset_password');
    }

    public function profile(Request $request)
    {
        if($request->ajax())
        {
            $admin = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            if($request->image)
            {
                $image = ImageManager::updateImage($admin->image,$request->image,'profile/');
                $admin->image = $image;
            }
            $admin->userName  = $request->userName;
            $admin->name      = $request->name;
            $admin->email     = $request->email;
            $admin->mobile    = $request->mobile;
            $admin->save();

            $redirect = route('admin.profile');
            return response()->json(['status' => 1,'redirect' => $redirect]);

        }
        return view('admin.auth.profile');
    }

    public function change_password(Request $request)
    {
        if($request->ajax())
        {

            //VALIDATION START
            $rules = array(
                'password'  => 'required',
                'confirm_password'  => 'required|same:password',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                $error=json_decode($validator->errors());
                return response()->json(['status' => 401,'error1' => $error]);
            }
            //VALIDATION END
            // dd($request->all());

            $admin = Admin::where('id',Auth::guard('admin')->user()->id)->first();
            $admin->password = Hash::make($request->password);
            $admin->save();

            return response()->json(['status' => 1,'message' => 'Password Change Successfully']);

        }
        return view('admin.auth.change_password');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
