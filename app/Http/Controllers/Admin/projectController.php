<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class projectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = project::Orderby('id', 'desc')->get();

        return view('admin.web.project')->with('projects', $project );
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
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $filename = time().'.'.$request->file('image')->extension();
        $request->image->storeAs('uploads/project', $filename, 'public');
        $filename = 'uploads/project/'.$filename;

        project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect(route('project.index'))->with('success', 'Added Successfully');
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
        $project = project::find($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'mimes:jpg,jpeg,png']);
            Storage::delete('/public/'.$project->image);
            $filename = time().'.'.$request->file('image')->extension();
            $request->image->storeAs('uploads/project', $filename, 'public');
            $filename = 'uploads/project/'.$filename;
        } else {
            $filename = $project->image;
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect(route('project.index'))->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = project::find($id);

        Storage::delete('/public/'.$project->image);
        project::destroy($project->id);

        return redirect(route('project.index'))->with('success', 'Deleted Successfully');
    }
}
