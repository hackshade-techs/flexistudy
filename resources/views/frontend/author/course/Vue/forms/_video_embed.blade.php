<form class="form-horizontal" @submit.prevent="lessonAction=='create' ? storeEmbed(lesson.id) : updateEmbed(lesson.id)">
    <div class="form-group">
        <div v-if="content_type=='video_youtube'">
            <label class="col-lg-3 label-right">{{trans('strings.frontend.youtube-link')}}: </label>
            <div class="col-lg-9">
	            <input type="text" v-validate="'required|url'" name="videoLink" id="videoLink" class="form-control" placeholder="eg https://www.youtube.com/watch?v=_U_4FPfPeGE" v-model="videoLink"> 
	            <small class="text-danger" v-show="errors.has('videoLink')">@{{ errors.first('videoLink') }}</small>
            </div>
        </div>
        <div v-if="content_type=='video_s3'">
            <label class="col-lg-3 label-right">{{trans('strings.frontend.s3-link')}}: </label>
            <div class="col-lg-9">
	            <input type="text" v-validate="'required|url'" name="videoLink" id="videoLink" class="form-control" placeholder="eg https://s3-us-west-1.amazonaws.com/bucket/test.mp4" v-model="videoLink"> 
	            <small class="text-danger" v-show="errors.has('videoLink')">@{{ errors.first('videoLink') }}</small>
            </div>
        </div>
        <div v-if="content_type=='video_vimeo'">
            <label class="col-lg-3 label-right">{{trans('strings.frontend.vimeo-link')}}: </label>
            <div class="col-lg-9">
	            <input type="text" v-validate="'required|url'" name="videoLink" id="videoLink" class="form-control" placeholder="eg https://vimeo.com/45417023" v-model="videoLink"> 
	            <small class="text-danger" v-show="errors.has('videoLink')">@{{ errors.first('videoLink') }}</small>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-lg-3 label-right">{{trans('strings.frontend.video-duration')}} ({{trans('strings.frontend.minutes')}}):</label>
        <div class="col-lg-9">
            <input type="number" v-validate="'required|numeric'" name="duration" id="duration" class="form-control" v-model="duration"> 
            <small class="text-danger" v-show="errors.has('duration')">@{{ errors.first('duration') }}</small>
        </div>
    </div>
    <div class="form-group pull-right">
        <a href="#" @click.prevent="cancelLessonEdit">{{trans('strings.frontend.cancel')}}</a>
        <button class="btn btn-success btn-sm" type="submit">{{trans('strings.frontend.save')}}</button>
    </div>
</form>