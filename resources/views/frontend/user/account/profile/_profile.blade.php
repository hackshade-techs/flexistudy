<div class="panel-heading">
	{{trans('strings.frontend.edit-profile')}}
</div>
<div class="panel-body">
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-bottom:20px;">
            <avatar-upload :user="{{$logged_in_user}}" gravatar="{{$logged_in_user->picture}}" inline-template>
        		<!-- PROFILE IMAGE UPLOAD -->
        		<div class="profile-image-data">
        			<figure class="user-avatar medium">
        				<img :src="src" alt="Avatar" v-cloak class="img img-circle">
        			</figure>
        			<p class="help-block" v-cloak>@{{saveStatus}}</p>
        			<image-upload
                        :class="['btn btn-xs btn-success']"
                        text="Browse image..."
                        @imageuploaded="fileUploaded"
                        @imageuploading="saveStatus='Processing...'"
                        extensions="png,jpeg,jpg,gif"
                        :max-file-size="5242880"
                        compress="50"
                        :url="uploadURL">
                    </image-upload>
        		</div>
                    
        	</avatar-upload>
    	</div>
    </div>
    
    <div class="row">
	
    	{{ Form::model($logged_in_user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal edit-profile', 'method' => 'PATCH']) }}
            
            <div class="form-group">
                {{ Form::label('email', trans('validation.attributes.frontend.email'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('email', null,
                    ['class' => 'form-control', 'autofocus' => 'autofocus', 'disabled', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('username', trans('validation.attributes.frontend.username'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('username', null,
                    ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.username')]) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('first_name', trans('validation.attributes.frontend.first_name'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('first_name', null,
                    ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.first_name')]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('last_name', trans('validation.attributes.frontend.last_name'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.last_name')]) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('tagline', trans('validation.attributes.frontend.tagline'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('tagline', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.tagline')]) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bio', trans('validation.attributes.frontend.bio'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {!! Form::textarea('bio', null, ['class' => 'form-control', 'placeholder' => trans('strings.frontend.enter-something-about-you')]) !!}
                    <!--
                    <input name="bio" type="hidden">
    				<div id="text-editor"></div>
    				-->
                </div>
            </div>
            
            
            <div class="form-group">
                {{ Form::label('facebook', trans('validation.attributes.frontend.facebook'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    <div class="input-group">
                        <span class = "input-group-addon">https://www.facebook.com/</span>
                        {{ Form::text('facebook', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.facebook')]) }}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('twitter', trans('validation.attributes.frontend.twitter'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    <div class="input-group">
                        <span class = "input-group-addon">https://www.twitter.com/</span>
                        {{ Form::text('twitter', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.twitter')]) }}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('github', trans('validation.attributes.frontend.github'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    <div class="input-group">
                        <span class = "input-group-addon">https://www.github.com/</span>
                        {{ Form::text('github', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.github')]) }}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('linkedin', trans('validation.attributes.frontend.linkedin'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    <div class="input-group">
                        <span class = "input-group-addon">https://www.linkedin.com/</span>
                        {{ Form::text('linkedin', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.linkedin')]) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('youtube', trans('validation.attributes.frontend.youtube'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    <div class="input-group">
                        <span class = "input-group-addon">https://www.youtube.com/</span>
                        {{ Form::text('youtube', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.youtube')]) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('web', trans('validation.attributes.frontend.web'),
                ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-7">
                    {{ Form::text('web', null, ['class' => 'form-control', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.web')]) }}
                </div>
            </div>
    
            @if ($logged_in_user->canChangeEmail())
                <div class="form-group">
                    {{ Form::label('email', trans('validation.attributes.frontend.email'), ['class' => 'col-md-4 control-label']) }}
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> {{  trans('strings.frontend.user.change_email_notice') }}
                        </div>
        
                        {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => '191', 'placeholder' => trans('validation.attributes.frontend.email')]) }}
                    </div>
                </div>
            @endif
    
            <div class="form-group">
                <div class="col-md-10">
                    @if(config('demo.demo_mode') && auth()->user()->id < 6)
    	        		<input id="change-password" disabled type="button" value="Cannot save in demo mode" class="btn btn-primary">
    	        	@else
                        {{ Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary pull-right', 'id' => 'update-profile']) }}
                    @endif
                </div>
            </div>
    
        {{ Form::close() }}
  	</div>
</div>