@extends('frontend.layouts.app')
@section('title')
    {{ $lesson->title }}
@endsection

@section('meta_description')
    {{ $lesson->section->course->title}}
@endsection

@section('after-styles')
    @include('frontend._lesson._styles')
@endsection

@section('content')

    <div class="jumbotron">
        <div class="bg-stripe-overlay" style="text-align:left;">
            <div class="container">
                <div class="video-player">
                    
                    @if($lesson->content_type == 'article')
                        @if(auth()->check() && auth()->user()->canAccessLesson($lesson) || !auth()->check() && $lesson->preview)
                            <div class="panel-body text-content">
                                    {!! $lesson->article_content !!}
                            </div>
                        @else
                            <div class="video-course-intro">
                                <div class="inner">
                                    <div class="video-place">
                                        <div class="img-thumb">
                                            <img src="/images/player.png" alt="">
                                        </div>
                                        <div class="awe-overlay"></div>
                                        
                                        <a href="#" class="play-icon">
                                            <i class="fa fa-play">{{trans('strings.frontend.premium-content')}}</i>
                                        </a>
                                    </div>
                                    <div class="video embed-responsive embed-responsive-16by9">
                                        <iframe src="" class="embed-responsive-item">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @elseif($lesson->content_type == 'quiz')
                        @if(auth()->check() && auth()->user()->canAccessLesson($lesson) || !auth()->check() && $lesson->preview)
                            <div class="panel-body text-content">
                                <quiz lesson="{{$lesson->id}}" inline-template v-cloak>
                                    <div>
                                        <div v-if="showResults">
                                            <h5>
                                                Quiz Results: @{{totalCorrect}} correct out of @{{questions.length}} - 
                                                <span :class="percent >= 50 ? 'label label-success' : 'label label-danger'">@{{percent}}%</span>
                                            </h5>
                                            
                                            <hr />
                                            <ul class="list-group" v-for="(question,index) in answeredQuestions">
                                                <li class="list-group-item">
                                                    <h6 style="color:#0d568a;font-weight:bold;margin-top:0;">Question @{{index+1}}</h6> <span v-html="question.question.question"></span>
                                                    <ol>
                                                        <li v-for="answer in question.question.answers" style="margin-bottom:10px;">
                                                            
                                                            <i class="fa fa-times" style="color:#ce0000;margin-left:-32px;padding-right:20px;" 
                                                                v-if="answer.id == question.question.selectedAnswer.id && question.question.selectedAnswer.correct !== 1"></i>
                                                            
                                                            <i class="fa fa-check" style="color:#4caf50;margin-left:-32px;padding-right:20px;" 
                                                                v-if="answer.id == question.question.selectedAnswer.id && question.question.selectedAnswer.correct == 1"></i>
                                                                
                                                            <b>@{{answer.answer}}</b> &nbsp; &nbsp; <span class="text-success" style="color:#4caf50;" v-if="answer.correct==1">
                                                                <i class="fa fa-arrow-left"></i> Correct Answer</span>
                                                                <p :style="answer.correct == 1 ? 'color:#4caf50;' : 'color:#ce0000;'" v-if="answer.explanation">
                                                                    Explanation: <em>@{{answer.explanation}}</em>
                                                                </p>
                                                                
                                                        </li>
                                                    </ol>
                                                </li>
                                            </ul>
                                        </div>
                                        <div v-else>
                                            <h5 v-if="questions">Question @{{currentQuestionNumber}} of @{{questions.length}}</h5>
                                            <hr />

                                            <quiz-question v-if="currentQuestion" :question="currentQuestion" :is_last_question="isLastQuestion" inline-template @answer-chosen="storeAnswer">
                                                <div>
                                                    <div class="lead" v-html="question.question"></div>
                                                    <div class="radio" v-for="answer in question.answers" :key="answer.id">
                                                         <label :for="'answer-'+ answer.id">
                                                             <input type="radio" name="btn" 
                                                                style="margin-top:3px; margin-right:8px;"
                                                                :id="'answer-'+ answer.id" @click="choose(answer)">@{{answer.answer}}
                                                         </label>
                                                    </div>
                                                    
                                                    
                                                    <button class="btn btn-primary btn-xs" @click.prevent="nextQuestion()" v-if="showNext">
                                                        @{{is_last_question ? 'Finish Quiz' : 'Next Question'}} <i class="fa fa-angle-double-right"></i>
                                                    </button>
                                                    
                                                    
                                                </div>
                                            </quiz-question>
                                        </div>
                                    </div>
                                </quiz>

                                
                            </div>
                        @else
                            <div class="video-course-intro">
                                <div class="inner">
                                    <div class="video-place">
                                        <div class="img-thumb">
                                            <img src="/images/player.png" alt="">
                                        </div>
                                        <div class="awe-overlay"></div>
                                        
                                        <a href="#" class="play-icon">
                                            <i class="fa fa-play">{{trans('strings.frontend.premium-content')}}</i>
                                        </a>
                                    </div>
                                    <div class="video embed-responsive embed-responsive-16by9">
                                        <iframe src="" class="embed-responsive-item">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="video-course-intro">
                            @if(auth()->check() && auth()->user()->canAccessLesson($lesson) || !auth()->check() && $lesson->preview)
                                <div class="inner">
                                    <div align="center" id="player-container" style="display:none;background:url(/images/player.png);" class="video-js-box hu-css">
                                        <video id="my-player" 
                                            class="video-js vjs-big-play-centered" 
                                            controls 
                                            preload="auto"
                                            data-setup='{"techOrder": ["vimeo", "youtube", "html5"], "fluid": true, "preload": "auto", "autoplay": true, "playbackRates": [0.5, 0.75, 1, 1.5, 2] }'
                                            poster="/images/player.png" >
                                            <source type="video/{{$lesson->video_provider}}" src="{{$lesson->video_link}}"></source>    
                                        </video>
                                    </div>
                                </div>
                            @else
                                <div class="inner">
                                    <div class="video-place">
                                        <div class="img-thumb">
                                            <img src="/images/player.png" alt="">
                                        </div>
                                        <div class="awe-overlay"></div>
                                        
                                        <a href="#" class="play-icon">
                                            <i class="fa fa-play">{{trans('strings.frontend.premium-content')}}</i>
                                        </a>
                                    </div>
                                    <div class="video embed-responsive embed-responsive-16by9">
                                        <iframe src="" class="embed-responsive-item">
                                        </iframe>
                                    </div>
                                </div>
                            @endif
                        </div> 
                    @endif 
                </div>
            </div>
            
            <div class="panel-footer clearfix">
                <div class="container">
                    <center>
                        @if(!is_null($previous_lesson))
                            <a href="{{ route('frontend.lesson.show', [$course, $previous_lesson] )  }}" class="btn btn-success pull-left btn-sm"> 
                                <i class="fa fa-angle-double-left"></i> {{trans('strings.frontend.previous')}}  
                            </a>
                        @endif
                        @if(auth()->check())
                            @if(auth()->user()->canAccessLesson($lesson))
                                <button href="#" class="btn btn-default btn-sm mark-as-completed {{auth()->check() && auth()->user()->hasCompleted($lesson) ? 'hidden':''}}" onclick="markAsComplete()">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{trans('strings.frontend.mark-as-completed')}}
                                </button>
                                <button href="#" class=" btn btn-success btn-sm mark-as-uncompleted {{auth()->check() && !auth()->user()->hasCompleted($lesson) ? 'hidden':''}}" onclick="markAsInComplete()">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{trans('strings.frontend.mark-as-uncompleted')}}
                                </button>
                            @endif
                        @endif
                        
                        @if(!is_null($next_lesson))
                            <a href="{{ route('frontend.lesson.show', [$course, $next_lesson] )  }}" id="next-button" class="btn btn-success pull-right btn-sm">
                                {{trans('strings.frontend.next')}} <i class="fa fa-angle-double-right"></i>
                            </a>
                        @endif
                    </center>
                </div>
            </div>
        </div>
    </div>
    
    <section id="course-concern" class="course-concern">
        <div class="container">
            <div class="col-md-5">
                @if(auth()->check() && auth()->user()->canAccessLesson($lesson))
                    @if(count($lesson->attachments))
                        @foreach($lesson->attachments as $attachment)
                            <a href="/uploads/attachments/{{$attachment->filename}}" target="_blank">
                                <i class="fa fa-paperclip"></i> {{trans('strings.frontend.download-lesson-resources')}}
                            </a>
                        @endforeach
                    @endif
                @endif
                <div class="hidden-sm hidden-xs">
                    <h4 class="text-muted">{{$course->title}}:</h4>
                    <p class="lead text-muted">{{$course->subtitle}}</p>
                </div>
                <div style="margin-bottom:15px;">
                    <a href="{{route('frontend.course.show', $course)}}">
                        <i class="fa fa-long-arrow-left"></i>
                        {{trans('strings.frontend.back-to-course')}}
                    </a>
                </div>
                
                <div>
                    @if(Auth::check() && $course->price > 0)
                        <affiliate-button link="{{ URL::route('frontend.course.show', ['course' => $course, 'ref' => Auth::user()->affiliate_id]) }}"></affiliate-button>
                    @endif
                </div>
                
                @if(count($quiz_attempts))
                    <div class="well" style="padding:5px; margin-top:10px;">
                        <h5>Your previous attempts for this quiz</h5>    
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Total answered</th>
                                <th>Total correct</th>
                                <th>Percent</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($quiz_attempts as $a)
                                    <tr>
                                        <td>{{$a->created_at->format('d-M-Y')}}</td>
                                        <td>{{$a->total_attempted}}</td>
                                        <td>{{$a->total_correct}}</td>
                                        <td><span class="label label-{{$a->percent >= 50 ? 'success' : 'danger'}}">{{$a->percent}}%</span></td>
                                    </tr>
                                @endforeach                      
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
            <div class="col-md-7">
                <h5>{{$lesson->title}}</h5>
                <p>{{$lesson->description}}</p>
                <div class="nav-side-menu">
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                    <div class="menu-list">
                        <ul id="menu-content" class="menu-content collapse out">
                            @foreach($sections as $s)
                                @if($s->lessons->count())
                                    <li  data-toggle="collapse" data-target="#section-{{$s->id}}" class="{!! $s->id == $lesson->section_id ? 'active':'collapsed' !!}">
                                      <a href="#">{{$s->sortOrder}}: {{$s->title}} <span class="arrow"></span></a>
                                    </li>
                                    <ul class="sub-menu collapse {!! $s->id == $lesson->section_id ? 'in':'in' !!}" id="section-{{$s->id}}">
                                        @foreach($s->lessons as $l)
                                            <li class="{!! $l->id == $lesson->id ? 'active': null !!}">
                                                <a href="{{route('frontend.lesson.show', [$course, $l]) }}">
                                                    {{ $l->title }}
                                                    <span class="pull-right text-muted" style="padding-right:5px; font-style: italic;">
                                                        @if(auth()->check() && auth()->user()->hasCompleted($l))
                                                            <i class="fa fa-check-circle text-success" style="padding-right:0;"></i>
                                                        @else 
                                                            <i class="fa fa-check-circle-o text-muted" style="padding-right:0;"></i>
                                                        @endif
                                                        @if($l->content && $l->content->content_type == 'video')
                                                            {{$l->content->video_duration}}m
                                                        @elseif($l->content && $l->content->content_type == 'article')
                                                            <i class="fa fa-file-text-o" style="padding-left:0;"></i>
                                                        @else($l->content && $l->content->content_type == 'article')
                                                            <i class="fa fa-question-circle" style="padding-left:0;"></i>
                                                        @endif
                                                        
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- END / CONTENT BAR -->
    
@endsection

@section('after-scripts')
	<script src="{{ URL::asset('js/vendor/Video.js') }}"></script>
    <script src="{{ URL::asset('js/vendor/Youtube.js')}}"></script>
    <script src="{{ URL::asset('js/vendor/Vimeo.js') }}"></script> 

    @if(auth::check())
        <script>
            function markAsComplete(){
                $.ajax({
                    type: 'POST',
                    url: "{{route('frontend.user.lessons.completion', $lesson)}}",
                    data: {},
                    success: function(){
                        $('.mark-as-completed').fadeOut("slow", function(){
                            $(this).addClass('hidden');
                        });
                        
                        $('.mark-as-uncompleted').fadeIn("slow", function(){
                            $(this).removeClass("hidden");
                        });
                    }
                })
            }
    
            function markAsInComplete(){
                $.ajax({
                    type: 'POST',
                    url: "{{route('frontend.user.lessons.incompletion', $lesson)}}",
                    data: {},
                    success: function(){
                        $('.mark-as-uncompleted').fadeOut("slow", function(){
                            $(this).addClass('hidden');
                        });
                        
                        $('.mark-as-completed').fadeIn("slow", function(){
                            $(this).removeClass("hidden");
                        });
                    }
                })
            }
            
            $(document).ready(function(){
                $('#player-container').show();
            });
            
        </script>
    @endif
    
    @if($lesson->content_type == 'video')
        <script>
            var player = videojs('my-player');
            
            // when the video is ready
            player.ready(function(){
                console.log('Ready!');
            });
            
            player.on('loadedmetadata', function() {
                //console.log(player);
                
            }, false);
            
            
            
            player.on('ended', function() {
                markAsComplete();
                setTimeout(() => {
                   document.getElementById('next-button').click();
                }, 2000)
            });
            
        </script>
    @endif
    
    <script type="text/javascript">
    /*
        $(document).ready(function(){
           $('body').bind('contextmenu',function() { return false; });
        });
        
        document.onkeydown = function(e) {
            if(e.keyCode == 123) {
             return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
             return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
             return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
             return false;
            }
        
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
             return false;
            }      
         }
     */  
    </script>

@endsection