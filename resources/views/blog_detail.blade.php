@extends('layouts.app')
@section('style')
@endsection

@section('content')
    <main class="main">
        <div class="container py-5">
            <div class="row pt-2">
                <div class="col-lg-8">
                    @include('_message')
                    <div class="d-flex flex-column text-left mb-3">
                        <h1 class="mb-3">{{ $getRecord->title }}</h1>
                        <div class="d-flex">
                            <p class="mr-3">
                                <i class="bi bi-person text-primary"></i>{{ $getRecord->user_name }}
                            </p>
                            <p class="mr-5">
                                <a href="{{ url($getRecord->category_slug) }}"><i
                                        class="bi bi-question-circle text-primary"></i>{{ $getRecord->category_name }}</a>
                            </p>
                            <p class="mr-3">
                                <i class="bi bi-chat-left-text text-primary"></i>{{ $getRecord->getCommentCount() }}
                            </p>
                        </div>
                    </div>
                    <div class="mb-5">
                        @if (!empty($getRecord->getImage()))
                            <img class="img-fluid" src="{{ $getRecord->getImage() }}" alt="Image">
                        @endif
                    </div>
                    {!! $getRecord->description !!}
                    {{-- </div> --}}
                    @if (!empty($getRelatedPost->count()))
                        <h2 class="mb-4 ml-3">Related Post</h2>

                        <!-- Slides with captions -->
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                @foreach ($getRelatedPost as $related)
                                    <div class="carousel-item active">
                                        <img src="{{ $related->getImage() }}" class="d-block"
                                            style="height:400px; width:800px;" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $related->category_name }}</h5>
                                            <p>{{ $related->meta_description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>
                    @endif
                    <div class="mb-5">
                        <h2 class="mb-4">{{ $getRecord->getComment->count() }} comments</h2>
                        @foreach ($getRecord->getComment as $comment)
                            <div class="media mb-2">
                                <img src="{{ 'upload/profile/' . $comment->user->profile_pic }}" alt=""
                                    height="50px" width="50px">
                                <div class="media-body">
                                    <h6>{{ $comment->user->name }}
                                        <small><i>{{ date('d M Y', strtotime($comment->created_at)) }} at
                                                {{ date('h:i A', strtotime($comment->created_at)) }}</i></small>
                                    </h6>
                                    <p>{{ $comment->comment }}</p>
                                    <button class="btn btn-sm btn-light ReplyOpen" id="{{ $comment->id }}">Reply</button>
                                    @foreach ($comment->getReply as $reply)
                                        <div class="media mt-1" style="margin-left: 30px;">
                                            <img src="{{ 'upload/profile/' . $reply->user->profile_pic }}" alt=""
                                                height="50px" width="50px">
                                            <div class="media-body">
                                                <h6>{{ $reply->user->name }}
                                                    <small><i>{{ date('d M Y', strtotime($reply->created_at)) }} at
                                                            {{ date('h:i A', strtotime($reply->created_at)) }}</i></small>
                                                </h6>
                                                <p>{{ $reply->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="bg-light ShowReply{{ $comment->id }}" style="display:none;">
                                        <h2 class="mb-4">Reply the comment</h2>
                                        <form action="{{ url('blog-comment-reply-submit') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <div class="form-group">
                                                <label for="comment">Comment</label>
                                                <textarea name="comment" required cols="10" rows="3" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Reply" class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-light p-5">
                        <h2 class="mb-4">Leave a comment</h2>
                        <form action="{{ url('blog-comment-submit') }}" method="post">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $getRecord->id }}">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment" required cols="10" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" value="Leave Comment" class="btn btn-primary px-3">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 mt-5 mt-lg-0">
                    {{-- <div class="d-flex flex-column text-center bg-primary rounded mb-5 py-5 px-4">
                        <img class="img-fluid" src="{{ asset('frontend') }}/assets/img/team/team-1.jpg" alt="">
                    </div> --}}
                    <div class="mb-5">
                        <form action="{{ url('blog') }}" method="get">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control form-control-lg" required
                                    placeholder="Keyword">
                                <div class="input-group-append">
                                    <button class="input-group-text bg-transparent text-primary">
                                        <i class="bi bi-search my-1"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-5">
                        <h2 class="mb-4">Categories</h2>
                        <ul class="list-group list-group-flush">
                            @foreach ($getCategory as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <a href="{{ url($category->slug) }}">{{ $category->name }}</a>
                                    <span class="badge badge-primary badge-pill" style="color:blueviolet">150</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-5">
                        <h2 class="mb-4">Recent Post</h2>
                        @foreach ($getRecentPost as $recent)
                            <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                                @if (!empty($recent->getImage()))
                                    <img src="{{ $recent->getImage() }}" width="50px" height="50px" alt="Image">
                                @endif
                                <div class="pl-3">
                                    <a href="{{ url($recent->slug) }}">
                                        <h5 class="">{!! strip_tags(Str::substr($recent->title, 0, 20)) !!}</h5>
                                    </a>
                                    <div class="d-flex">
                                        <small class="mr-3"><i
                                                class="bi bi-user text-primary"></i>{{ $recent->user_name }}</small>
                                        <small class="mr-3">
                                            <a href="{{ url($getRecord->category_slug) }}"><i
                                                    class="bi bi-user text-primary"></i>{{ $recent->category_name }}</a>
                                        </small>
                                        <small class="mr-3"><i
                                                class="bi bi-user text-primary"></i>{{ $recent->getCommentCount() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Tag cloud --}}
                    @if (!empty($getRecord->getTag->count()))
                        <div class="mb-5">
                            <h2 class="mb-4">Tag Cloud</h2>
                            <div class="d-flex flex-wrap m-nl">
                                @foreach ($getRecord->getTag as $tag)
                                    <a href="{{ url('blog?q=' . $tag->name) }}"
                                        class="btn btn-outline-primary m-1">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="mb-5">
                        <img src="" alt="" class="img-fluid rounded">
                    </div>
                    <div>
                        <h2 class="mb-4">Plain Text</h2>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed dolore inventore libero eos,
                        consectetur quo accusantium temporibus eum ut, vel commodi fugit? Nobis nam hic nisi vitae quos
                        nihil? Natus maiores recusandae fugit animi veniam sit ex quia, necessitatibus, impedit doloremque
                        nesciunt placeat voluptatibus accusantium exercitationem repellat, consequuntur nisi ipsa.
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        $('.ReplyOpen').click(function() {
            var id = $(this).attr('id');
            $('.ShowReply' + id).toggle();
        });
    </script>
@endsection
