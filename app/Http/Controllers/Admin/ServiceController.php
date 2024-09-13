<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = Service::Orderby('id', 'desc')->get();

        return view('admin.web.service')->with('services', $service );
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $filename = time().'.'.$request->file('image')->extension();
        $request->image->storeAs('uploads/service', $filename, 'public');
        $filename = 'uploads/service/'.$filename;

        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect(route('service.index'))->with('success', 'Added Successfully');
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
        $service = Service::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$service->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/service', $filename, 'public');
            $filename = 'uploads/service/'.$filename;
        } else {
            $filename = $service->image;
        }

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect(route('service.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);

        Storage::delete('/public/'.$service->image);
        service::destroy($service->id);

        return redirect(route('service.index'))->with('success', 'Deleted Successfully');
    }
}
