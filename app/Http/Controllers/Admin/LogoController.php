<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $logo = Logo::first();
        return view('admin.web.logo',compact('logo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logo = Logo::first();
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/logo/'.$logo->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/logo', $filename, 'public');
        } else {
            $filename = $logo->image;
        }
        $data = [
            'image' => $filename,
        ];


        $logo->update($data);
        return Back()->with('success', 'Updated Sucessfully');
    }

    
}
