@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets') }}/tagsinput/bootstrap-tagsinput.css">
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Blog</h5>
                        <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                <label for="Title" class="form-label">Title</label>
                                <input type="title" name="title" value="{{ old('title', $getRecord->title) }}"
                                    class="form-control" id="inputEmail4">
                                <div style="color:red;">{{ $errors->first('title') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Category" class="form-label">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($getCategory as $value)
                                        <option {{ $getRecord->category_id == $value->id ? 'selected' : '' }}
                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="Image" class="form-label">Blog Image</label>
                                <input type="file" class="form-control" name="blog_image">
                                @if (!empty($getRecord->getImage()))
                                    <img src="{{ $getRecord->getImage() }}" alt="" width="60px;" height="60px;">
                                @endif
                            </div>
                            <div class="col-12">
                                <label for="Description" class="form-label">Description</label>
                                <textarea class="form-control tinymce-editor" name="description">{!! $getRecord->description !!}</textarea>
                                <div style="color:red;">{{ $errors->first('description') }}</div>
                            </div>
                            <div class="col-12">
                                @php
                                    $tags = '';
                                    foreach ($getRecord->getTag as $value) {
                                        $tags .= $value->name . ',';
                                    }
                                @endphp
                                <labelclass="form-label">Tags</label>
                                <input type="text" name="tags" id="tags" value="{{ $tags }}"
                                    class="form-control">

                            </div>
                            <div class="col-12">
                                <label for="Meta Keywords" class="form-label">Meta Description</label>
                                <input type="meta_description" name="meta_description"
                                    value="{{ old('meta_description', $getRecord->meta_description) }}" class="form-control"
                                    id="inputEmail4">
                                <div style="color:red;">{{ $errors->first('meta_description') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Keywords" class="form-label">Meta Keywords</label>
                                <input type="meta_keywords" name="meta_keywords"
                                    value="{{ old('meta_keywords', $getRecord->meta_keywords) }}" class="form-control"
                                    id="inputEmail4">
                                <div style="color:red;">{{ $errors->first('meta_keywords') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Status" class="form-label">Publish</label>
                                <select name="is_publish" class="form-control">
                                    <option {{ old('is_publish') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                    <option {{ old('is_publish') == 0 ? 'selected' : '' }} value="0">No</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="Status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets') }}/tagsinput/bootstrap-tagsinput.js"></script>
    <script>
        $('#tags').tagsinput();
    </script>
@endsection
