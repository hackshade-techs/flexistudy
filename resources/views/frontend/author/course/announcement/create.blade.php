@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.create-announcement')}}
@stop
@section('content')
    @include('frontend.author.course._top')
    
    <section id="create-course-section" class="create-course-section">
        <div class="container">
            <div class="row">
            	<div class="col-md-3">
    				@include('frontend.author.course._sidebar')
    			</div>
    			
    			<div class="col-md-9">
    				
    				<div class="tab-content">
    				    <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h5>
                                   {{trans('strings.frontend.create-announcement')}}
                                    
                                    <a href="{{route('frontend.author.announcements.index', $course)}}" class="btn btn-danger btn-sm pull-right">{{trans('strings.frontend.cancel')}}</a>
                                </h5>
                            </div>
                            <div class="panel-body">
                                <form action="{{route('frontend.author.announcements.store', $course)}}" class="form-horizontal create-announcement" method="POST">
    						        {{ csrf_field() }}
    						        
    						        <div class="form-group has-feedback {{ $errors->has('title') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.title')}}: </label>
            							<div class="col-lg-10">
            								{!! Form::text('title', old('title'), array('id' => 'title', 'class' => 'form-control')) !!}
            						        @if ($errors->has('title'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('title') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('courses') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.courses')}}: </label>
            							<div class="col-lg-10">
            							    {{ Form::text('courses', null, ['class' => '', 'id' => 'courses', 'autocomplete' => 'off']) }}
            							    <!--
            								<select class="form-control " multiple="multiple" name="courses[]" id="courses">
        										@foreach($courses as $course)
        										  <option value="{{ $course->id }}">{{ $course->title }}</option>
        										@endforeach
            								</select>
            								-->
            								@if ($errors->has('courses'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('courses') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('body') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.body')}}: </label>
            							<input name="body" type="hidden">
            							<div class="col-lg-10">
            								<div id="editor">
                                              
                                            </div>
            							</div>
            						</div>
            						
            						<div class="form-group">
            							<div class="col-md-12">
            							    <span class="pull-right">
                                                <button type="submit" class="btn btn-success" {{$course->approved && $course->published ? 'null' : 'disabled' }} >
                                                    {{trans('strings.frontend.send-announcement')}}
                                                </button>
                                            </span>
            							</div>
            						</div>
            						
    						    </form>
                            </div>
                        </div>
                    </div>
    			</div>
    			
    		</div>
    	</div>
    </section>

@endsection

@section('after-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.6/quill.core.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.2.6/quill.core.js"></script>
    <script src="//cdn.quilljs.com/1.2.6/quill.min.js"></script>
	<script>
      var quill = new Quill('#editor', {
          modules: {
            toolbar: [
              ['bold', 'italic'],
              ['link', 'code-block'],
              [{ list: 'ordered' }, { list: 'bullet' }]
            ]
          },
          placeholder: "{{trans('strings.frontend.enter-announcement-content')}}",
          theme: 'snow'
        });
        
        var form = document.querySelector('form.create-announcement');
        form.onsubmit = function() {
            var body = document.querySelector('input[name=body]');
            body.value = quill.root.innerHTML;

        };

        
        
        // selectize
        var courses = [
            @foreach ($courses as $course)
            { 
                title: "{{$course->title}}", 
                id: "{{$course->id}}"
            },
            @endforeach
        ];


        $( document ).ready(function() {
            $('#courses').selectize({
                plugins: ['remove_button', 'restore_on_backspace'],
                delimiter: ',',
                persist: false,
                valueField: 'id',
                labelField: 'title',
                searchField: 'title',
                options: courses,
                create: function(input) {
                    return {
                        course: input
                    }
                }
            });
        });
        
    </script>
@endsection