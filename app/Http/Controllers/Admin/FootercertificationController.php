<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Footer_certification;
use Illuminate\Http\Request;

class FootercertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footer_certification = Footer_certification::Orderby('id', 'desc')->get();
        return view('admin.web.footer_certification')->with('footer_certifications', $footer_certification );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png'

         ]);

         $filename = time().'.'.$request->file('image')->extension();
         $request->image->storeAs('uploads/footer_certification', $filename, 'public');

         $data = [
             'image' => $filename,
         ];
        footer_certification::create($data);

         return Back()->with('success', 'added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $footer_certification = Footer_certification::find($id);
        $request->validate([
            'message' => 'required',
         ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/footer_certification/'.$footer_certification->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/footer_certification', $filename, 'public');
        } else {
            $filename = $footer_certification->image;
        }

        $data = [
            'image' => $filename,
        ];


        $footer_certification->update($data);
        return Back()->with('success', 'Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footer_certification= Footer_certification::findOrFail($id);
        $footer_certification->delete();

        return redirect(route('footer_certification.index'))->with('success', 'Deleted Successfully');
    }
}
