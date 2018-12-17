@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }}
@endsection

@section('meta_description')
    {{ $course->subtitle }}
@endsection

@section('content')

    @include('frontend._course.enrolled._top')
    
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
                        
                        <div class="about-instructor">
                            <h4 class="xsm black bold">{{trans('strings.frontend.about-instructor')}}</h4>
                            <ul>
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
                        <hr class="line">
                        <div class="widget widget_tags">
                            @if(Auth::check() && $course->price > 0)
                                <affiliate-button link="{{ URL::route('frontend.course.show', ['course' => $course, 'ref' => Auth::user()->username]) }}"></affiliate-button>
                            @endif
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
                                </a>
                            </li>
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
                                                        <i class="icon md-camera"></i>
                                                        <p><a href="{{ route('frontend.lesson.show', [$section->course, $lesson] )  }}">{{ $lesson->title }}</a></p>
                                                        <div class="data-lessons clearfix">
                                                            {{ $lesson->description }}
                                                        </div>
                                                    </div>
                                                    @if($lesson->content && $lesson->content->content_type == 'video')
                                                        <a href="{{ route('frontend.lesson.show', [$section->course, $lesson] )  }}" class="mc-btn-2"><i class="fa fa-play-circle"></i> {{ $lesson->content->video_duration }} {{trans('strings.frontend.minutes')}}</a>
                                                    @elseif($lesson->content && $lesson->content->content_type == 'article')
                                                        <a href="{{ route('frontend.lesson.show', [$section->course, $lesson] )  }}" class="mc-btn-2"><i class="fa fa-file-text"></i> {{trans('strings.frontend.article')}}</a>
                                                    @else 
                                                        <a href="{{ route('frontend.lesson.show', [$section->course, $lesson] )  }}" class="mc-btn-2"><i class="fa fa-question-circle"></i> {{trans('strings.frontend.quiz')}}</a>
                                                    @endif
                                                </li>
                                                @endif
                                            @endforeach
    
                                        </ul>
                                    </div>
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

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    

@endsection

@section('after-scripts')

@endsection