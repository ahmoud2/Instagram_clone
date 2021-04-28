@extends('layouts.app')

@section('content')
    <main id="profile">
        <header class="profile__header">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center">
                    <img class="rounded-circle w-50" src="{{ url($user->profile->image) }}" />
                </div>
                <div class="col-md-8 wrapper-for-profile-info">
                    <div class="">
                        <div class="row ml-1 justify-content-between">
                            <div class="wrapper-username-follow  profile__title d-flex  ">
                                <p class="font-weight-bolder mr-3 pt-1">
                                    {{ $user->username }}
                                </p>
                                @if((Auth()->user()->id ?? '') != $user->id )
                                    <form id="follows-form" action="/follow/{{ $user->id }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button id="follow-button" type="submit" class="px-2 py-1 font-weight-bold bg-primary text-white">{{ ($follows == true)? 'Following' : 'Follow' }}</button>
                                    </form>
                                @endif
                            </div>
                            @can('update',$user->profile)
                                <div class="add-new-post  profile__title mt-1">
                                    <a href="/posts/create" class="font-weight-bold bg-light text-dark" style="text-decoration: none"> Add New post</a>
                                </div>
                            @endcan
                        </div>
                        <div class="profile__title  my-3">
                            @can('update',$user->profile)
                                <a href="/profiles/{{ $user->username }}/edit">Edit profile</a>
                                <i class="fa fa-cog fa-lg"></i>
                            @endcan
                        </div>
                        <ul class=" d-flex my-2">
                            <li class="profile__stat mr-2">
                                <span class="stat__number">{{ $user->posts->count() }}</span> posts
                            </li>
                            <li class="profile__stat mr-2">
                                <span class="stat__number">{{ $user->profile->followers->count() }}</span> followers
                            </li>
                            <li class="profile__stat mr-2">
                                <span class="stat__number">{{ $user->following->count() }}</span> following
                            </li>
                        </ul>
                        <p class="profile__bio my-2">
                        <span class="profile__full-name ">
                            {{ $user->name }}
                        </span><br>
                        <p class="my-2 text-wrap">{{ $user->profile->description }}</p>
                        <a class="" href="{{ $user->profile->link }}">{{ $user->profile->link }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </header>
        <section class="profile__photos w-100">
            <div class="container">
                <div class="row justify-content-sm-center">
                    @forelse ($user->posts as $post)
                        <div class="col-md-6 col-lg-4">
                            <a href="/posts/{{ $post->id }}">
                                <div class="profile__photo mx-auto">
                                    <img class="" src="{{url($post->image)}}" />
                                    <div class="profile__photo-overlay">
                                        <span class="overlay__item">
                                            <i class="fa fa-heart"></i>
                                            486
                                        </span>
                                        <span class="overlay__item">
                                            <i class="fa fa-comment"></i>
                                            344
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h3>No Posts Founded</h3>
                    @endforelse
                </div>
            </div>

        </section>
    </main>
@endsection

@section('js')
    <script >
        $(document).ready(function (){
            $("#follows-form").submit(function (e){
                e.preventDefault();
                $.ajax({
                    url : '/follow/{{ $user->id }}',
                    type : 'POST',
                    data : {
                        '_token' : $('input[name="_token"]').val()
                    },
                    //dataType:'json',
                    success : function(data) {
                        data = JSON.parse(data);
                        if(data.follow == 1){
                            $("#follow-button").html('Unfollow');
                        }else{
                            $("#follow-button").html('Follow');
                        }
                        console.log(data.follow);
                    },
                    error : function(request,error)
                    {
                        if(request.status == 401){
                            window.location = '/login';
                        }
                    }
                });
            });

        });
    </script>
@endsection
