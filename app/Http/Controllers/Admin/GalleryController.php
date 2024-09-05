<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::Orderby('id', 'desc')->get();
        return view('admin.web.gallery')->with('gallerys', $gallery );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'

         ]);

         $filename = time().'.'.$request->file('image')->extension();
         $request->image->storeAs('uploads/gallery', $filename, 'public');

         $data = [
             'title' => $request->title,
             'image' => $filename,
         ];
        Gallery::create($data);

         return Back()->with('success', 'added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $gallery = Gallery::find($id);
        $request->validate([
            'title' => 'required',

         ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/uploads/gallery/'.$gallery->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/gallery', $filename, 'public');
        } else {
            $filename = $gallery->image;
        }

        $data = [
            'title' => $request->title,
            'image' => $filename,
        ];


        $gallery->update($data);
        return Back()->with('success', 'Updated Sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery= Gallery::findOrFail($id);
        $gallery->delete();

        return redirect(route('gallery.index'))->with('success', 'Deleted Successfully');
    }
}
