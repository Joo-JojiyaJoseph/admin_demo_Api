<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Brochure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrochureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brochure = Brochure::first();
        return view('admin.web.brochure',compact('brochure'));
        
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
        //
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
        $brochure = Brochure::first();
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png,pdf']);
            Storage::delete('/public/uploads/brochure/'.$brochure->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/brochure', $filename, 'public');
        } else {
            $filename = $brochure->image;
        }
        $data = [
            'image' => $filename,
        ];


        $brochure->update($data);
        return Back()->with('success', 'Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
