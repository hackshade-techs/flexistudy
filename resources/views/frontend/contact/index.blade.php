@extends('frontend.layouts.app')
    @section('title')
        {{trans('strings.frontend.contact-us')}}
    @stop
@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="left">
                    <h2 style="font-size: 35px;">Contact Us</h2>
                    <p><i class="fa fa-minus"></i><i class="fa fa-minus"></i></p>
                </div>
            </div>
        </div>
    </div>

 
    <section id="mc-section-3" class="mc-section-3 section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div id="courses" class="content grid">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissable fade in clearfix">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {!! $message !!}
                            </div>
                            <?php Session::forget('success');?>
                        @endif
                        
                        {!! Form::open(['action' => 'Frontend\ContactController@sendMail', 'method'=>'POST', 'files' => true]) !!}    
    	
                            <div class="form-group">
                                {!! Form::label("name", trans('strings.frontend.name')) !!}
                                {!! Form::text("name", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('name'))
                                    <div class="help-block text-danger"><small>{{ $errors->first('name') }}</small></div>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! Form::label("email", trans('strings.frontend.email')) !!}
                                {!! Form::text("email", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('email'))
                                    <div class="help-block text-danger"><small>{{ $errors->first('email') }}</small></div>
                                @endif
                            </div>
                           
                            <div class="form-group">
                                {!! Form::label("subject", trans('strings.frontend.subject')) !!}
                                {!! Form::text("subject", null, ['class'=>'form-control', 'required']) !!}
                                 @if ($errors->has('subject'))
                                    <div class="help-block text-danger"><small>{{ $errors->first('subject') }}</small></div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label("body", trans('strings.frontend.message')) !!}
                                {!! Form::textarea("body", null, ['class'=>'form-control']) !!}
                                 
                                @if ($errors->has('body'))
                                    <div class="help-block text-danger"><small>{{ $errors->first('body') }}</small></div>
                                @endif
                            </div>
                            @if (config('access.captcha.registration'))
                                <div class="form-group">
                                    {!! Form::captcha() !!}
                                    {{ Form::hidden('captcha_status', 'true') }}
                                </div>
                            @endif
				            {{ csrf_field() }}
				            
    				        <div class="form-group">
                                {!! Form::submit(trans('strings.frontend.send'), ['class'=>'btn btn-success pull-right']) !!}
                            </div>
				            
			            {!! Form::close() !!}
                        
                        
                    </div>
                </div>
                
            </div> <!--/ end row -->
        </div>
    </section>
    
@endsection


@section('after-scripts')
    {!! Captcha::script() !!}
@endsection