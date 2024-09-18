<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::first();
        return view('admin.web.client',compact('clients'));
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
         $request->validate(['image' => 'mimes:jpg,jpeg,png']);
         $filename = time().'.'.$request->file('image')->extension();
         $request->image->storeAs('uploads/client', $filename, 'public');

         $data = [
             'image' => $filename,
         ];
        Client::create($data);

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
        $client = Client::first();
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/client/'.$client->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/client', $filename, 'public');
        } else {
            $filename = $client->image;
        }
        $data = [
            'image' => $filename,
        ];


        $client->update($data);
        return Back()->with('success', 'Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client= Client::findOrFail($id);
        $client->delete();

        return redirect(route('client.index'))->with('success', 'Deleted Successfully');
    }
}
