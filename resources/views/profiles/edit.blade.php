@extends('layouts.app')
@section('content')
    <main id="edit-profile">
        <div class="edit-profile__container">
            <header class="edit-profile__header">
                <div class="edit-profile__avatar-container">
                    <img src="{{url($user->profile->image)}}" class="edit-profile__avatar" />
                </div>
                <h4 class="edit-profile__username">{{ $user->username }}</h4>
            </header>

            <form action="/profiles/{{ $user->username }}" method="POST" class="edit-profile__form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form__row">
                    <label for="full-name" class="form__label">Name:</label>
                    <input id="full-name" type="text"
                           placeholder="Full Name" type="text"
                           class="form__input @error('name') is-invalid @enderror"
                           name="name" value="{{ $user->name ?? old('name')}}"
                           autocomplete="name"/>
                    @error('name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
                <div class="form__row">
                    <label for="user-name" class="form__label">Username:</label>
                    <input id="user-name" type="text"
                           placeholder="Username" type="text"
                           class="form__input @error('username') is-invalid @enderror"
                           name="username" value="{{ $user->username ?? old('username')}}"
                           autocomplete="username"/>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form__row">
                    <label for="website" class="form__label">Website:</label>
                    <input id="website" type="text"
                           class="form__input @error('link') is-invalid @enderror"
                           name="link"
                           value="{{ $user->profile->link ?? old('link')}}"
                           autocomplete="link"/>
                    @error('link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form__row">
                    <label for="bio" class="form__label">Bio:</label>
                    <textarea id="bio"
                              placeholder="description"
                              class="form__input @error('description') is-invalid @enderror"
                              name="description"
                              autocomplete="description"
                              rows="3"
                    >{{ $user->profile->description ?? old('description')}}
                    </textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form__row">
                    <label for="email" class="form__label">Profile Photo:</label>
                    <input id="image" type="file"
                           class="form__input @error('image') is-invalid @enderror"
                           name="image" value="{{ old('image') }}"  autocomplete="image">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </main>
@endsection

