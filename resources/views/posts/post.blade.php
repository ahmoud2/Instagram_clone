@extends('layouts.app')
@section('content')

    <div class="container">
        <main id="feed">
            <div class="photo">
                <header class="photo__header">
                    <img src="{{ url($post->user->profile->image) }}" class="photo__avatar" />
                    <div class="photo__user-info">
                        <span class="photo__author">{{ $post->user->name }}</span>
                        <span class="photo__location">{{ '@'.$post->user->username }}</span>
                    </div>
                </header>
                <img class="w-100" src="{{ url($post->image) }}" />
                <div class="photo__info">
                    <div class="photo__actions">
                        <span class="photo__action">
                            <i class="fa fa-heart-o fa-lg"></i>
                        </span>
                        <span class="photo__action">
                            <label for="comment-area"><i style="cursor: pointer" class="fa fa-comment-o fa-lg"></i></label>
                        </span>
                    </div>
                    <span class="photo__likes">45 likes</span>
                    <p class="my-2 mx-1">{{ $post->caption }}</p>
                    <ul class="photo__comments">
                        @forelse ($post->comments as $comment)
                            <li class="photo__comment bg-light py-2 px-3 rounded border border-gray">
                                <div class="d-flex justify-content-between">
                                    <span class="photo__comment-author" >{{ $comment->user->username }}</span>
                                    <div class="d-flex flex-column">

                                        <span class="photo__time-ago text-dark"> {{ date('F j, Y',strtotime($comment->created_at)) }}</span>
                                        <span class="photo__time-ago text-dark"> {{ 'At '.date('g:i a',strtotime($comment->created_at)) }}</span>
                                    </div>
                                </div>
                                <p class="ml-2 mt-1 mb-2">{{ $comment->comment }}</p>
                            </li>
                        
                        @empty
                        <li class="photo__comment bg-light py-2 px-3 rounded border border-gray">
                            <div class="d-flex justify-content-between">
                                No Comments Added Yet, Add One!
                            </div>
                        </li>
                        @endforelse
                        <li id="new-comment-section" class="photo__comment bg-light border border-gray py-2 px-3 rounded">
                            <div class="d-flex justify-content-between">
                                <span class="photo__comment-author" id="new-comment-username"></span>
                                <div class="d-flex flex-column">

                                    <span class="photo__time-ago" id="time-now"></span>
                                </div>
                            </div>
                            <p class="ml-2 mt-1 mb-2" id="new-comment"></p>
                        </li>
                    </ul>

                    @if (Auth()->user())  
                        <form action="#" id="add-comment" method="post">
                            @csrf
                            @method('post')
                            <div class="photo__add-comment-container">
                                <textarea id="comment-area" name="comment" placeholder="Add a comment..."></textarea>
                                <i class="fa fa-ellipsis-h"></i>
                            </div>
                            <input class="float-right my-3 py-2 px-3 btn-primary text-white rounded" type="submit" value="Add Comment">
                        </form>                      
                    @else
                        <div class="photo__add-comment-container">
                            <p class="text-primart font-weight-bold">Login To add a comment<a class="ml-2"  href="/login">Login</a></p>
                        </div>
                    @endif
                </div>
            </div>
            
        </main>
    </div>
@endsection
@section('js')
    <script>
            $('#new-comment-section').hide();
            $(document).ready(function (){
            $("#add-comment").submit(function (e){
                e.preventDefault();
                $.ajax({
                    url : '/comment/{{ $post->id }}',
                    type : 'POST',
                    data : {
                        '_token' : $('input[name="_token"]').val(),
                        'comment': $('textarea[name="comment"]').val()
                    },
                    //dataType:'json',
                    success : function(data) {
                        $('#new-comment-section').show();
                        $('#new-comment').html(data.comment);
                        $('#new-comment-username').html('{{ Auth()->user()->username }}');
                        $('#time-now').html('Now');
                        console.log(data.comment);
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
