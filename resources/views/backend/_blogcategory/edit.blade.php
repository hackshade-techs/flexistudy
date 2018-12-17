<div class="modal-body">
    <div class="panel-body">
        {!! Form::model($category, ['route' => ['admin.blog.categories.update', $category], 'method'=>'PUT', 'class' => 'form-horizontal edit-category-form']) !!}    
	        
            <div class="form-group">
                {!! Form::label("name", trans('strings.backend.name')) !!}
                {!! Form::text("name", null, ['class'=>'form-control']) !!}
                 @if ($errors->has('name'))
                    <div class="text-danger"><small>{{ $errors->first('name') }}</small></div>
                @endif
            </div>
            
	        {{ csrf_field() }}
	        
	    {!! Form::close() !!}  
        
    </div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('strings.backend.close')}}</button>
	<button type="button" class="btn btn-info" id="edit-category-submit">{{trans('strings.backend.update')}}</button>
</div>

<script>
	$(document).ready(function(){
		$('#edit-category-submit').click(function(){
			$('.edit-category-form').submit();
		});
	});
</script>