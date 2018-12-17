@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }}
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
                        
                        <questions :course_id="{{$course->id}}" inline-template>
                            @include('frontend._course.enrolled._vue._questions')
                        </questions>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->
    

@endsection

@section('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <style type="text/css">
        .ql-editor {
            /*height: 80px !important;*/
            min-height: 50px !important;
        }
    </style>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.panel.panel-warning').removeClass('hidden');
        })
    </script>
@endsection