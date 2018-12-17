@extends('frontend.layouts.app')
@section ('title', trans('labels.frontend.auth.register_box_title'))

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
                <div class="col-xs-12 col-lg-5 pull-right">
                    <div class="form-login">
                        {{ Form::open(['route' => 'frontend.auth.register.post', 'class' => '']) }}
                            <h2 class="text-uppercase">{{ trans('labels.frontend.auth.register_box_title') }}</h2>
                            {{ csrf_field() }}
                            <div class="form-email">
                                <input id="first_name" placeholder="{{trans('validation.attributes.frontend.first_name')}}" type="text" autocomplete="off" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-email">
                                <input id="last_name" placeholder="{{trans('validation.attributes.frontend.last_name')}}" type="text" autocomplete="off" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-email">
                                <input id="username" placeholder="{{trans('validation.attributes.frontend.username')}}" type="text" autocomplete="off" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-email">
                                <input id="email" placeholder="{{trans('validation.attributes.frontend.email')}}" type="email" autocomplete="off" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-password">
                                <input id="password" placeholder="{{trans('validation.attributes.frontend.password')}}" autocomplete="off" type="password" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-password">
                                <input id="password_confirmation" autocomplete="off" placeholder="{{trans('validation.attributes.frontend.password_confirmation')}}" type="password" name="password_confirmation" required>
                            </div>
                            <br />
                            
                            @if (config('access.captcha.registration'))
                                <div class="form-password">
                                    {!! Form::captcha() !!}
                                    {{ Form::hidden('captcha_status', 'true') }}
                                </div>
                            @endif
                            
                            <div class="form-submit-1">
                                <input type="submit" value="{{trans('labels.frontend.auth.register_button')}}" class="mc-btn btn-style-1">
                            </div>
                            
                            <ul class="list-unstyled social-login">
                                
                                <!--
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'facebook']) }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'google']) }}"><i class="fa fa-google"></i></a></li>
                                
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'twitter']) }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'linkedin']) }}"><i class="fa fa-linkedin"></i></a></li>
                                
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'github']) }}"><i class="fa fa-github"></i></a></li>
                                -->
                            </ul>
                            
                            <div class="link">
                                <a href="{{ route('frontend.auth.login') }}">
                                    <i class="icon fa fa-arrow-right"></i>{{trans('navs.frontend.login')}}
                                </a>
                            </div>
                    
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('after-scripts')
    @if (config('access.captcha.registration'))
        {!! Captcha::script() !!}
    @endif
@endsection