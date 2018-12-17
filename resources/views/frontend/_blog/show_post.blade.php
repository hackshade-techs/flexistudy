@extends('frontend.layouts.app')
@section('title')
    {{$blog->title}}
@stop
@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="left">
                    <h2 style="font-size: 35px;">{{$blog->title}}</h2>
                    <p><i class="fa fa-minus"></i><i class="fa fa-minus"></i></p>
                </div>
            </div>
        </div>
    </div>
    
    
    <section id="mc-section-3" class="mc-section-3 section">
        <div class="container">
            <div class="row">
                
                
                <!-- SIDEBAR CATEGORIES -->
                <div class="col-md-3 col-md-push-9x">
                    <aside class="sidebar-categories">
                        <div class="inner">
                            
                            <!-- WIDGET TOP -->
                         
                            <div class="widget">
                                <ul class="list-style-block">
                                    <strong>Recommended Posts</strong>
                                    @foreach($related_posts as $post)
                                        <li class="current"><a href="{{route('frontend.posts.show', $post)}}">{{$post->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <!-- END / WIDGET TOP -->
                            <!-- Banner Add -->
                            <div class="mc-banner">
                                @if(config('demo.demo_mode'))
                                    <a href="#"><img src="/images/banner-ads-2.jpg" alt=""></a>
                                @endif
                                <google-adsense
                                  ad-client="{{config('settings.adsense_ad_client')}}"
                                  ad-slot="{{config('settings.adsense_sidebar_responsive_slot')}}"
                                  ad-style="display: block"
                                  ad-format="auto">
                                </google-adsense>
                            </div>
                        </div>
                    </aside>
                </div>
                
                
                <div class="col-md-9 col-md-pull-3x">
                    <div id="courses" class="content grid">
                        <div class="spinner">
                            <center>
                                <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw text-muted"></i>
                            </center>
                        </div>
                        <div class="infinite-scroll" style="display:none">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    {!! $blog->body !!}
                                </div>
                                <hr />
                                <div class="content list">
                                    <center>
                                    @if(config('demo.demo_mode'))
                                        <div style="width: 728px; height: auto; background: #eee; color: #999; line-height: 90px; text-align: center; ">AD BANNER</div>
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
                            </div>
                            
                            
                            
                            <social-sharing url="{{route('frontend.posts.show', $blog)}}" 
                                title="{{$blog->title}}" 
                                description="{!! str_limit($blog->body, 200) !!}" inline-template>
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
                    
                    <div lass="panel-body">
                        <div id="disqus_thread"></div>
                    </div>
                </div>
                
            </div> <!--/ end row -->
        </div>
    </section>
    
@endsection
@section('after-scripts')
    <script type="text/javascript">
        $('.infinite-scroll').delay(1000).fadeIn(1000);
        $('.spinner').delay(500).fadeOut(200);

    </script>

@endsection