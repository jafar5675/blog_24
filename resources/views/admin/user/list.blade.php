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
                        <h5 class="card-title">Users List
                            <a href="{{ url('admin/user/add') }}" class="btn btn-primary"
                                style="float: right; margin-top:-10px;">Add New User</a>
                        </h5>

                        <!-- Default Table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email Verified</th>
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
                                        <td>{{ $value->email }}</td>
                                        <td>{{ !empty($value->email_verified_at) ? 'Yes' : 'No' }}</td>
                                        <td>{{ !empty($value->status) ? 'active' : 'inactive' }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/user/edit/' . $value->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete the record?');"
                                                href="{{ url('admin/user/delete/' . $value->id) }}"
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
