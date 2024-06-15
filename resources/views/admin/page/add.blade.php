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
                        <h5 class="card-title">Add New Page</h5>
                        <form class="row g-3" action="" method="post">
                            @csrf
                            <div class="col-12">
                                <label for="Title" class="form-label">Title</label>
                                <input type="title" name="title" value="{{ old('title') }}" class="form-control"
                                    id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('title') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="slug" name="slug" value="{{ old('slug') }}" class="form-control"
                                    id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('slug') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Description" class="form-label">Description</label>
                                <textarea class="form-control tinymce-editor" name="description"></textarea>
                                <div style="color:red;">{{ $errors->first('description') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Title" class="form-label">Meta Title</label>
                                <input type="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                    class="form-control" id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('meta_title') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Keywords" class="form-label">Meta Description</label>
                                <input type="meta_description" name="meta_description" value="{{ old('meta_description') }}"
                                    class="form-control" id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('meta_description') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Keywords" class="form-label">Meta Keywords</label>
                                <input type="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                    class="form-control" id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('meta_keywords') }}</div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
