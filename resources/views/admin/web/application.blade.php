@extends('admin.layouts.app')

@section('title', 'Website application')

@section('content')

    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
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
                                    <td>Job post</td>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Application</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$application->job}}</td>
                                        <td>{{$application->name}}</td>
                                        <td>{{$application->email}}</td>
                                        <td>{{$application->phone}}</td>
                                        <td>
                                         <iframe src="{{ asset('/storage/' . $application->image) }}" width="100%" height="600px"></iframe>
                                        </td>
                                        <td>
                                        <a class="delete_btn btn btn-danger btn-block" data-action="{{ $application->id }}"
                                            message="Delete the Application">
                                            Delete
                                        </a>
                                        <form style="display: none" id="{{ $application->id }}" method="post"
                                            action="{{ route('application.destroy', $application) }}">
                                            @csrf @method('delete')
                                        </form>
                                    </td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#edit{{ $application->id }}">Edit</button>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
