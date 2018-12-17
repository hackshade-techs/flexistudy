@extends('frontend.layouts.app')

@section ('title', trans('labels.frontend.auth.login_box_title'))

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
                        {{ Form::open(['route' => 'frontend.auth.login.post', 'class' => '']) }}
                            <h2 class="text-uppercase">{{ trans('labels.frontend.auth.login_box_title') }}</h2>
                            {{ csrf_field() }}
                            <div class="form-email">
                                <input id="email" placeholder="Username or Email" autocomplete="off" type="text" name="username" value="{{ old('email') }}" required autofocus>
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
                            
                            <div class="form-check">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="check">
                                <label for="check">
                                    <i class="icon fa fa-check"></i>
                                    {{ trans('labels.frontend.auth.remember_me') }}
                                </label>
                                <a href="{{ route('frontend.auth.password.reset') }}">{{trans('labels.frontend.passwords.forgot_password')}}</a>
                            </div>
                            
                            <div class="form-submit-1">
                                <input type="submit" value="{{trans('labels.frontend.auth.login_button')}}" class="mc-btn btn-style-1">
                            </div>
                            
                            <ul class="list-unstyled social-login">
                                {!! $socialite_links !!}
                                <!--
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'facebook']) }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'twitter']) }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'linkedin']) }}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'google']) }}"><i class="fa fa-google"></i></a></li>
                                <li><a href="{{ route('frontend.auth.social.login',['provider' => 'github']) }}"><i class="fa fa-github"></i></a></li>
                                -->
                            </ul>
                            
                            @if (config('access.users.registration'))
                                <div class="link">
                                    <a href="{{ route('frontend.auth.register') }}">
                                        <i class="icon fa fa-arrow-right"></i>{{trans('navs.frontend.register')}}
                                    </a>
                                </div>
                            @endif

@if(config('demo.demo_mode'))                          
                           <div class="">
				<center>Demo Credentials</center>
				<pre>
ADMINISTRATOR
-----------------------
email: admin@admin.com
password: password

AUTHOR
-----------------------
email: author@author.com
password: password

USER
-----------------------
email: user@user.com
password: password
				</pre>
				
@endif				
                            </div>
                        
                        {{ Form::close() }}
                        
                    </div>
                </div>
                <!-- END / FORM -->

                <div class="image">
                    <!--<img src="images/img-thumb.png" alt="">-->
                    
                </div>

            </div>
        </div>
    </section>
    <!-- END / LOGIN -->
                        
@endsection