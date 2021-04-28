@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center mb-4">
            <h3 class="text-center text-dark">{{__('Create a Post')}}</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 ">
                <form action="{{ url('/posts') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    {{-- Caption Field --}}
                    <div class="form-group row ">
                        <label for="caption" class="col-md-4 col-form-label font-weight-bold  text-md-right">{{ __('Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" placeholder="Caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption">

                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    {{-- End Of Caption Field --}}

                    {{-- Image Field --}}
                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label font-weight-bold text-md-right">{{ __('Image') }}</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    {{-- End Of Image Field --}}
                    {{--  Submit button   --}}
                    <div class="form-group row justify-content-center ml-4">
                        <div class="col-md-6 ml-4">
                            <input id="submit" type="submit" name="submit" class="btn btn-primary ml-4 py-2 px-3 text-white" value="Add New Post">
                        </div>
                    </div>
                    {{--  End of Submit button   --}}
                </form>
            </div>
        </div>
    </div>
@endsection

