@extends('admin.layouts.app')

@section('title', 'Website director_message')

@section('content')

    <div class="main-container">

        <div class="row gutters mb-3">
            <div class="col-md-12 mb-2">
                @include('admin.layouts.alert')
            </div>

            <div class="col-xs-2 mb-2">
                <a href="{{ route('dashboard', 'web') }}" class="btn btn-primary">Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                    ADD NEW
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
                                    <th>Message</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($director_messages as $director_message)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{!! $director_message->message !!}</td>
                                        <td>
                                            <img src="{{ asset('/storage/uploads/director_message/' . $director_message->image) }}"
                                                style="width: 100px; height: 50px">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                                data-target="#edit{{ $director_message->id }}">Edit</button>

                                            <a class="delete_btn btn btn-danger btn-block" data-action="{{ $director_message->id }}"
                                                message="Delete the director_message">
                                                Delete
                                            </a>

                                            <form style="display: none" id="{{ $director_message->id }}" method="post"
                                                action="{{ route('director_message.destroy', $director_message) }}">
                                                @csrf @method('delete')
                                            </form>
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
                    <h5 class="modal-title">New director_message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('director_message.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-md-6 mb-3">
                                <label>message</label>
                                <input type="text" class="form-control" name="message"
                                    value="{{ old('message') }}" required>
                                @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" required>
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
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

    @foreach ($director_messages as $director_message_edit)
        <div class="modal fade" id="edit{{ $director_message_edit->id }}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit director_message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('director_message.update', $director_message_edit) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6 mb-3">
                                    <label>message</label>
                                    {{-- <input type="text" class="form-control" name="message"
                                        value="{{ $director_message_edit->message }}"> --}}
                                        <textarea class="form-control" name="message">{{ $director_message_edit->message }}</textarea>
                                    @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                    <img src="{{ asset('/storage/uploads/director_message/' . $director_message_edit->image) }}"
                                        style="width: 100px; height: 50px; margin-top: 20px;">
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
