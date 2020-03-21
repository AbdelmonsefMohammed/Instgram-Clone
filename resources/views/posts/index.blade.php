@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-8">
                @foreach($posts as $post)
                <div class="row">
                    <div>
                        <a href="/profile/{{$post->user->id}}">
                            <img src="/storage/{{$post->image}}" class="w-100" alt="">
                        </a>
                    </div>
                </div>
                <div class="row pt-2 pb-4">
                    <div>
                        <div>
                            <p><span class="font-weight-bold">
                                <a href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                                </a>
                                </span> {{$post->caption}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                </div>
        </div>
        <div class="col-4">
                    @auth    
        <div class="card mt-3">
            <div class="card-header bg-light font-weight-bold">
               <a href="/following">Following</a> 
            </div>
        </div>
        @endauth

        </div>
    </div>
</div>
@endsection
