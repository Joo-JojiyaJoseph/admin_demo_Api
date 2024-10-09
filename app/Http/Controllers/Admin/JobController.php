<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $job =Job::Orderby('id', 'desc')->get();

        return view('admin.web.job')->with('jobs', $job );
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
            'qualification' => 'required',
            'description' => 'required',
        ]);

       Job::create([
            'title' => $request->title,
            'qualification' => $request->qualification,
            'description' => $request->description,
            'visible' =>1,
        ]);

        return redirect(route('job.index'))->with('success', 'Added Successfully');
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
        $job = Job::find($id);

        $request->validate([
            'title' => 'required',
            'qualification' => 'required',
            'description' => 'required',
        ]);

      

        $job->update([
            'title' => $request->title,
            'qualification' => $request->qualification,
            'description' => $request->description,
        ]);

        return redirect(route('job.index'))->with('success', 'Updated Successfully');
    }


    public function hide( string $id)
    {
        $job = Job::find($id);
        $job->update([
            'visible' =>0,
        ]);

        return redirect(route('job.index'))->with('success', 'Updated Successfully');
    }

    public function showjob( string $id)
    {
        $job = Job::find($id);
        $job->update([
            'visible' =>1,
        ]);

        return redirect(route('job.index'))->with('success', 'Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
