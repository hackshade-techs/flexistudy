@extends('frontend.layouts.app')

@section('title')
    {{ trans('navs.frontend.instructor_dashboard') }} - {{trans('strings.frontend.courses')}}
@stop

@section('content')
    @include('frontend.author.course._dashboard_top')
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-md-push-0">
                    <div class="content grid">
                        <div class="row">
                            <div class="panelx panel-defaultx">
                                
                                <div class="panel-headingx">
                                    <h5>
                                        {{trans('strings.frontend.my-courses')}}
                                        <a href="{{route('frontend.author.course.create')}}" class="btn btn-success btn-sm pull-right">
                                            {{trans('strings.frontend.create-new-course')}}
                                        </a>
                                    </h5>
                                </div>
                                <div class="panel-bodyx">
                                    @foreach($courses as $course)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="mc-item mc-item-2">
                                                <div class="image-heading">
                                                    <a href="{{route('frontend.author.course.edit', $course)}}">
                                                        <img src="{{Helper::coverImage($course)}}" style="max-width: 100%;" alt="">
                                                    </a>
                                                </div>
                                                <div class="meta-categories"><a href="#">{{ $course->category->name }}</a></div>
                                                <div class="content-item">
                                                    <div class="image-author">
                                                        <img src="{{ $course->author->picture }}" alt="">
                                                    </div>
                                                    <h4><a href="{{route('frontend.author.course.edit', $course)}}">
                                                            {{$course->title}}
                                                        </a></h4>
                                                    <div class="name-author">
                                                        <a href="{{route('frontend.author.course.edit', $course)}}">
                                                            {{trans('strings.frontend.manage')}}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ft-item clearfix">
                                                    
                                                    <span style="font-size:13px;">{!!$course->status()!!}</span>
                                                    <div class="price">
                                                        {{$course->statusCode()}}
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div> <!-- end panel body -->
                            </div><!-- end panel -->
                        </div><!-- end row -->
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
    
@endsection