@extends('frontend.layouts.app')
@section('title')
    {{$question->title}}
@stop
@section('content')

    @include('frontend._course.enrolled._top')
    
    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <!-- left -->
                <div class="col-md-12">
                    <div class="sidebar-course-intro">
                        <div class="panel panel-body">
                            <a href="{{route('frontend.user.questions.index', $course)}}">
                                <i class="fa fa-angle-double-left"></i> {{trans('strings.frontend.back-to-questions')}}
                            </a>
                            <hr />
                            <ul class="announcement">
                                <li>
                                    <div class="image-instructor text-center">
                                        <img src="{{ $question->user->picture }}" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        {{ $question->user->full_name }}
                                        <span class="text-muted">{{$question->created_at->diffForHumans()}}</span>
                                        <h6 class="xsm black bold question">{{$question->title}}</h6>
                                        <p style="font-size:12px;">{!! $question->body !!}</p>
                                        
                                        <span class="pull-right clearfix" v-cloak>
                                            <question-follow :question_id="{{$question->id}}" inline-template>
                                                <a href="#" @click.prevent="handle" :class="{'text-danger' : userHasFollowed==true, 'text-success' : userHasFollowed==false}">
                                                    <i class="fa fa-mail-forward"></i> @{{userHasFollowed==true ? trans('strings.frontend.unfollow-question') : trans('strings.frontend.follow-question')}}
                                                </a>
                                            </question-follow>
                                        </span>
                                    </div>
                                    
                                    <hr>
                                </li>
                            </ul> 
                            
                            <answers :question_id="{{$question->id}}" inline-template>
                                @include('frontend._course.enrolled._vue._question_details')
                            </answers>  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    

@endsection

@section('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

    <style>
        .ql-editor {height: 100px; min-height: 50px !important;}
        
    </style>
@endsection