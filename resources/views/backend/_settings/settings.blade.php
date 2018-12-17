@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.site-settings'))

@section('after-styles')
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
    <h1>{{ trans('strings.backend.site-settings') }}</h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-body">
            
            {!! Form::open(['route' => ['admin.settings.update'], 'method'=>'POST', 'files' => true, 'class' => 'form-horizontal']) !!}
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{trans('strings.backend.site-info')}}</legend>
 
                    <div class="form-group">
                        {!! Form::label("send_emails", trans('strings.backend.send-email-notification'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.send_emails') ? 'checked':null}} value="1" name="send_emails"> {{trans('strings.backend.yes')}}  
                        <span class="text-danger">({{trans('strings.backend.email-notification-help')}})</span>
                    </div>
                    <div class="form-group">
                        {!! Form::label("allow_video_upload", trans('strings.backend.allow-video-upload'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.allow_video_upload') ? 'checked':null}} value="1" name="allow_video_upload"> {{trans('strings.backend.yes')}}  
                    </div>
                    <div class="form-group">
                        {!! Form::label("allow_youtube_video", trans('strings.backend.allow-youtube-video'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.allow_youtube_video') ? 'checked':null}} value="1" name="allow_youtube_video"> {{trans('strings.backend.yes')}}  
                    </div>
                    <div class="form-group">
                        {!! Form::label("allow_vimeo_video", trans('strings.backend.allow-vimeo-video'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.allow_vimeo_video') ? 'checked':null}} value="1" name="allow_vimeo_video"> {{trans('strings.backend.yes')}}  
                    </div>
                    <div class="form-group">
                        {!! Form::label("allow_s3_video", trans('strings.backend.allow-s3-video'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.allow_s3_video') ? 'checked':null}} value="1" name="allow_s3_video"> {{trans('strings.backend.yes')}}  
                    </div>
                    <div class="form-group">
                        {!! Form::label("max_video_upload_size", trans('strings.backend.max-video-upload-video'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::number("max_video_upload_size", config('settings.max_video_upload_size'), ['class'=>'form-control', 'placeholder' => '500' ]) !!}
                                <span class="input-group-addon">MB</span>
                            </div>
                            @if ($errors->has('max_video_upload_size'))
                                <div class="text-danger"><small>{{ $errors->first('max_video_upload_size') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label("site_description", trans('strings.backend.site-description'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea("site_description", config('settings.site_description'), ['class'=>'form-control', 'rows' => '3']) !!}
                            @if ($errors->has('site_description'))
                                <div class="text-danger"><small>{{ $errors->first('site_description') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("site_theme", trans('strings.backend.theme-color'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <select name="site_theme" class="form-control">
                                <option value="green" {{ config('settings.site_theme') == 'green' ? 'selected' : '' }}>{{trans('strings.backend.green')}}</option>
                                <option value="blue" {{ config('settings.site_theme') == 'blue' ? 'selected' : '' }}>{{trans('strings.backend.blue')}}</option>
                                <option value="red" {{ config('settings.site_theme') == 'red' ? 'selected' : '' }}>Red</option>
                                <option value="olive" {{ config('settings.site_theme') == 'olive' ? 'selected' : '' }}>Olive Green</option>
                                <option value="grey" {{ config('settings.site_theme') == 'grey' ? 'selected' : '' }}>Grey</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("uploadLocation", trans('strings.backend.video-upload-location'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <p>{{trans('strings.backend.video-upload-help')}}</p>
                            <select name="uploadLocation" class="form-control">
                                <option value="local" {{ config('settings.uploadLocation') == 'local' ? 'selected' : '' }}>{{trans('strings.backend.save-on-local-server')}}</option>
                                <option value="s3" {{ config('settings.uploadLocation') == 's3' ? 'selected' : '' }}>{{trans('strings.backend.save-on-amazon')}}</option>
                            </select>
                            <small class="text-danger">{{trans('strings.backend.amazon-help')}}</small>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("google_analytics_code", trans('strings.backend.google-analytics-code'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("google_analytics_code", config('settings.google_analytics'), ['class'=>'form-control', 'placeholder' => 'UA-XXXXX-Y' ]) !!}
                             @if ($errors->has('google_analytics_code'))
                                <div class="text-danger"><small>{{ $errors->first('google_analytics_code') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label("pricelist", trans('strings.backend.pricelist'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("pricelist", config('settings.pricelist'), ['class'=>'form-control', 'placeholder' => '' ]) !!}
                            <span class="text-success">{{trans('strings.backend.pricelist-help')}}</span>
                             @if ($errors->has('pricelist'))
                                <div class="text-danger"><small>{{ $errors->first('pricelist') }}</small></div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label("currency_code", trans('strings.backend.site-currency-code'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("currency_code", config('settings.currency_code'), ['class'=>'form-control', 'placeholder' => 'USD' ]) !!}
                             @if ($errors->has('currency_code'))
                                <div class="text-danger"><small>{{ $errors->first('currency_code') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("currency_symbol", trans('strings.backend.site-currency-symbol'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("currency_symbol", config('settings.currency_symbol'), ['class'=>'form-control currency_symbol', 'placeholder' => '$' ]) !!}
                             @if ($errors->has('currency_symbol'))
                                <div class="text-danger"><small>{{ $errors->first('currency_symbol') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("currency_symbol_position", trans('strings.backend.position-of-currency-symbol'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                            <select name="currency_symbol_position" class="form-control currency_symbol_position">
                                <option value="front" {{ config('settings.currency_symbol_position') == 'front' ? 'selected' : '' }}>{{trans('strings.backend.to-the-left')}}</option>
                                <option value="back" {{ config('settings.currency_symbol_position') == 'back' ? 'selected' : '' }}>{{trans('strings.backend.to-the-right')}}</option>
                            </select>
                            <span class="input-group-addon example"></span>
                            </div>
                             @if ($errors->has('currency_symbol_position'))
                                <div class="text-danger"><small>{{ $errors->first('currency_symbol_position') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{trans('strings.backend.payment_gateways')}}</legend>
                    <div class="form-group">
                        {!! Form::label("enable_stripe", trans('strings.backend.enable_stripe'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.enable_stripe') ? 'checked':null}} value="1" name="enable_stripe"> {{trans('strings.backend.yes')}} 
                        <span class="text-danger">({{trans('strings.backend.enable_stripe_help')}})</span>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("enable_paypal", trans('strings.backend.enable_paypal'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.enable_paypal') ? 'checked':null}} value="1" name="enable_paypal"> {{trans('strings.backend.yes')}}  
                        <span class="text-danger">({{trans('strings.backend.enable_paypal_help')}})</span>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("enable_braintree", trans('strings.backend.enable_braintree'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.enable_braintree') ? 'checked':null}} value="1" name="enable_braintree"> {{trans('strings.backend.yes')}}  
                        <span class="text-danger">({{trans('strings.backend.enable_braintree_help')}})</span>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("enable_omise", trans('strings.backend.enable_omise'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.enable_omise') ? 'checked':null}} value="1" name="enable_omise"> {{trans('strings.backend.yes')}}  
                        <span class="text-danger">({{trans('strings.backend.enable_omise_help')}})</span>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("enable_razorpay", trans('strings.backend.enable_razorpay'), ['class' => 'col-sm-2 control-label']) !!}
                        <input type="checkbox" {{ config('settings.enable_razorpay') ? 'checked':null}} value="1" name="enable_razorpay"> {{trans('strings.backend.yes')}}  
                        <span class="text-danger">({{trans('strings.backend.enable_razorpay_help')}})</span>
                    </div>
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{trans('strings.backend.sales-and-commission')}}</legend>
                    <div class="form-group">
                        {!! Form::label("organicSalesPercentage", trans('strings.backend.author-percentage'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number("organicSalesPercentage", config('settings.organicSalesPercentage'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                             @if ($errors->has('organicSalesPercentage'))
                                <div class="text-danger"><small>{{ $errors->first('organicSalesPercentage') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("promoSalesPercentage", trans('strings.backend.author-percentage-promotion'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number("promoSalesPercentage", config('settings.promoSalesPercentage'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                            @if ($errors->has('promoSalesPercentage'))
                                <div class="text-danger"><small>{{ $errors->first('promoSalesPercentage') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("minimumPayoutAmount", trans('strings.backend.author-minimum-payout-amount'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number("minimumPayoutAmount", config('settings.minimumPayoutAmount'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                            <div class="text-success"><small>{{ trans('strings.backend.author-minimum-payout-amount-help') }}</small></div>
                            @if ($errors->has('minimumPayoutAmount'))
                                <div class="text-danger"><small>{{ $errors->first('minimumPayoutAmount') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{trans('strings.backend.affiliate-settings')}}</legend>
                    <div class="form-group">
                        {!! Form::label("affiliateSalesPercentage", trans('strings.backend.affiliate-percentage'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number("affiliateSalesPercentage", config('settings.affiliateSalesPercentage'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                            <div class="text-success"><small>{{ trans('strings.backend.affiliate-percentage-help') }}</small></div>
                            @if ($errors->has('affiliateSalesPercentage'))
                                <div class="text-danger"><small>{{ $errors->first('affiliateSalesPercentage') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("affiliate_cookie_lifetime", trans('strings.backend.affiliate-cookie-lifetime'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::number("affiliate_cookie_lifetime", config('settings.affiliate_cookie_lifetime'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                            <div class="text-success"><small>{{ trans('strings.backend.affiliate-cookie-help') }}</small></div>
                            @if ($errors->has('affiliate_cookie_lifetime'))
                                <div class="text-danger"><small>{{ $errors->first('affiliate_cookie_lifetime') }}</small></div>
                            @endif
                        </div>
                    </div>
                </fieldset>
                
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Google Adsense</legend>
                    
                    <div class="form-group">
                        {!! Form::label("adsense_ad_client", trans('strings.backend.adsense_ad_client'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("adsense_ad_client", config('settings.adsense_ad_client'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                             @if ($errors->has('adsense_ad_client'))
                                <div class="text-danger"><small>{{ $errors->first('adsense_ad_client') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("adsense_sidebar_responsive_slot", trans('strings.backend.adsense_sidebar_responsive_slot'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("adsense_sidebar_responsive_slot", config('settings.adsense_sidebar_responsive_slot'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                             @if ($errors->has('adsense_sidebar_responsive_slot'))
                                <div class="text-danger"><small>{{ $errors->first('adsense_sidebar_responsive_slot') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("adsense_top_responsive_slot", trans('strings.backend.adsense_top_responsive_slot'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text("adsense_top_responsive_slot", config('settings.adsense_top_responsive_slot'), ['class'=>'form-control', 'placeholder' => '100' ]) !!}
                             @if ($errors->has('adsense_top_responsive_slot'))
                                <div class="text-danger"><small>{{ $errors->first('adsense_top_responsive_slot') }}</small></div>
                            @endif
                        </div>
                    </div>
                    
                </fieldset>
                
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">{{trans('strings.backend.social-network-accounts')}}</legend>
                    
                    <div class="form-group">
                        {!! Form::label("social_facebook", "Facebook:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-facebook text-primary"></i> https://www.facebook.com/</span>
                                {!! Form::text("social_facebook", config('settings.social_facebook'), ['class'=>'form-control']) !!}
                                @if ($errors->has('social_facebook'))
                                    <div class="text-danger"><small>{{ $errors->first('social_facebook') }}</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("social_twitter", "Twitter:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter text-info"></i> https://www.twitter.com/</span>
                                {!! Form::text("social_twitter", config('settings.social_twitter'), ['class'=>'form-control']) !!}
                                 @if ($errors->has('social_twitter'))
                                    <div class="text-danger"><small>{{ $errors->first('social_twitter') }}</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("social_google", "GooglePlus:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-google text-danger"></i> https://plus.google.com/</span>
                                {!! Form::text("social_google", config('settings.social_google'), ['class'=>'form-control']) !!}
                                 @if ($errors->has('social_google'))
                                    <div class="text-danger"><small>{{ $errors->first('social_google') }}</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("social_youtube", "Youtube:", ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-youtube text-danger"></i> https://youtube.com/</span>
                                {!! Form::text("social_youtube", config('settings.social_youtube'), ['class'=>'form-control']) !!}
                                 @if ($errors->has('social_youtube'))
                                    <div class="text-danger"><small>{{ $errors->first('social_youtube') }}</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label("contact_email", trans('strings.backend.contact-email'), ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope text-default"></i></span>
                                {!! Form::text("contact_email", config('settings.contact_email'), ['class'=>'form-control']) !!}
                                 @if ($errors->has('contact_email'))
                                    <div class="text-danger"><small>{{ $errors->first('contact_email') }}</small></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </fieldset>   
            
                <div class="form-group">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> {{trans('strings.backend.save')}}</button>
                    </div>
                </div>
              
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              
            {!! Form::close() !!}
            
            
            
            
            
            
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')
    <script type="text/javascript">
    
        $(document).ready(function(){
            var pos = $('.currency_symbol_position').val();
            var sym = $('.currency_symbol').val();
            if(pos == 'front'){
                $('.example').html('<b>'+sym+'10</b>');  
            } else {
                $('.example').html('<b>10'+sym+'</b>');
            }
        });
        
        $('.currency_symbol').keyup(function(){
            var pos = $('.currency_symbol_position').val();
            var sym = $('.currency_symbol').val();
            if(pos == 'front'){
                $('.example').html('<b>'+sym+'10</b>');  
            } else {
                $('.example').html('<b>10'+sym+'</b>');
            } 
        });
        
        $('.currency_symbol_position').change(function(){
            var pos = $('.currency_symbol_position').val();
            var sym = $('.currency_symbol').val();
            if(pos == 'front'){
                $('.example').html('<b>'+sym+'10</b>');  
            } else {
                $('.example').html('<b>10'+sym+'</b>');
            }
            
        });
    </script>
@endsection