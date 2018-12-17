@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }}
@endsection

@section('meta_description')
    {{ $course->subtitle }}
@endsection
@section('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@stop
@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="left">
                    <h2 style="font-size: 35px;">{{ $course->title }}</h2>
                    <p style="margin-bottom: 5px;">{{ $course->subtitle }}</p>
                    <div class="well button-set one"> 
                        <p style="margin-bottom: 0px;">
                            {{trans('strings.frontend.created-by')}}
                            <a href="{{route('frontend.user.public.profile', $course->author)}}" style="color: #9edcf9;">
                                {{$course->author->name}}
                            </a>
                        </p>
                        <stars :rating="{{$course->average_rating}}" size="25"></stars>
                        @if($course->total_reviews > 0 )
                            <span>{{$course->average_rating}}</span>
                            <span class="text-muted"> 
                                ({{trans('strings.frontend.average_rating_from_reviews', ['number' => $course->reviews->count(), 'review' => str_plural(trans('strings.frontend.review'), $course->reviews->count())]) }})
                            </span>
                        @endif
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- END / SUB BANNER -->
    <!-- COURSE -->
    
    <section class="course-top">
        <div class="container">
            
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissable fade in clearfix">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
            @endif
            
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissable fade in clearfix">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
            @endif
            
            
            <div class="row">
                
                <!-- left -->
                <div class="col-md-5">
                    <div class="sidebar-course-intro">
                        <div class="video-course-intro enrolled">
                            <div class="inner">
                                <div class="video-place">
                                    <div class="img-thumb">
                                        <img src="{{ Helper::coverImage($course) }}" alt="">
                                    </div>
                                    <div class="awe-overlay"></div>
                                    <a href="#" class="play-icon" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#preview-video">
                                        <i class="fa fa-play">
                                            {{trans('strings.frontend.preview')}}
                                        </i>
                                    </a>
                                </div>
                                <div class="video embed-responsive embed-responsive-16by9">
                                    <iframe src="" class="embed-responsive-item">
                                    </iframe>
                                </div>
                            </div>
                            <div class="price">
                                {{ Helper::getPrice($course) }}
                            </div>
                            @if (! $logged_in_user)
                               <a href="{{route('frontend.auth.login')}}" class="mc-btn btn-style-1">
                                   {{trans('strings.frontend.login-to-enroll')}}
                               </a> 
                            @else
                                @if(Helper::getPrice($course) == 'FREE')
                                    <a href="{{route('frontend.course.enroll', $course)}}" class="mc-btn btn-style-1">
                                        {{trans('strings.frontend.enroll-now')}}
                                    </a>
                                @else
                                <!--
                                    <a href="#" class="take-this-course mc-btn btn-style-1">
                                        {{trans('strings.frontend.buy-now')}}
                                    </a>
                                -->
                                    <a href="#" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#buy-now" class="mc-btn btn-style-1">
                                        {{trans('strings.frontend.buy-now')}}
                                    </a>
                                @endif
                            @endif

                        </div>
                        
                        <hr class="line">
                        
                        <div class="new-course">
                            <div class="item course-code text-center">
                                <i class="icon md-barcode"></i>
                                <h4><a href="#">{{trans('strings.frontend.sections')}}</a></h4>
                                <p class="detail-course">{{$course->sections->count()}}</p>
                            </div>
                            <div class="item course-code text-center">
                                <i class="icon md-time"></i>
                                <h4><a href="#">{{trans('strings.frontend.avg-rating')}}</a></h4>
                                <p class="detail-course">{{ $course->total_reviews > 0 ?  $course->average_rating : trans('strings.frontend.not-rated') }}</p>
                            </div>
                            <div class="item course-code text-center">
                                <i class="icon md-time"></i>
                                <h4><a href="#">{{trans('strings.frontend.wishlist')}}</a></h4>
                                <p class="detail-course">
                                    @if ($logged_in_user)
                                        <wishlist :course_id="{{$course->id}}"></wishlist>
                                    @else
                                        <span data-toggle="tooltip" title="" data-original-title="Add to wishlist">
                                            <a disabled class="disabled"><i class="fa fa-heart-o fa-2x"></i></a>
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="item course-code text-center">
                                <i class="icon md-img-check"></i>
                                <h4><a href="#">{{trans('strings.frontend.updated')}}</a></h4>
                                <p class="detail-course">{{ $course->updated_at->diffForHumans() }}</p>
                            </div>
                            <center>
                                @if(Auth::user() && $course->price > 0)
                                    <affiliate-button link="{{ URL::route('frontend.course.show', ['course' => $course, 'ref' => Auth::user()->affiliate_id]) }}"></affiliate-button>
                                @endif
                            </center>
                        </div>
                        
                        <div style="#">
                            <center>
                                @if(config('demo.demo_mode'))
                                    <div style="max-width: 480; height: auto; background: rgb(153, 153, 153); color: #fff; line-height: 90px; text-align: center; ">AD BANNER</div>
                                @endif
                                <!-- Banner Add -->
                                <google-adsense
                                  ad-client="{{config('settings.adsense_ad_client')}}"
                                  ad-slot="{{config('settings.adsense_sidebar_responsive_slot')}}"
                                  ad-style="display: block"
                                  ad-format="auto">
                                </google-adsense>
                            </center>
                        </div>
                        <hr class="line">
                        
                        <div class="widget widget_equipment">
                            <i class="icon md-config"></i>
                            <h4 class="xsm black bold">{{trans('strings.frontend.share-this')}}</h4>
                            <div class="equipment-body">
                                <social-sharing url="{{route('frontend.course.show', $course)}}" 
                                    title="{{$course->title}}" 
                                    description="{{$course->subtitle}}" inline-template>
                                  <div class="social-share">
                                    <network network="facebook">
                                      <i class="fa fa-fw fa-facebook-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="googleplus">
                                      <i class="fa fa-fw fa-google-plus-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="linkedin">
                                      <i class="fa fa-fw fa-linkedin-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="pinterest">
                                      <i class="fa fa-fw fa-pinterest-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="reddit">
                                      <i class="fa fa-fw fa-reddit-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="twitter">
                                      <i class="fa fa-fw fa-twitter-square fa-2x text-primary"></i>
                                    </network>
                                    <network network="vk">
                                      <i class="fa fa-vk fa-2x text-primary"></i>
                                    </network>
                                    <network network="weibo">
                                      <i class="fa fa-weibo fa-2x text-primary"></i>
                                    </network>
                                  </div>
                                </social-sharing>
                            </div>
                        </div>
                        
                        
                        <div class="widget widget_tags">
                            
                            <!--<h4 class="xsm black bold">Tags</h4>-->
                            <div class="tagCould">
                                @foreach($course->tags as $tag)
                                    <a href="{{ route('frontend.course.tag.get', strToLower($tag->name)) }}" class="tag-btn"> {{ strToUpper($tag->name) }}</a>
                                @endforeach
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
                
                <!-- right -->
                <div class="col-md-7">
                    <div class="tabs-page">
                        <ul class="nav-tabs" role="tablist">
                            <li class="active"><a href="#introduction" role="tab" data-toggle="tab">
                                {{trans('strings.frontend.description')}}
                            </a></li>
                            <li><a href="#outline" role="tab" data-toggle="tab">{{trans('strings.frontend.content')}}</a></li>
                            <li><a href="#review" role="tab" data-toggle="tab">{{trans('strings.frontend.feedback')}}</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            
                            <!-- INTRODUCTION -->
                            <div class="tab-pane fade in active" id="introduction">
                                {!! $course->description !!}    
                            </div>
                            <!-- END / INTRODUCTION -->



                            <!-- OUTLINE -->
                            <div class="tab-pane fade" id="outline">
                                
                                <!-- SECTION OUTLINE -->
                                @foreach($course->sections as $section)
                                    @if($section->lessons->count())
                                    <div class="section-outline">
                                        <a data-toggle="collapsex" href="#section-{{$section->id}}">
                                            <h4 class="tit-section xsm">
                                                {{trans('strings.frontend.section')}} {{ $section->sortOrder }}: {{ $section->title }}
                                                <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                            </h4>
                                        </a>
                                        <ul class="section-list {!! $loop->first ? '':'collapsex' !!}" id="section-{{$section->id}}">
                                            @foreach($section->lessons as $lesson)
                                                @if($lesson->content || $lesson->lesson_type == 'quiz')
                                                <li>
                                                    <div class="count"><span>{{ $lesson->sortOrder }}</span></div>
                                                    <div class="list-body">
                                                        <p><a href="#" class="disabled">{{ $lesson->title }}</a></p>
                                                        <div class="data-lessons clearfix">
                                                            {{ $lesson->description }}
                                                        </div>
                                                    </div>
                                                    @if($lesson->content && $lesson->content->content_type == 'video')
                                                        <a class="mc-btn-2"><i class="fa fa-play-circle"></i> {{ $lesson->content->video_duration }} {{trans('strings.frontend.minutes')}}</a>
                                                    @elseif($lesson->content && $lesson->content->content_type == 'article')
                                                        <a class="mc-btn-2"><i class="fa fa-file-text"></i> {{trans('strings.frontend.article')}}</a>
                                                    @else 
                                                        <a class="mc-btn-2"><i class="fa fa-question-circle"></i> {{trans('strings.frontend.quiz')}}</a>
                                                    @endif
                                                </li>
                                                @endif
                                            @endforeach
    
                                        </ul>
                                    </div>
                                    @endif
                                    <!-- END / SECTION OUTLINE -->
                                @endforeach

                                
                            </div>
                            <!-- END / OUTLINE -->

                            <!-- REVIEW -->
                            <div class="tab-pane fade" id="review">
                                <reviews :course="{{$course->toJson()}}" :user_can_review="{{ Auth::check() && Auth::user()->canReviewCourse($course) ? 'true':'false' }}" inline-template>
                                    @include('frontend._course._includes._reviews')
                                </reviews>
                            </div>
                            <!-- END / REVIEW -->
                            
                            <hr class="line">
                            <div class="widget widget_tags">
                                <center>
                                    @if(config('demo.demo_mode'))
                                        <div style="max-width: 100%; height: auto; background: rgb(153, 153, 153); color: #fff; line-height: 90px; text-align: center; ">AD BANNER</div>
                                    @endif
                                    <!-- Banner Add -->
                                    <google-adsense
                                      ad-client="{{config('settings.adsense_ad_client')}}"
                                      ad-slot="{{config('settings.adsense_top_responsive_slot')}}"
                                      ad-style="display: block"
                                      ad-format="auto">
                                    </google-adsense>
                                </center>
                            </div>
                            <hr class="line">
                            <div class="about-instructor">
                                <h4 class="xsm black bold">{{trans('strings.frontend.about-instructor')}}</h4>
                                <ul style="padding-left:0; list-style-type: none;">
                                    <li>
                                        <div class="image-instructor text-center">
                                            <img src="{{ $course->author->picture }}" alt="">
                                        </div>
                                        <div class="info-instructor">
                                            <cite class="sm black"><a href="{{route('frontend.user.public.profile', $course->author)}}">{{$course->author->name}}</a></cite>
                                            @if(Auth::check() && Auth::user()->id != $course->author->id)
                                                <a href="#" data-backdrop="static" data-keyboard="false"  class="sendMessage" data-toggle="modal" data-id="{{$course->author->id}}" data-target="#sendMessage">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            @endif
                                            
                                            <p>{!! $course->author->bio !!}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        
    
    </section>
    <!-- END / COURSE TOP -->
    <span id="hide-firstx" class="hiddenx">
        @include('frontend._modals.checkout')
        @if(!$preview_lessons->isEmpty())
            @include('frontend._modals.preview')
        @endif
    </span>
    
    
@endsection

@section('after-scripts')
    <link href="{{ URL::asset('css/vendor/card.js.css') }}" rel="stylesheet">
	<script src="https://js.stripe.com/v2/"></script>

    <script src="https://cdn.omise.co/omise.js"></script>
    <script>
        Omise.setPublicKey("{{config('services.omise.key')}}");
    </script>
	
	<script src="{{ URL::asset('js/vendor/Video.js') }}"></script>
    <script src="{{ URL::asset('js/vendor/Youtube.js')}}"></script>
    <script src="{{ URL::asset('js/vendor/Vimeo.js') }}"></script> 
    

    <script type="text/javascript">
        var player = videojs('previewPlayer');
        $('.lesson-title').on("click", function () {
            $('.preview').removeClass('disabled ');
            $(this).parent('li').addClass('disabled');
            var video_src = $(this).data('video');
            var video_type = $(this).data('type');
            player.src({ "type": "video/"+video_type, "src": video_src});
            player.play();
        });
        $('.close').on('click', function(){
            player.pause();
            player.src('');
        })
    </script>
	
	
	<script>
	    /*===================
	    STRIPE PAYMENT
	    ====================*/
        $(function() {
            Stripe.setPublishableKey("{{config('services.stripe.key')}}");
            
		    $("#checkout-btn").click(function() {
		        var form = $("#checkout-form");
		        var submit = form.find("button");
		        var submitInitialText = submit.text();
		        submit.attr("disabled", "disabled").html("<i class='fa fa-gear fa-spin'></i> Processing...");
		        Stripe.card.createToken(form, function(status, response) {
		            if(response.error) {
		      	        $('.stripe-errors').removeClass('hidden');
		      	        $('.stripe-errors span').text(response.error.message);
		                form.find(".stripe-errors").text(response.error.message).show();
		                submit.removeAttr("disabled");
		                submit.text(submitInitialText);
		            } else {
		                form.append($("<input type='hidden' name='token'>").val(response.id));
		                form.submit();
		            }
		        });
		    });
		  
		});
		
		// paypal button click event
		$('#paypal-button').click(function() {
		    $(this).attr('disabled', 'disabled');
		    $(this).html("<i class='fa fa-gear fa-spin'></i> {{trans('strings.frontend.processing')}}");
		    $(this).parents('form').submit()
		})
		
		
		
		// Omise Payment
		$("#omise-payment").submit(function () {    
            
            var form = $(this);
            // Disable the submit button to avoid repeated click.
		    $('#create_token').attr('disabled', 'disabled');
		    $('#create_token').html("<i class='fa fa-gear fa-spin'></i> {{trans('strings.frontend.processing')}}");
    		
            // Serialize the form fields into a valid card object.
            var card = {
                "name": form.find("[data-omise=holder_name]").val(),
                "number": form.find("[data-omise=number]").val(),
                "expiration_month": form.find("[data-omise=expiration_month]").val(),
                "expiration_year": form.find("[data-omise=expiration_year]").val(),
                "security_code": form.find("[data-omise=security_code]").val()
            };
            // Send a request to create a token then trigger the callback function once
            // a response is received from Omise.
            //
            // Note that the response could be an error and this needs to be handled within
            // the callback.
            Omise.createToken("card", card, function (statusCode, response) {
                if (response.object == "error") {
                    // Display an error message.
                    $('#token_errors').removeClass('hidden');
	      	        $('#token_errors span').text(response.message);
	                form.find("#token_errors").text(response.message).show();
	                
                    $('#create_token').prop("disabled", false);
		            $('#create_token').html("{{trans('strings.frontend.pay')}}");
                    
                } else {
                    // Then fill the omise_token.
                    form.find("[name=omise_token]").val(response.id);
                    
                    setTimeout(function(){
                        form.get(0).submit();
                    }, 3000);
                    // And submit the form.
                };
            });
            // Prevent the form from being submitted;
            return false;
        });
		
	</script>
	
	
	
	
	
	
	
	
	
	
	
	
	
	<style type="text/css">
	    .checkbox.pull-right { margin: 0; }
        .pl-ziro { padding-left: 0px; }
	    .form-body{
	        min-height: 450px !important;
	    }

        .form-checkout .form-2 .form-email {
            clear: both;
            overflow: hidden;
            margin-top: 0px;
        }
        .form-checkout .fs-title {
            margin-top: 0;
            font-weight: bold;
        }
	</style>
@endsection