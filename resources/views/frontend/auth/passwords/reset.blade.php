@extends('frontend.layouts.app')
@section ('title', trans('labels.frontend.auth.reset_password_box_title'))
@section('after-styles')
    @include('frontend.auth._background_styles')
@stop

@section('content')
    <section id="login-content" class="login-content">
        @include('frontend.auth._background')
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ Form::open(['route' => 'frontend.auth.password.reset', 'class' => '']) }}
                            <h2 class="text-uppercase">{{trans('labels.frontend.auth.reset_password_box_title')}}</h2>
                            
                            <input type="hidden" name="token" value="{{ $token }}">
                            {{-- csrf_field() --}}
                            
                            <div class="form-email">
                                <input id="email" placeholder="{{trans('validation.attributes.frontend.email')}}" autocomplete="off" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-password">
                                <input id="password" placeholder="{{trans('validation.attributes.frontend.password')}}" type="password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-password">
                                <input id="password_confirmation" placeholder=" {{trans('validation.attributes.frontend.password_confirmation')}}" type="password" name="password_confirmation" required>
                            </div>
                            
                            <div class="form-submit-1">
                                <input type="submit" {{config('demo.demo_mode') ? 'disabled':''}} value="{{trans('labels.frontend.passwords.reset_password_button')}}" class="mc-btn btn-style-1">
                            </div>
                            
                        {{ Form::close() }}
                    </div>
                </div>
                <!-- END / FORM -->

                <div class="image">
                    
                </div>

            </div>
        </div>
    </section>

@endsection
