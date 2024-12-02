<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Director_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $director_message = Director_message::Orderby('id', 'desc')->get();
        return view('admin.web.director_message')->with('director_messages', $director_message );
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
        $director_message = Director_message::find($id);
        $request->validate([
            'message' => 'required',

         ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/director_message/'.$director_message->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/director_message', $filename, 'public');
        } else {
            $filename = $director_message->image;
        }

        $data = [
            'message' => $request->message,
            'image' => $filename,
        ];


        $director_message->update($data);
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
