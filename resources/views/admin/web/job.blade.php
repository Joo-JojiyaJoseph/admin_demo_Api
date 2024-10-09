@extends('admin.layouts.app')

@section('title', 'job job')

@section('content')

    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                    ADD job
                </button>
            </div>
        </div>

        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Qualification</th>
                                    <th>Description</th>
                                    <th>Visible</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->qualification }}</td>
                                        <td>{!! $job->description !!}</td>
                                        <td> @if($job->visible==1)
                                        <form action="{{ route('job.hides', $job->id) }}" method="POST" style="display:inline;">
    @csrf  <!-- Include CSRF token for security -->
    <button type="submit" class="btn btn-danger btn-block">Hide</button>
</form>

                                        @endif
                                        @if($job->visible==0)
                                        <form action="{{ route('job.showjob', $job->id) }}" method="POST" style="display:inline;">
    @csrf  <!-- Include CSRF token for security -->
    <button type="submit" class="btn btn-success btn-block">Show</button>
</form>

                                        @endif
                                    </td>
                                        <td>
                                           
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                                data-target="#edit{{ $job->id }}">Edit</button>

                                            <!-- <a class="delete_btn btn btn-danger btn-block"
                                                data-action="{{ $job->id }}" message="Delete the job">
                                                Delete
                                            </a>

                                            <form style="display: none" id="{{ $job->id }}" method="post"
                                                action="{{ route('job.destroy', $job) }}">
                                                @csrf @method('delete')
                                            </form> -->
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('job.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-md-6 mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Qualification<Title></Title></label>
                                <textarea name="qualification" class="form-control" required='true'>{{ old('qualification') }}</textarea>
                                @error('qualification')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description<Title></Title></label>
                                <textarea name="description" class="form-control" required='true'>{{ old('description') }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                          
                          
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($jobs as $job_edit)
        <div class="modal fade" id="edit{{ $job_edit->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('job.update', $job_edit) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group row">


                                <div class="col-md-6 mb-3">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $job_edit->title }}">
                                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Qualification<Title></Title></label>
                                    <textarea name="qualification" class="form-control">{{ $job_edit->qualification }}</textarea>
                                    @error('qualification')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Description<Title></Title></label>
                                    <textarea name="description" class="form-control">{{ $job_edit->description }}</textarea>
                                    @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                              
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="case" value="insert">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
