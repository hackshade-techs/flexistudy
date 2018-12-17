@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-environment-variables'))

@section('after-styles')
    <link href="/public/css/backend/plugin/jquery-linedtextarea.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <style type="text/css">
        .textarea{
            width: 100%;
            height: 80%;
            background: #e5f2f7;
        }
        
        textarea {
            resize: none;
        }
        legend {
            display: block;
            width: 100%;
            margin-bottom: 20px;
            font-size: 21px;
            line-height: inherit;
            color: #545454;
            font-weight: bold;
            border-bottom: 0px solid #c7c7c7;
            padding-left: 10px;
            background: #b8d4c7;
        }
        fieldset {
            margin: 0;
            min-width: 0;
            border: 2px solid #b8d4c7 !important;
            padding: 20px !important;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('page-header')
    <h1>
        {{trans('strings.backend.manage-environment-variables')}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-body">
            
            
            <form method="post" action="{{ route('admin.settings.env.save') }}" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="col-md-6">
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Application Settings</legend>
                    <div class="form-group">
                        {!! Form::label("app_name", "Application Name:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="app_name" type="text" value="{{ config('demo.demo_mode') ? '************' : env('APP_NAME') }}" id="mail_from_address" class="form-control">
                            @if ($errors->has('app_name'))
                                <div class="text-danger"><small>{{ $errors->first('app_name') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("app_env", "App Environment:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="app_env" class="form-control">
                                <option value="local" {{ env('APP_ENV') == 'local' ? 'selected' : '' }}>Local</option>
                                <option value="production" {{ env('APP_ENV') == 'production' ? 'selected' : '' }}>Production</option>
                            </select>
                            @if ($errors->has('app_env'))
                                <div class="text-danger"><small>{{ $errors->first('app_env') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("app_debug", "App Debug:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <label for="app_debug_true">
                                <input type="radio" name="app_debug" id="app_debug_true" value=true {{ env('APP_DEBUG') ? 'checked' : '' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                            </label>
                            <label for="app_debug_false">
                                <input type="radio" name="app_debug" id="app_debug_false" value=false {{ env('APP_DEBUG') ? '' : 'checked' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                            </label>
                            @if ($errors->has('app_debug'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('app_debug') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("app_url", "App URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="app_url" type="text" value="{{ config('demo.demo_mode') ? '************' : env('APP_URL') }}" id="app_url" class="form-control">
                            @if ($errors->has('app_url'))
                                <div class="text-danger"><small>{{ $errors->first('app_url') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("app_locale", "App Locale:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="app_locale" class="form-control">
                                @foreach($languages as $key => $lang)
                                    <option value="{{$key}}" {!! $key==env('APP_LOCALE') ? 'selected="selected"' : '' !!}>{{$lang}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('app_locale'))
                                <div class="text-danger"><small>{{ $errors->first('app_locale') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("app_fallback_locale", "App Fallback Locale:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="app_fallback_locale" class="form-control">
                                @foreach($languages as $key => $lang)
                                    <option value="{{$key}}" {!! $key==env('APP_FALLBACK_LOCALE') ? 'selected="selected"' : '' !!}>{{$lang}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('app_fallback_locale'))
                                <div class="text-danger"><small>{{ $errors->first('app_fallback_locale') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset> 
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Database Settings</legend>
                    <div class="form-group">
                        {!! Form::label("db_connection", "Database Connection:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_connection" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_CONNECTION') }}" id="db_connection" class="form-control">
                            @if ($errors->has('db_connection'))
                                <div class="text-danger"><small>{{ $errors->first('db_connection') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("db_connection", "Database Connection:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_host" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_HOST') }}" id="db_host" class="form-control">
                            @if ($errors->has('db_host'))
                                <div class="text-danger"><small>{{ $errors->first('db_host') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("db_port", "Database Port:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_port" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_PORT') }}" id="db_port" class="form-control">
                            @if ($errors->has('db_port'))
                                <div class="text-danger"><small>{{ $errors->first('db_port') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("db_database", "Database Name:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_database" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_DATABASE') }}" id="db_database" class="form-control">
                            @if ($errors->has('db_database'))
                                <div class="text-danger"><small>{{ $errors->first('db_database') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("db_username", "Database Username:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_username" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_USERNAME') }}" id="db_username" class="form-control">
                            @if ($errors->has('db_username'))
                                <div class="text-danger"><small>{{ $errors->first('db_username') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("db_password", "Database Password:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="db_password" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DB_PASSWORD') }}" id="db_password" class="form-control">
                            @if ($errors->has('db_password'))
                                <div class="text-danger"><small>{{ $errors->first('db_password') }}</small></div>
                            @endif
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Mail Settings</legend>
                    <div class="form-group">    
                        {!! Form::label("mail_driver", "Mail Driver:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_driver" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_DRIVER') }}" id="mail_driver" class="form-control">
                            @if ($errors->has('mail_driver'))
                                <div class="text-danger"><small>{{ $errors->first('mail_driver') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mail_host", "Mail Host:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_host" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_HOST') }}" id="mail_host" class="form-control">
                            @if ($errors->has('mail_host'))
                                <div class="text-danger"><small>{{ $errors->first('mail_host') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mail_port", "Mail Port:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_port" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_PORT') }}" id="mail_port" class="form-control">
                            @if ($errors->has('mail_port'))
                                <div class="text-danger"><small>{{ $errors->first('mail_port') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mail_username", "Mail Username:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_username" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_USERNAME') }}" id="mail_username" class="form-control">
                            @if ($errors->has('mail_username'))
                                <div class="text-danger"><small>{{ $errors->first('mail_username') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mail_password", "Mail Password:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_password" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_PASSWORD') }}" id="mail_password" class="form-control">
                            @if ($errors->has('mail_password'))
                                <div class="text-danger"><small>{{ $errors->first('mail_password') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mailgun_domain", "Mailgun Domain:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mailgun_domain" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAILGUN_DOMAIN') }}" id="mailgun_domain" class="form-control">
                            @if ($errors->has('mailgun_domain'))
                                <div class="text-danger"><small>{{ $errors->first('mailgun_domain') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mailgun_secret", "Mailgun Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mailgun_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAILGUN_SECRET') }}" id="mailgun_secret" class="form-control">
                            @if ($errors->has('mailgun_secret'))
                                <div class="text-danger"><small>{{ $errors->first('mailgun_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("mail_from_address", "Mail From Address:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_from_address" type="email" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_FROM_ADDRESS') }}" id="mail_from_address" class="form-control">
                            @if ($errors->has('mail_from_address'))
                                <div class="text-danger"><small>{{ $errors->first('mail_from_address') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("mail_from_name", "Mail From Name:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="mail_from_name" type="text" value="{{ config('demo.demo_mode') ? '************' : env('MAIL_FROM_NAME') }}" id="mail_from_name" class="form-control">
                            @if ($errors->has('mail_from_name'))
                                <div class="text-danger"><small>{{ $errors->first('mail_from_name') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Payment Settings</legend>
                    <div class="form-group">    
                        {!! Form::label("stripe_key", "Stripe Publishable Key:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="stripe_key" type="text" value="{{ config('demo.demo_mode') ? '************' : env('STRIPE_KEY') }}" id="stripe_key" class="form-control">
                            @if ($errors->has('stripe_key'))
                                <div class="text-danger"><small>{{ $errors->first('stripe_key') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("stripe_secret", "Stripe Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="stripe_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('STRIPE_SECRET') }}" id="stripe_secret" class="form-control">
                            @if ($errors->has('stripe_secret'))
                                <div class="text-danger"><small>{{ $errors->first('stripe_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("paypal_mode", "PayPal Mode:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="paypal_mode" class="form-control">
                                <option value="sandbox" {!! env('PAYPAL_MODE') == 'sandbox' ? 'selected="selected"' : '' !!}>Sandbox</option>
                                <option value="live" {!! env('PAYPAL_MODE') == 'live' ? 'selected="selected"' : '' !!}>Live</option>
                            </select>
                            @if ($errors->has('paypal_mode'))
                                <div class="text-danger"><small>{{ $errors->first('paypal_mode') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("paypal_client_id", "PayPal Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="paypal_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('PAYPAL_CLIENT_ID') }}" id="paypal_client_id" class="form-control">
                            @if ($errors->has('paypal_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('paypal_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("paypal_secret", "PayPal Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="paypal_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('PAYPAL_SECRET') }}" id="paypal_secret" class="form-control">
                            @if ($errors->has('paypal_secret'))
                                <div class="text-danger"><small>{{ $errors->first('paypal_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Security and Access Settings</legend>
                    <div class="form-group">
                        {!! Form::label("enable_registration", "Enable User Registration:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <label for="enable_registration_true">
                                <input type="radio" name="enable_registration" id="enable_registration_true" value=true {{ env('ENABLE_REGISTRATION') ? 'checked' : '' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                            </label>
                            <label for="enable_registration_false">
                                <input type="radio" name="enable_registration" id="enable_registration_false" value=false {{ env('ENABLE_REGISTRATION') ? '' : 'checked' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                            </label>
                            @if ($errors->has('enable_registration'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('enable_registration') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("registration_captcha_status", "Enable CAPTCHA:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <label for="registration_captcha_status_true">
                                <input type="radio" name="registration_captcha_status" id="registration_captcha_status_true" value=true {{ env('REGISTRATION_CAPTCHA_STATUS') ? 'checked' : '' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                            </label>
                            <label for="registration_captcha_status_false">
                                <input type="radio" name="registration_captcha_status" id="registration_captcha_status_false" value=false {{ env('REGISTRATION_CAPTCHA_STATUS') ? '' : 'checked' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                            </label>
                            @if ($errors->has('registration_captcha_status'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('registration_captcha_status') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("nocaptcha_sitekey", "NOCAPTCHA Site Key:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="nocaptcha_sitekey" type="text" value="{{ config('demo.demo_mode') ? '************' : env('NOCAPTCHA_SITEKEY') }}" id="nocaptcha_sitekey" class="form-control">
                            @if ($errors->has('nocaptcha_sitekey'))
                                <div class="text-danger"><small>{{ $errors->first('nocaptcha_sitekey') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("nocaptcha_secret", "NOCAPTCHA Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="nocaptcha_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('NOCAPTCHA_SECRET') }}" id="nocaptcha_secret" class="form-control">
                            @if ($errors->has('nocaptcha_secret'))
                                <div class="text-danger"><small>{{ $errors->first('nocaptcha_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                </div>
                
                <div class="col-md-6">
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">AWS Storage Settings</legend>
                    <div class="form-group">    
                        {!! Form::label("aws_key", "Amazon Web Service Key:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="aws_key" type="text" value="{{ config('demo.demo_mode') ? '************' : env('AWS_KEY') }}" id="aws_key" class="form-control">
                            @if ($errors->has('aws_key'))
                                <div class="text-danger"><small>{{ $errors->first('aws_key') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("aws_secret", "Amazon Web Service Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="aws_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('AWS_SECRET') }}" id="aws_secret" class="form-control">
                            @if ($errors->has('aws_secret'))
                                <div class="text-danger"><small>{{ $errors->first('aws_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("aws_region", "S3 Bucket Region:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="aws_region" type="text" value="{{ config('demo.demo_mode') ? '************' : env('AWS_REGION') }}" id="aws_region" class="form-control">
                            @if ($errors->has('aws_region'))
                                <div class="text-danger"><small>{{ $errors->first('aws_region') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">    
                        {!! Form::label("aws_bucket", "S3 Bucket:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="aws_bucket" type="text" value="{{ config('demo.demo_mode') ? '************' : env('AWS_BUCKET') }}" id="aws_bucket" class="form-control">
                            @if ($errors->has('aws_bucket'))
                                <div class="text-danger"><small>{{ $errors->first('aws_bucket') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Commenting</legend>
                    <div class="form-group">    
                        {!! Form::label("disqus_enabled", "Enable Disqus Commenting:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <label for="disqus_enabled_true">
                                <input type="radio" name="disqus_enabled" id="disqus_enabled_true" value=true {{ env('DISQUS_ENABLED') ? 'checked' : '' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_true') }}
                            </label>
                            <label for="disqus_enabled_false">
                                <input type="radio" name="disqus_enabled" id="disqus_enabled_false" value=false {{ env('DISQUS_ENABLED') ? '' : 'checked' }} />
                                {{ trans('installer_messages.environment.wizard.form.app_debug_label_false') }}
                            </label>
                            @if ($errors->has('disqus_enabled'))
                                <span class="error-block">
                                    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $errors->first('disqus_enabled') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("disqus_username", "Disqus Shortname:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="disqus_username" type="text" value="{{ config('demo.demo_mode') ? '************' : env('DISQUS_USERNAME') }}" id="disqus_username" class="form-control">
                            @if ($errors->has('disqus_username'))
                                <div class="text-danger"><small>{{ $errors->first('disqus_username') }}</small></div>
                            @endif
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Social Login</legend>
                    <div class="form-group">    
                        {!! Form::label("facebook_client_id", "Facebook Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="facebook_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('FACEBOOK_CLIENT_ID') }}" id="facebook_client_id" class="form-control">
                            @if ($errors->has('facebook_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('facebook_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("facebook_client_secret", "Facebook Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="facebook_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('FACEBOOK_CLIENT_SECRET') }}" id="facebook_client_secret" class="form-control">
                            @if ($errors->has('facebook_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('facebook_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("facebook_redirect", "Facebook Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="facebook_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('FACEBOOK_REDIRECT') }}" id="facebook_redirect" class="form-control">
                            @if ($errors->has('facebook_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('facebook_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">    
                        {!! Form::label("bitbucket_client_id", "BitBucket Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="bitbucket_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('BITBUCKET_CLIENT_ID') }}" id="bitbucket_client_id" class="form-control">
                            @if ($errors->has('bitbucket_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('bitbucket_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("bitbucket_client_secret", "BitBucket Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="bitbucket_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('BITBUCKET_CLIENT_SECRET') }}" id="bitbucket_client_secret" class="form-control">
                            @if ($errors->has('bitbucket_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('bitbucket_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("bitbucket_redirect", "BitBucket Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="bitbucket_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('BITBUCKET_REDIRECT') }}" id="bitbucket_redirect" class="form-control">
                            @if ($errors->has('bitbucket_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('bitbucket_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <hr />
                    <div class="form-group">    
                        {!! Form::label("github_client_id", "GitHub Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="github_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('GITHUB_CLIENT_ID') }}" id="github_client_id" class="form-control">
                            @if ($errors->has('github_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('github_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("github_client_secret", "GitHub Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="github_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('GITHUB_CLIENT_SECRET') }}" id="github_client_secret" class="form-control">
                            @if ($errors->has('github_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('github_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("bitbucket_redirect", "BitBucket Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="bitbucket_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('BITBUCKET_REDIRECT') }}" id="bitbucket_redirect" class="form-control">
                            @if ($errors->has('bitbucket_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('bitbucket_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <hr />
                    <div class="form-group">    
                        {!! Form::label("google_client_id", "Google Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="google_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('GOOGLE_CLIENT_ID') }}" id="google_client_id" class="form-control">
                            @if ($errors->has('google_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('google_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("google_client_secret", "Google Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="google_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('GOOGLE_CLIENT_SECRET') }}" id="google_client_secret" class="form-control">
                            @if ($errors->has('google_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('google_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("google_redirect", "Google Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="google_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('GOOGLE_REDIRECT') }}" id="google_redirect" class="form-control">
                            @if ($errors->has('google_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('google_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <hr />
                    <div class="form-group">    
                        {!! Form::label("twitter_client_id", "Twitter Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="twitter_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('TWITTER_CLIENT_ID') }}" id="twitter_client_id" class="form-control">
                            @if ($errors->has('twitter_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('twitter_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("twitter_client_secret", "Twitter Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="twitter_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('TWITTER_CLIENT_SECRET') }}" id="twitter_client_secret" class="form-control">
                            @if ($errors->has('twitter_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('twitter_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("twitter_redirect", "Twitter Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="twitter_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('TWITTER_REDIRECT') }}" id="twitter_redirect" class="form-control">
                            @if ($errors->has('twitter_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('twitter_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <hr />
                    <div class="form-group">    
                        {!! Form::label("linkedin_client_id", "LinkedIn Client ID:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="linkedin_client_id" type="text" value="{{ config('demo.demo_mode') ? '************' : env('LINKEDIN_CLIENT_ID') }}" id="linkedin_client_id" class="form-control">
                            @if ($errors->has('linkedin_client_id'))
                                <div class="text-danger"><small>{{ $errors->first('linkedin_client_id') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("linkedin_client_secret", "LinkedIn Client Secret:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="linkedin_client_secret" type="text" value="{{ config('demo.demo_mode') ? '************' : env('LINKEDIN_CLIENT_SECRET') }}" id="linkedin_client_secret" class="form-control">
                            @if ($errors->has('linkedin_client_secret'))
                                <div class="text-danger"><small>{{ $errors->first('linkedin_client_secret') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">    
                        {!! Form::label("linkedin_redirect", "LinkedIn Redirect URL:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <input name="linkedin_redirect" type="text" value="{{ config('demo.demo_mode') ? '************' : env('LINKEDIN_REDIRECT') }}" id="linkedin_redirect" class="form-control">
                            @if ($errors->has('linkedin_redirect'))
                                <div class="text-danger"><small>{{ $errors->first('linkedin_redirect') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <hr />
                    
                </fieldset>
                </div>
                <div class="buttons buttons--right form-group">
                    <button class="btn btn-success btn-lg pull-right" type="submit">{{ trans('installer_messages.environment.save') }}</button>
                </div>
            </form>
            
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')

@endsection