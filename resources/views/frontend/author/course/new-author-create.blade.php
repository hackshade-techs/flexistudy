@extends('frontend.layouts.app')
@section('title')
    {{ trans('navs.frontend.instructor_dashboard') }} - {{trans('strings.frontend.create-course')}}
@stop
@section('content')
    <div class="jumbotron">
        <div class="bg-stripe-overlay">
            <div class="container">
                <div class="left">
                    <h2 style="font-size: 35px;">{{ trans('navs.frontend.become_an_author') }}</h2>
                    <p><i class="fa fa-minus"></i><i class="fa fa-minus"></i></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-md-push-0">
                    <div class="content">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>
                                    {{trans('strings.frontend.create-first-course')}}
                                    
                                </h5>
                            </div>
                        
                            <div class="panel panel-body">
                                <div class="well">
                                   
                                        {!! trans('strings.frontend.first-course-intro') !!}
                                    
                                    
                                </div>
                                
                                {!! Form::open(array('action' => 'Frontend\User\CourseController@store', 'class' => 'form-horizontal create-course', 'method' => 'POST', 'role' => 'form', 'enctype' => 'multipart/form-data')) !!}
    						        {{ csrf_field() }}
    						        
    						        <div class="form-group has-feedback {{ $errors->has('title') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{ trans('validation.attributes.frontend.title') }}: </label>
            							<div class="col-lg-8">
            								{!! Form::text('title', old('title'), array('id' => 'title', 'class' => 'form-control')) !!}
            						        @if ($errors->has('title'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('title') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('title') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.permalink')}}: </label>
            							<div class="col-lg-8">
            							    <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">{{config('app.url')}}courses/</span>
                                                {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'permalink', 'maxlength' => '191', 'required' => 'required']) }}
                                            </div>
            						        @if ($errors->has('slug'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('slug') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('subtitle') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.course-subtitle')}}: </label>
            							<div class="col-lg-8">
            								{!! Form::text('subtitle', old('subtitle'), array('id' => 'subtitle', 'class' => 'form-control')) !!}
            						        @if ($errors->has('subtitle'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('subtitle') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('title') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.course-category')}}: </label>
            							<div class="col-lg-8">
            								<select class="form-control" name="category" id="category">
        										@foreach($categories as $category)
        										  <option value="{{ $category->id }}">{{ $category->name }}</option>
        										@endforeach
            								</select>
            								@if ($errors->has('category'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('category') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('description') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.course-description')}}: </label>
            							<input name="description" type="hidden">
            							<div class="col-lg-8">
            								<div id="editor">
                                              
                                            </div>
            							</div>
            						</div>
            						
            						<div class="form-group has-feedback {{ $errors->has('tags') ? ' has-error ' : '' }}">
            							<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.tags')}}: </label>
            							<div class="col-lg-8">
            								{!! Form::text('tags', old('tags'), array('id' => 'tags', 'class' => '')) !!}

            						        @if ($errors->has('tags'))
            						            <span class="help-block">
            						                <strong>{{ $errors->first('tags') }}</strong>
            						            </span>
            						        @endif
            							</div>
            						</div>
            						
            						<div class="form-group">
            							<div class="col-md-10">
                                            <button type="submit" class="btn btn-success  pull-right">{{trans('strings.frontend.create-course')}}</button>
            							</div>
            						</div>
            						
    						    {!! Form::close() !!}
                                
                            </div>
                        
                        
                        </div><!--/ end panel-->
                        
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
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
          placeholder: "{{trans('strings.frontend.course-description')}}...",
          theme: 'snow'
        });
        
        var form = document.querySelector('form.create-course');
        form.onsubmit = function() {
            var description = document.querySelector('input[name=description]');
            description.value = quill.root.innerHTML;
        };
        
        // Tags

        var tags = [
            @foreach ($tags as $tag)
                {tag: "{{$tag}}" },
            @endforeach
        ];


        $( document ).ready(function() {
            $('#tags').selectize({
                plugins: ['remove_button'],
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                options: tags,
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });
        });
        
        
        
        // permalink
        $("#title").keyup(function(){
			var str = sansAccent($(this).val());
			str = str.replace(/[^a-zA-Z0-9\s]/g,"");
			str = str.toLowerCase();
			str = str.replace(/\s/g,'-');
			$("#permalink").val(str);        
		});
		
		w = "àâäçéèêëîïôöùûüÿÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸ".split("");
        w.push("Œ","œ");
        wo = "aaaceeeeiioouuuyAAACEEEEIIOOUUUY".split("");
        wo.push("OE","oe");
		function sansAccent(text){
          for(var i=0 ; i< w.length ; i++){
            text = text.replace( new RegExp(w[i],"g") , wo[i]);
          }
          return text;
        }

    </script>
@endsection
