@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-blog'))

@section('after-styles')
    
@endsection

@section('page-header')
    <h1>
        {{trans('strings.backend.manage-blog')}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            
            {!! Form::model($post, ['route' => ['admin.pages.update', $post->slug, $post->lang], 'method'=>'PUT', 'class' => 'form-horizontal']) !!}

                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label('title', trans('strings.backend.title'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'autocomplete' => 'off', 'required' => 'required', 'autofocus' => 'autofocus']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('slug', trans('strings.backend.permalink'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">{{config('app.url')}}</span>
                                    {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'permalink', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus']) }}
                                </div>
                                <span class="text-danger">
                                    <i class="fa fa-warning"></i>
                                    {!!trans('strings.backend.set-same-permalink')!!}
                                </span>
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('type', trans('strings.backend.type'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::select('type', array('article' => trans('strings.backend.article'), 'page' => trans('strings.backend.page')), null, ['class' => 'form-control']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('blog_category_id', trans('strings.backend.category'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::select('blog_category_id', $postCategories, null, ['class' => 'form-control']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('lang', trans('strings.backend.language'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">
                                        <img src="/images/flags/{{$post->lang}}.svg" class="flag" style="width:20px;"/>    
                                    </span>
                                    <select name="lang" class="form-control language">
                                        @foreach($languages as $key => $lang)
                                            <option value="{{$key}}" {!! $post->lang == $key ? 'selected="selected"' : '' !!}>{{$lang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('body', trans('strings.backend.body'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                <textarea id="my-editor" name="body" class="form-control">{!! old('body', $post->body) !!}</textarea>
                                {{-- Form::textarea('body', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus']) --}}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('published', trans('strings.backend.published'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-1">
                                {{ Form::checkbox('published', '1', $post->published) }}
                            </div><!--col-lg-1-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('display_main_menu', trans('strings.backend.display-main-menu'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-1">
                                {{ Form::checkbox('display_main_menu', '1', $post->display_main_menu) }}
                            </div><!--col-lg-1-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('display_main_menu', trans('strings.backend.display-footer'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-1">
                                {{ Form::checkbox('display_footer', '1', $post->display_footer) }}
                            </div><!--col-lg-1-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('featured_frontend', trans('strings.backend.featured-frontend'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-1">
                                {{ Form::checkbox('featured_frontend', '1', $post->featured_frontend) }}
                            </div><!--col-lg-1-->
                        </div><!--form control-->
                    </div><!-- /.box-body -->

                <div class="box box-info">
                    <div class="box-body">
                        <div class="pull-left">
                            {{ link_to_route('admin.pages.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        </div><!--pull-left-->
        
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-md']) }}
                        </div><!--pull-right-->
        
                        <div class="clearfix"></div>
                    </div><!-- /.box-body -->
                </div><!--box-->
        
            {{ Form::close() }}
            
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            
        };
        
        var config = {
    		codeSnippet_theme: 'Monokai',
    		language: '{{ config('app.locale') }}',
    		height: 300,
    		filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token=',
    		toolbarGroups: [
    			{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
    			{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
    			{ name: 'links' },
    			{ name: 'insert' },
    			{ name: 'forms' },
    			{ name: 'tools' },
    			{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
    			{ name: 'others' },
    			//'/',
    			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
    			{ name: 'styles' },
    			{ name: 'colors' }
    		]
    	};  
    	
        CKEDITOR.replace('my-editor', config);
        
        $('.language').on('change', function(){
            $('.flag').attr('src', '/images/flags/'+$('.language').val()+'.svg');
        })
	
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
