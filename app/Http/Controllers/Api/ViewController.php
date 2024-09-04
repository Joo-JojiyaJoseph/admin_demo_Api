<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;
use App\Models\Admin\Logo;
use App\Models\Admin\Testimonial;

class ViewController extends Controller
{
   public function sliders()
   {
    $sliders = Slider::all();
    return response()->json([
                'status'=>'200',
                'sliders'=>$sliders
             ]);

   }

   public function logo()
   {
    $logo = Logo::first();
    return response()->json([
                'status'=>'200',
                'logo'=>$logo
             ]);
   }

   public function seo()
   {
    return response()->json([
                'status'=>'200',
             ]);
   }

public function apitestimonials(){
    $testimonials=Testimonial::all();
    return response()->json([
        'status'=>'200',
        'testimonials'=>$testimonials
     ]);
}


public function contacts(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required',
        'company_name'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
        'message'=>'required',

    ]);
    if($validator->fails()){
        return response()->json([
            'status'=>'422',
            'error'=>$validator->errors()
        ]);
    }
    else
    {
        $contactForm = [
            'name' => $request->name,
            'phone' =>  $request->phone,
            'company_name' =>  $request->company_name,
            'email' => $request->email,
            'message' =>  $request->message,

        ];
        $message = 'Name : '.$request->name. '<br>Email : '.$request->email. '<br>Phone : '.$request->phone. '<br>Message : '.$request->message;
        Mail::to('jo@gmail.com')->send(new Contact($message));

     return response()->json([
        'status'=>'200',
        'msg'=>'We will Get Back To You Soon.'
     ]);
    }

   }


}
