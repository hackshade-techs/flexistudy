<div class="col-md-12" v-cloak>
    <form class="form-horizontal clearfix" @submit.prevent="updateCourse">
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.course-title')}}:</label>
            <div class="col-lg-10">
                <input :disabled="edit_course.published || edit_course.approved ? true : false" v-validate="'required|max:60'" type="text" id="title" name="title" class="form-control" v-model="edit_course.title"/>
                <small class="text-danger" v-show="errors.has('title')">@{{ errors.first('title') }}</small>
            </div>
        </div>
        <div class="form-group has-feedback {{ $errors->has('title') ? ' has-error ' : '' }}">
			<label class="col-lg-2 col-md-2 label-right">{{trans('strings.frontend.permalink')}}: </label>
			<div class="col-lg-10">
			    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">{{config('app.url')}}courses/</span>
                    <input :disabled="edit_course.published || edit_course.approved ? true : false" v-validate="'required|max:100|alpha_dash'" id="permalink" type="text" name="slug" class="form-control" v-model="edit_course.slug"/>
                </div>
                <small class="text-danger" v-show="errors.has('slug')">@{{ errors.first('slug') }}</small>
			</div>
		</div>
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.course-subtitle')}}:</label>
            <div class="col-lg-10">
                <input v-validate="'required|max:120'" type="text" name="subtitle" class="form-control" v-model="edit_course.subtitle"/>
                <small class="text-danger" v-show="errors.has('subtitle')">@{{ errors.first('subtitle') }}</small>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.course-description')}}:</label>
            <div class="col-lg-10">
            <quill-editor
                v-model="edit_course.description"
                :options="editorOption"
                @ready="onEditorReady($event)">
            </quill-editor>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.course-level')}}:</label>
            <div class="col-lg-10">
                <select name="level" class="form-control" v-model="edit_course.level">
                    <option value="beginner">{{trans('strings.frontend.beginner')}}</option>
                    <option value="intermediate">{{trans('strings.frontend.intermediate')}}</option>
                    <option value="advanced">{{trans('strings.frontend.advanced')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.language-of-instruction')}}:</label>
            <div class="col-lg-10">
                <select name="language" class="form-control" v-model="edit_course.language">
                    @foreach (array_keys(config('locale.languages')) as $lang)
                        <option value="{{$lang}}">{{trans('menus.language-picker.langs.'.$lang)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.tags')}}:</label>
            <div class="col-lg-10">
                <input type="text" id="tags" class="tags" v-model="used_tags" name="tags" />
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-lg-12">
                @if(config('demo.demo_mode') && $course->id < 10)
                    <button type="button" disabled class="btn btn-sm btn-success pull-right">Not Allowed in Demo</button>
                @else
                    <button type="submit" class="btn btn-sm btn-success pull-right">{{trans('strings.frontend.update-course')}}</button>
                @endif
                <span class="pull-left text-success">@{{ saveStatus }}</span>
            </div>
        </div>
    </form>
    <div class="row">
        <h4>{{trans('strings.frontend.course-image')}}</h4>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" style="max-width: 400px;" :src="src">
            </a>
            <div class="media-body well" style="padding: 0 0 15px 5px;">
                <h5 class="media-heading">{{trans('strings.frontend.image-specifications')}}</h5>
                {{trans('strings.frontend.image-specifications-text')}}
            </div>
            
            @if(config('demo.demo_mode') && $course->id < 10)
                <button type="button" class="btn btn-sm btn-success pull-right">Not Allowed in Demo</button>
            @else 
                <div class="form-group">
                    <image-upload
                        :class="['btn', 'btn-primary']"
                        text="{{trans('strings.frontend.choose-file')}}"
                        @imageuploaded="fileUploaded"
                        @imageuploading="saveStatus=trans('strings.frontend.processing')"
                        extensions="png,jpeg,jpg,gif"
                        :max-file-size="5242880"
                        compress="50"
                        :url="uploadURL">
                    </image-upload>
                </div>
            @endif
        </div>

    </div>
</div>