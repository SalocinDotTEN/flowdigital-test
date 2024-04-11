@extends('layouts.bootstrap')

@section('content')
    <div class="col-lg-8">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <div class="col-lg-6">
                @foreach ($blogPosts as $post)
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->post_date }}</div>
                            <h2 class="card-title h4">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->content }}</p>
                            <a class="btn btn-primary" href="{{ route('article', [$post->slug]) }}">Read more →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
