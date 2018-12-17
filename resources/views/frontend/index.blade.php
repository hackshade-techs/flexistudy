@extends('frontend.layouts.app')

@section('title')
    {!! trans('strings.frontend.home') !!}
@endsection

@section('after-styles')

<style type="text/css">
    #background {
        display:none;
        right: 0;
        bottom: 0;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        z-index:-100;
        object-fit: cover;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.6);
    }
    
    @media (min-width: 62em) {
       #background {
          display:block;
       }
       
       .jumbotron .bg-stripe-overlay {
            background: url(/images/bg-jumbotron.png) repeat;
            text-align: left;
            padding: 70px 0;           
        }
    }
    .awe-parallax{
        background-color: rgba(17, 83, 140, 0.6);
        z-index:100;
    }
    
    .button-set-header {
        padding: 10px 25px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }
    
    .button-set-header.one {
        background: rgba(0, 0, 0, 0.2);
        border-bottom: solid 1px rgba(168, 152, 164, 0.65);
        margin: 20px 0 20px;
    }
    
    .jumbotron h2{
        margin-top:0;
    }
    
    /* typeahead */
    .jumbotron .search-item{
      color: #ddd;
    }
      
      .jumbotron .twitter-typeahead, 
      .jumbotron .tt-hint, 
      .jumbotron .tt-input, 
      .jumbotron .tt-menu { width: 100%; }
      .jumbotron .tt-menu.tt-open {margin-top: 0;}
      .jumbotron .tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
      .jumbotron .tt-hint {
          padding: 8px 12px;
          font-size: 14px;
          line-height: 30px;
          border: 2px solid #ccc;
          border-radius: 4px;
          outline: none;
      }
      
      .jumbotron .tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      }
      
      .jumbotron .tt-hint {
          color: #fff;
      }
      
      .jumbotron .tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
          min-width: 100%;
          color: #fff !important;
          padding: 0px;
          text-align: left;
          background-color: rgba(0, 0, 0, 0.2);
          border: 1px solid rgba(255, 255, 255, 0.6);
        }
        
        
        .jumbotron .tt-menu a { 
            color: #d3d3d3 !important;
            font-size: 1.4em;
            line-height: 1.4em;
        }
      
        .jumbotron .tt-suggestion {
            padding: 3px 10px;
            font-size: 15px;
            line-height: 24px;
        }
         .jumbotron .tt-highlight{
             color: #fff;
         }
        .jumbotron .tt-suggestion.tt-is-under-cursor,
        .jumbotron .tt-suggestion.tt-cursor{ 
            color: #fff;
            background-color: rgba(255, 255,255,0.2);
      
        }
      
        .jumbotron #mk-fullscreen-search-input:focus, 
        .jumbotron #mk-fullscreen-search-input,
        .jumbotron [type=text].form-control{ 
            box-shadow: none !important; border: 1px solid #ddd;
            -webkit-box-shadow: none !important; border: 1px solid #ddd;
            border: 1px solid rgba(255,255,255,0.3);
            width: 100%; 
            background:rgba(255,255,255,0.2);
            color:#fff;
        }

        .mc-section-1-content-1 .big {
            margin-bottom: 10px;
        }
        .big {
            font-family: 'Lato', sans-serif;
            font-size: 25px;
            line-height: 1.5em;
            color: #9a9a9a;
            font-weight: bold;
        }
       .one ::-webkit-input-placeholder {
            color:#f5f5f5 !important;
        }
        
        .one ::-moz-placeholder {
            color:#f5f5f5 !important;
        }
        
        .one ::-ms-placeholder {
            color:#f5f5f5 !important;
        }
        
        .one ::placeholder {
            color:#f5f5f5 !important;
        }
        
       
       
</style>
@stop

@section('content')

    <div class="jumbotron" style="z-index: 2;">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="row top-row">
                    <div class="col-md-6">
                        <video autoplay loop muted id="background" style="" poster="/images/background-homepage.jpg">
                            <source src="/images/background-homepage.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div class="col-md-6">
                        <div class="row search-form-box hidden-xs" style="margin-top: 0px;">
                            <div class="well button-set one" style="padding: 10px; border: 0 solid red !important; margin-top:0; width:100%;"> 
                                <form action="{{ route('frontend.course.get') }}" class="form-horizontal" method="get" id="mk-fullscreen-searchform">
                                    <input type="text" name="search" autocomplete="off" class="main-search form-control input-lg" placeholder="{{trans('strings.frontend.search-author-or-title')}}..." id="mk-fullscreen-search-input">
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="left">
                                @if(!auth()->check())
                                    <h2>{!!trans('strings.frontend.homepage-caption')!!}</h2>
                                    <p>{!!trans('strings.frontend.homepage-paragraph')!!}</p>
    
                                    <div class="button-set" style="padding:0;box-shadow:none;"> 
                                      <a class="btn btn-success" href="{{route('frontend.auth.login')}}">
                                          {!! trans('navs.frontend.login') !!}
                                      </a>
                                      <span class="divider hidden-xs">or</span>
                                      <a href="{{route('frontend.auth.register')}}" class="btn btn-warning">
                                          {!! trans('navs.frontend.register') !!}
                                      </a>
                                    </div>
                                @else
                                    
                                      <h2>{!!trans('strings.frontend.homepage-caption')!!}</h2>
                                      <p>{!!trans('strings.frontend.homepage-paragraph')!!}</p>
                                      <a class="btn btn-success" href="{{route('frontend.course.get')}}">
                                          {!! trans('strings.frontend.start-learning') !!}
                                      </a>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                
                </div>
              
            </div>
        </div>
    </div>
    
    @if(!is_null($coupon))
        <section id="testimonial">
            <div class="container">
                <div class="coupon-info">
                    <h3 class="code orange">{{$coupon->percent}}% {{trans('strings.frontend.off')}}</h3>
                    <h3>{{trans('strings.frontend.any-course')}}</h3>
                    <h3>{{trans('strings.frontend.use-coupon')}}</h3>
                    
                    <h3  class="orange">{{$coupon->code}}</h3>
                    <h3>{{trans('strings.frontend.expires-in')}}</h3>
                    <h3 class="orange"><div id="getting-started"></div></h3>
                </div>
            </div>
        </section>
    @endif
    
    <!-- SECTION 1 -->
    <section id="mc-section-1" style="padding:25px 0px;" class="mc-section-1 section">
        <div class="container">
            <div class="row">
                @if($featured_page)
                    <div class="col-md-{{count($posts) ? '5' : '12'}}">
                        <div class="mc-section-1-content-1">
                            <h2 class="big">{{$featured_page->title}}</h2>
                            <p class="mc-text">{!! str_limit(strip_tags($featured_page->body), 250) !!}</p>
                            <a href="{{route('frontend.pages.show', $featured_page)}}" class="mc-btn btn-style-1">{{trans('strings.frontend.read-more')}}</a>
                        </div>
                    </div>
                @endif

                <div class="col-md-{{!is_null($featured_page) ? '7' : '12'}}">
                    <div class="row">
                        <h2 class="big">{{trans('strings.frontend.recent-posts')}}</h2>
                        @foreach($posts as $p)
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="featured-item">
                                        <h4 class="title-box text-uppercase">
                                            <a href="{{route('frontend.posts.show', $p)}}">{{$p->title}}</a>
                                        </h4>
                                        <p>
                                        {!! str_limit(strip_tags($p->body), 120) !!}
                                        <span><a href="{{route('frontend.posts.show', $p)}}">{{trans('strings.frontend.read-more')}} <i class="fa fa-angle-double-right"></i></a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END / SECTION 1 -->
    
    @if(config('settings.adsense_top_responsive_slot') != '')
        <section id="mc-section-3" class="mc-section-3 section">
            <div class="container">
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
        </section>
    @endif
    
    @if($featuredCategories->count() > 0)
        @foreach($featuredCategories as $category)
            @if(count($category->courses))
            <section id="mc-section-3" class="mc-section-3 section">
                <div class="container">
                    <!-- FEATURE -->
                    <div class="feature-course">
                        <h4 class="title-box text-uppercase">{{trans('strings.frontend.featured-in')}} <b><a href="{{route('frontend.course.get')}}?category={{$category->slug}}">{{$category->name}}</a></b></h4>
                        <a href="{{route('frontend.course.get')}}?category={{$category->slug}}" class="all-course mc-btn btn-style-1 hidden-xs hidden-sm">
                            {{trans('strings.frontend.more')}}
                        </a>
                        
                        <div class="spinner">
                            <center>
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw text-muted"></i>
                            </center>
                        </div>
                        <div class="row">
                            <div class="feature-slider" style="display:none">
                                @foreach($category->courses as $course)
                                    @include('frontend._course_home')
                                @endforeach
                            </div>
                        </div>
                        
                        
                    </div>
                    <!-- END / FEATURE -->
                </div>
            </section>
            
            @if(Auth::check())
        <!-- Modal -->
        @foreach($category->courses as $course)
            <div class="modal fade" id="affiliateLink-{{$course->id}}" role="dialog">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                        <strong>
                            {{trans('strings.frontend.copy-affiliate-link')}}  
                        </strong>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" style="font-size:12px !important;" id="promoLink-{{$course->id}}" value="{{ URL::route('frontend.course.show', ['course' => $course, 'ref' => Auth::user()->affiliate_id]) }}">
                              <span class="input-group-addon">
                                  <a href="javascript:void(0)" class="copyLink" id="copyLink" onclick="copyToClipboard('#promoLink-{{$course->id}}')">
                                      <i class="fa fa-clipboard"></i>
                                  </a>
                              </span>
                            </div>
                            <small class="text-success feedback-message"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">
                          {{trans('strings.frontend.close')}}
                      </button>
                    </div>
                  </div>
                </div>
            </div>
        @endforeach
    @endif
            
            
            @endif
            <!-- END / SECTION 3 -->
            
        @endforeach
    @endif
    
    @if(config('settings.adsense_top_responsive_slot') != '')
        <section id="mc-section-3" class="mc-section-3 section">
            <div class="container">
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
        </section>
    @endif
    <input type="hidden" value="" id="days-left"/>
    
    
    
@endsection
@section('after-scripts')
    @if(!is_null($coupon))
        <script type="text/javascript">
            $('#getting-started').countdown('{{$coupon->expires}}', function(event) {
                $(this).html(event.strftime("%D {{str_plural(trans('strings.frontend.day'), $coupon->days_left)}} %H:%M:%S"));
            });
        </script>
    @endif
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-form-box').fadeIn(100);
        });
        

        function copyToClipboard(el){
            document.querySelector(el).select();
            document.execCommand('copy');
            $('.feedback-message').text("{{trans('strings.frontend.copied-to-clipboard')}}");
            setTimeout(() => {
               $('.feedback-message').text('');
            }, 3000);
            
        }
    </script>
    
    
    
@endsection