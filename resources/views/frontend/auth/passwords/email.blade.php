@extends('frontend.layouts.app')
@section ('title', trans('labels.frontend.auth.reset_password_box_title'))
@section('after-styles')
    @include('frontend.auth._background_styles')
@stop

@section('content')
    <!-- LOGIN -->
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
                        {{ Form::open(['route' => 'frontend.auth.password.email.post', 'class' => '']) }}
                            <h2 class="text-uppercase">{{ trans('labels.frontend.passwords.reset_password_box_title') }}</h2>
                            {{ csrf_field() }}
                            
                            <div class="form-email">
                                <input id="email" placeholder="{{trans('validation.attributes.frontend.email')}}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
	                            <div class="form-submit-1">
	                                <input type="submit" {{config('demo.demo_mode') ? 'disabled':''}} value="{{trans('labels.frontend.passwords.send_password_reset_link_button')}}" class="mc-btn btn-style-1">
	                            </div>
                            <div class="link">
                                <a href="{{ route('frontend.auth.login') }}">
                                    <i class="icon fa fa-arrow-right"></i>{{trans('navs.frontend.login')}}
                                </a>
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
    <!-- END / LOGIN -->

@endsection