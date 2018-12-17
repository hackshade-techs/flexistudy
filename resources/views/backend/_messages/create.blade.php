@extends ('backend.layouts.app')

@section ('title', trans('strings.backend.manage-messages'))

@section('after-styles')
    
@endsection

@section('page-header')
    <h1>
        {{trans('strings.backend.manage-messages')}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-body">
            
            {{ Form::open(['route' => 'admin.messages.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label('subject', trans('strings.backend.subject'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject', 'autocomplete' => 'off', 'required' => 'required', 'autofocus' => 'autofocus']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        
                        <div class="form-group">
                            {{ Form::label('recipient_group', trans('strings.backend.send-to'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::select('recipient_group', array('everyone' => trans('strings.backend.everyone'), 'admins' => trans('strings.backend.administrators'), 'authors' => trans('strings.backend.authors'), 'inactive-users' => trans('strings.backend.inactive-users'), 'students' => trans('strings.backend.all-students'),  'selected-users' => trans('strings.backend.selected-users')), null, ['class' => 'form-control', 'id'=>'recipient_group']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group recipient-list hidden">
                            {{ Form::label('recipients', trans('strings.backend.recipients'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::text('recipients', null, ['class' => '', 'id' => 'recipients', 'autocomplete' => 'off']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                        <div class="form-group">
                            {{ Form::label('body', trans('strings.backend.body'), ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                <textarea id="my-editor" name="body" class="form-control">{!! old('body', '') !!}</textarea>
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        
                    </div><!-- /.box-body -->

                <div class="box box-info">
                    <div class="box-body">
                        <div class="pull-left">
                            {{ link_to_route('admin.messages.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        </div><!--pull-left-->
        
                        <div class="pull-right">
                            {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-md']) }}
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

	
        $("#recipient_group").on('change', function(e){
            var v = $('#recipient_group').val();
            var s = $('#recipients').selectize();
            var control = s[0].selectize;
 
            if(v == 'selected-users'){
                $('.recipient-list').removeClass('hidden');
            } else {
                control.clear();
                $('.recipient-list').addClass('hidden');
            }
        })
        
        
        
        // tags
        
        var users = [
            @foreach ($users as $user)
                { 
                    name: "{{$user->name}}", 
                    id: "{{$user->id}}"
                },
            @endforeach
        ];


        $( document ).ready(function() {
            $('#recipients').selectize({
                plugins: ['remove_button', 'restore_on_backspace'],
                delimiter: ',',
                persist: false,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                options: users,
                create: function(input) {
                    return {
                        user: input
                    }
                }
            });
        });
    </script>
    
@endsection
