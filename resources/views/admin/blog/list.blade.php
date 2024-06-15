@extends('admin.layouts.app')

@section('style')
    <style>
        .showing {
            padding: 5px;
            display: block;
        }

        .notshowing {
            padding: 5px;
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Search Blog</h2>
                    </div>
                    <form method="get" action="">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>ID</label>
                                    <input type="text" class="form-control" value="{{ Request::get('id') }}"
                                        name="id" placeholder="ID">
                                </div>
                                @if (Auth::user()->is_admin == 1)
                                    <div class="form-group col-md-3">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="{{ Request::get('username') }}"
                                            name="username" placeholder="User Name">
                                    </div>
                                @endif
                                <div class="form-group col-md-2">
                                    <label>Title</label>
                                    <input type="text" class="form-control" value="{{ Request::get('title') }}"
                                        name="title" placeholder="Title">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Category</label>
                                    <input type="text" class="form-control" value="{{ Request::get('category') }}"
                                        name="category" placeholder="Category">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Publish</label>
                                    <select name="is_publish" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ Request::get('is_publish') == 1 ? 'selected' : '' }} value="1">Yes
                                        </option>
                                        <option {{ Request::get('is_publish') == 100 ? 'selected' : '' }} value="100">No
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option {{ Request::get('status') == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ Request::get('status') == 100 ? 'selected' : '' }} value="100">
                                            Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" value="{{ Request::get('start_date') }}"
                                        name="start_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" value="{{ Request::get('end_date') }}"
                                        name="end_date">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" type="submit" style="margin-top:32px;">Search</button>
                                    <a href="{{ url('admin/blog/list') }}" class="btn btn-success"
                                        style="margin-top:32px;">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Blog List (Total: {{ $getRecord->total() }})
                            <a href="{{ url('admin/blog/add') }}" class="btn btn-primary"
                                style="float: right; margin-top:-10px;">Add New Blog</a>
                        </h5>

                        <!-- Default Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    @if (Auth::user()->is_admin == 1)
                                        <th scope="col">Username</th>
                                    @endif
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Publish</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>
                                            @if (!empty($value->getImage()))
                                                <img src="{{ $value->getImage() }}" alt="" width="60px;"
                                                    height="60px;">
                                            @endif
                                        </td>
                                        @if (Auth::user()->is_admin == 1)
                                            <td>{{ $value->user_name }}</td>
                                        @endif
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>{{ !empty($value->is_publish) ? 'Yes' : 'NO' }}</td>
                                        <td>{{ !empty($value->status) ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            {{-- The underline coding is to show only logged in user edit button others are disabled --}}
                                            {{-- {{ $value->user_id == Auth::user()->id ? 'btn-success' : 'btn-success disabled' }} --}}
                                            <a href="{{ url('admin/blog/edit/' . $value->id) }}"
                                                class="btn btn-success btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete the record?');"
                                                href="{{ url('admin/blog/delete/' . $value->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">Record not found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
