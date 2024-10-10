<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationMail;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;
use App\Models\Admin\Application;
use App\Models\Admin\Brochure;
use App\Models\Admin\Client;
use App\Models\Admin\Job;
use App\Models\Admin\Logo;
use App\Models\Admin\project;
use App\Models\Admin\Seo;
use App\Models\Admin\Service;
use App\Models\Admin\Testimonial;
use App\Models\Gallery;

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
   public function clients()
   {
    $clients = Client::all();
    return response()->json([
                'status'=>'200',
                'clients'=>$clients
             ]);

   }

   public function brochure()
   {
    $brochure = Brochure::first();
    return response()->json([
                'status'=>'200',
                'brochure'=>$brochure
             ]);

   }

   public function job()
   {
    $job = Job::where('visible',1)->get();
    return response()->json([
                'status'=>'200',
                'job'=>$job
             ]);

   }

   public function projects($id="")
   {
    if(!$id=="")
    {
        $projects = project::find($id);
    }
    else{
    $projects = project::all();
    }
    return response()->json([
                'status'=>'200',
                'projects'=>$projects
             ]);

   }

   public function projectids($id="")
   {
    if(!$id=="")
    {
        $projectids = project::find($id);
    }
    else{
    $projectids = project::all();
    }
    return response()->json([
                'status'=>'200',
                'projectids'=>$projectids
             ]);

   }


   public function careerids($id="")
   {
    if(!$id=="")
    {
        $careerids = Job::find($id);
    }
    else{
    $careerids = Job::all();
    }
    return response()->json([
                'status'=>'200',
                'careerids'=>$careerids
             ]);

   }


   public function serviceids($id="")
   {
    if(!$id=="")
    {
        $serviceids = Service::find($id);
    }
    else{
    $serviceids = service::all();
    }
    return response()->json([
                'status'=>'200',
                'serviceids'=>$serviceids
             ]);

   }


   public function service($id="")
   {

    if(!$id=="")
    {
        $services = Service::find($id);
    }
    else{
        $services = Service::all();
    }

    return response()->json([
                'status'=>'200',
                'services'=>$services
             ]);

   }

   public function logo()
   {
    $logo = Logo::first();
    return response()->json([
                'status'=>'200',
                'logo'=>$logo,
             ]);
   }

   public function baseimageurl()
   {
    return response()->json([
                'status'=>'200',
                'imageurl' => url('storage/')
             ]);
   }

//    public function seo()
//    {
//     return response()->json([
//                 'status'=>'200',
//              ]);
//    }

public function getSeoData($page)
{
    $seo = Seo::where('page', $page)->first();
    if ($seo) {
        return response()->json([
            'status'=>'200',
            'seo'=>$seo
         ]);
    }
}


public function apitestimonials(){
    $testimonials=Testimonial::all();
    return response()->json([
        'status'=>'200',
        'testimonials'=>$testimonials
     ]);
}


public function gallery(){
    $gallerys=Gallery::all();
    return response()->json([
        'status'=>'200',
        'gallerys'=>$gallerys
     ]);
}


public function careerApply(Request $request)
{
    // Validate form data
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'email' => 'required|email',
    //     'phone' => 'required|string',
    //     'resume' => 'required|mimes:pdf,doc,docx|max:2048',  // Validate file upload
    // ]);
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    // Initialize the resume path variable
    $resumePath = null;

    // Store the uploaded resume file
    if ($request->hasFile('resume')) {
        $resumePath = $request->file('resume')->store('resumes', 'public');
    }

    // Save form data to the database
    $career = Application::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'image' => $resumePath,  // Store file path in database
    ]);

    // Prepare the email data
    $emailData = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'resume' => $resumePath,  // Include resume path if needed
    ];

    // Send the email with the application data
    Mail::to('jo@example.com')->send(new ApplicationMail($emailData, $resumePath));

    return response()->json([
        'status' => '200',
        'msg' => 'We will Get Back To You Soon.'
    ]);
}




public function contacts(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required',
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
        // $contactForm = [
        //     'name' => $request->name,
        //     'phone' =>  $request->phone,
        //     'email' => $request->email,
        //     'message' =>  $request->message,

        // ];
        $message = 'Name : '.$request->name. '<br>Email : '.$request->email. '<br>Phone : '.$request->phone. '<br>Message : '.$request->message;

        Mail::to('jo@gmail.com')->send(new Contact($message));


     return response()->json([
        'status'=>'200',
        'msg'=>'We will Get Back To You Soon.'
     ]);
    }

   }


}
