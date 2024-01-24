<?php

namespace App\Http\Controllers\api;

use App\Helper\ImageManager;
use App\Http\Controllers\Controller;
use App\Models\Brochure;
use App\Models\Career;
use App\Models\ContactUs;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    protected $data = array(
        'status'    =>  true,
        'massage'   =>  '',
        'data'  =>  []
    );

    public function contact_us(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Kolkata');
            // START VALIDATION
            $rules = array(
                "name" => 'required',
                "email" => 'required|email',
                "number" => 'required|min:10|max:10|digits:10',
                "company_name" => 'required',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $error = json_decode($validator->errors());
                $this->data['status'] = false;
                $this->data['data'] = $error;
                return response()->json($this->data);
            }
            // END VALIDATION

            $formData               = new ContactUs();
            $formData->name         = $request->name;
            $formData->email        = $request->email;
            $formData->number       = $request->number;
            $formData->company_name = $request->company_name;
            $formData->message = $request->message;
            $formData->save();

            $formdata->subject_mail  =  'Send Inquiry';
            $formdata->mail_form  =  env('MAIL_FORM');
            $formdata->admin_mail  =  env('ADMIN_MAIL');

            // USER MAIL
            try {
                Mail::send('user.mail_templat.userMail', ['details' => $formdata, 'message', $this], function ($message) use ($formdata)
                {
                    $message->from($formdata["mail_form"], 'Fruxinfo Pvt. Ltd.')
                            ->to($formdata["email"])
                            ->subject($formdata["subject_mail"]);
                });
            } catch (\Throwable $th) {
                Log::info($th->getMessage());
            }

            // ADMIN MAIL
            try {
                Mail::send('user.mail_templat.adminMail', ['details' => $formdata, 'message', $this], function ($message) use ($formdata)
                {
                    $message->from($formdata["mail_form"], 'Fruxinfo Pvt. Ltd.')
                            ->to($formdata["admin_mail"])
                            ->subject($formdata["subject_mail"]);
                });
            } catch (\Throwable $th) {
                Log::info($th->getMessage());
            }

            $this->data['status'] = true;
            $this->data['massage'] = 'Contact Us Add Successfully';
            return response()->json($this->data);

        } catch (\Throwable $th) {
            $this->data['status'] = false;
            $this->data['massage'] = 'Something went wrong';
            $this->data['data'] = $th->getMessage();
            return response()->json($this->data);
        }
    }

}
