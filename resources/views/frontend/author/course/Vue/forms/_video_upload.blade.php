<div class="form-group">
        
    <div class="lists">
        <div class="col-md-12" v-for="(file, index) in videoFiles">
            <div class="progress">
                <div class="progress-bar" role="progressbar" :style="{ width: file.progress + '%'}" aria-valuemax="100"></div>
            </div>
            
            <ul class="list-inline">
                <li>{{trans('strings.frontend.uploading')}}: @{{file.name}}</li>
                <li>{{trans('strings.frontend.size')}}: @{{ '~' +(file.size/1000000).toFixed(1) + 'MB'}}</li>
                <li v-show="file.error" class="text-danger">{{trans('strings.frontend.error')}}: @{{file.error}}</li>
                <li v-show="file.active">{{trans('strings.frontend.uploading')}}...</li>
            </ul>
        </div>
    </div>
    
    <div class="upload-btn col-md-12">
        <div class="col-md-4">
            <div class="upload-btn btn btn-primary" :disabled="isUploading"> 
                <file-upload
                    title="{{trans('strings.frontend.choose-video')}}"
                    name="video"
                    extensions="mp4"
                    auto="true"
                    post-action="/api/author/lesson/video/upload"
                    accept='video/mp4'
                    :multiple="false"
                    :files="videoFiles"
                    :data="lesson"
                    :events="events"
                    ref="video"
                    @fileSelected="isFileChosen=true"
                    @endUpload="cancelProcess"
                    @uploading="isUploading=true">
                </file-upload>
            </div>
        </div>
        <div class="col-md-4">
            <a href="#" @click.prevent="cancelProcess" v-if="!isUploading">{{trans('strings.frontend.cancel')}}</a>
            
            <button v-show="!video.active && isFileChosen" @click.prevent="video.active = true" class="btn btn-success" type="button">{{trans('strings.frontend.start-uploading')}}</button>
            <button v-show="video.active" @click.prevent="video.active = false" class="btn btn-danger" type="button">{{trans('strings.frontend.stop-uploading')}}</button>
        </div>
    </div>
</div>