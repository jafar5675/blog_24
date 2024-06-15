@extends('layouts.app')
@section('style')
@endsection

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>
                                @if (!empty('header_title'))
                                    {{ $header_title }}
                                @else
                                    Our Blog
                                @endif
                            </h1>
                            <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                                voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores.
                                Quasi ratione sint. Sit quaerat ipsum dolorem.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('') }}">Home</a></li>
                        <li class="current">blogs</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->
        <div class="container-fluid pt-2">
            <div class="container">
                <div class="text-center pb-2">
                    <span class="px-2">Latest Blog</span>
                    <h1 class="mb-4">Latest Articles From Blog</h1>
                </div>
                <div class="row">
                    @foreach ($getRecord_b as $value)
                        <div class="col-lg-4 mb-4">
                            <div class="card border-0 shadow-sm mb-2">
                                <img class="card-img-top mb-2" src="{{ $value->getImage() }}" alt="" height="300px"
                                    width="100px">
                                <div class="card-body bg-light text-center p-4">
                                    <a href="{{ url($value->slug) }}">
                                        <h4>{{ $value->title }}</h4>
                                    </a>
                                    <div class="d-flex justify-content-center mb-3">
                                        <small class="mr-3">
                                            <i class="bi bi-person text-primary"></i>{{ $value->user_name }}
                                        </small>
                                        <small class="mr-3">
                                            <a href="{{ url($value->category_slug) }}"><i
                                                    class="bi bi-question-circle text-primary"></i>{{ $value->category_name }}</a>
                                        </small>
                                        <small class="mr-3">
                                            <i class="bi bi-chat-left-text text-primary"></i>15
                                        </small>
                                    </div>
                                    <p>{!! strip_tags(Str::substr($value->description, 0, 170)) !!} ....</p>
                                    <a href="{{ url($value->slug) }}" class="btn btn-primary px-4 mx-auto my-2">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {!! $getRecord_b->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@endsection
