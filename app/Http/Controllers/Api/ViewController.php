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

}
