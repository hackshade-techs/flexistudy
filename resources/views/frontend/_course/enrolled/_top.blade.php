<div class="jumbotron" style="text-align:left;">
    <div class="bg-stripe-overlay" style="text-align:left;">
        <div class="container">
            <div class="col-md-5">
                <div class="row">
                    <div class="video-course-intro enrolled">
                        <div class="inner">
                            <div class="video-place">
                                <div class="img-thumb">
                                    <img src="{{ Helper::coverImage($course) }}" alt="">
                                </div>
                                <div class="awe-overlay"></div>

                                <a href="{{ $last_watched ? route('frontend.lesson.show', [$course, $last_watched] ) : route('frontend.lesson.show', [$course, $first_lesson] )  }}" class="play-icon">
                                    <i class="fa fa-play"></i>
                                </a>
                                
                            </div>
                            <div class="video embed-responsive embed-responsive-16by9">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h2 style="font-size: 35px;">{{ $course->title }}</h2>
                <p style="margin-bottom: 5px;">{{ $course->subtitle }}</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="{{Auth::user()->percentCompleted($course)}}" aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->percentCompleted($course)}}%">
                      <span class="sr-only">{{Auth::user()->percentCompleted($course)}}% {{trans('strings.frontend.complete')}}</span>
                    </div>
                </div>
                <p style="margin-bottom:10px;">{{Auth::user()->percentCompleted($course)}}% {{trans('strings.frontend.complete')}}</p>
                
                <div class="wellx button-setx onex"> 
                    @if(!is_null($last_watched))
                        <a href="{{route('frontend.lesson.show', [$course, $last_watched] )}}" class="btn btn-warning">{{trans('strings.frontend.continue-to-lesson')}} {{$last_watched->sortOrder}}</a>
                    @else 
                        <a href="{{route('frontend.lesson.show', [$course, $first_lesson] )}}" class="btn btn-warning">{{trans('strings.frontend.start-course')}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- END / SUB BANNER -->
    
        <!-- PAGE CONTROL -->
    <section class="page-control content-bar ps-container">
        <div class="container">
            <ul>
                <li class="{{ active_class(Active::checkUriPattern('courses/'.$course->slug.'/learn')) }}">
                    <a href="{{route('frontend.course.show', $course)}}">
                        {{trans('strings.frontend.overview')}}     
                    </a>
                </li>
                <li class="{{ active_class(Active::checkUriPattern('courses/'.$course->slug.'/learn/question*')) }}">
                    <a href="{{route('frontend.user.questions.index', $course)}}">
                        {{trans('strings.frontend.questions')}} 
                    </a>
                </li>
                <li class="{{ active_class(Active::checkUriPattern('courses/'.$course->slug.'/learn/announcements*')) }}">
                    <a href="{{route('frontend.user.announcements.index', $course)}}">
                        {{trans('strings.frontend.announcements')}} 
                    </a>
                </li>

            </ul>
    </section>
    <!-- END / PAGE CONTROL -->