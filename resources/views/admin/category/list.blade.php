@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category List
                            <a href="{{ url('admin/category/add') }}" class="btn btn-primary"
                                style="float: right; margin-top:-10px;">Add New Category</a>
                        </h5>

                        <!-- Default Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Meta Title</th>
                                    <th scope="col">Meta Description</th>
                                    <th scope="col">Meta Keywords</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->slug }}</td>
                                        <td>{{ $value->title}}</td>
                                        <td>{{ $value->meta_title}}</td>
                                        <td>{{ $value->meta_description}}</td>
                                        <td>{{ $value->meta_keywords}}</td>
                                        <td>{{ !empty($value->status) ? 'active' : 'inactive' }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/category/edit/' . $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete the record?');"
                                                href="{{ url('admin/category/delete/' . $value->id) }}"
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
