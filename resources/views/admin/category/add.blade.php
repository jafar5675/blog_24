@extends('admin.layouts.app')

@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Category</h5>
                        <form class="row g-3" action="" method="post">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    id="inputNanme4"required>
                                <div style="color:red;">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Title" class="form-label">Title</label>
                                <input type="title" name="title" value="{{ old('title') }}" class="form-control"
                                    id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('title') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Title" class="form-label">Meta Title</label>
                                <input type="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                    class="form-control" id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('meta_title') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Description" class="form-label">Meta Description</label>
                                <textarea name="meta_description"></textarea>
                                <div style="color:red;">{{ $errors->first('meta_description') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Meta Keywords" class="form-label">Meta Keywords</label>
                                <input type="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                    class="form-control" id="inputEmail4" required>
                                <div style="color:red;">{{ $errors->first('meta_keywords') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="Status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="menu" class="form-label">Menu</label>
                                <select name="is_menu" class="form-control">
                                    <option {{ old('is_menu') == 1 ? 'selected' : '' }} value="0">No</option>
                                    <option {{ old('is_menu') == 0 ? 'selected' : '' }} value="1">Yes</option>
                                </select>
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
@endsection
