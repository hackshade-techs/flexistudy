<template>
    <div class="form-group">
        
        <div class="lists">
            <div class="col-md-12" v-for="(file, index) in videoFiles">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" :style="{ width: file.progress + '%'}" aria-valuemax="100"></div>
                </div>
                
                <ul class="list-inline">
                    <li>{{trans('strings.frontend.uploading')}}: {{file.name}}</li>
                    <li>{{trans('strings.frontend.size')}}: {{ '~' +(file.size/1000000).toFixed(1) + 'MB'}}</li>
                    <li v-show="file.error" class="text-danger">Error: {{file.error}}</li>
                    <li v-show="file.active">{{trans('strings.frontend.uploading')}}...</li>
                </ul>
            </div>
        </div>
        
        <div class="upload-btn col-md-12">
            <div class="form-group" v-show="!isUploading">
                <div class="col-md-6" style="margin-top:10px; margin-bottom:10px;">
                    <label><b>{{trans('strings.frontend.video-duration')}} ({{trans('strings.frontend.minutes')}}):</b></label>
                    <input type="number" v-model="video_data.duration" min="1" class="form-control" style="background-color: #fff;">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    
                    <div class="upload-btn clearfix" v-show="!isUploading && video_data.duration > 0" :disabled="isUploading"> 
                        
                        <file-upload
                            :title="trans('strings.frontend.choose-video')"
                            name="video"
                            extensions="mp4"
                            auto="true"
                            post-action="/api/author/lesson/video/upload"
                            accept='video/mp4'
                            :multiple="false"
                            :files="videoFiles"
                            :data="video_data"
                            :events="events"
                            :size="size"
                            ref="video"
                            @fileSelected="isFileChosen=true"
                            @endUpload="cancelProcess"
                            @uploading="isUploading=true">
                        </file-upload>
                        <br />
                        <span style="color: #9c27b0;font-size:12px;margin-bottom:5px;">
                            Max Size Allowed: {{max_video_upload_size}}MB. File type allowed: MP4.
                        </span>
                    </div>    
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <a href="#" @click.prevent="cancelProcess" v-if="!isUploading">{{trans('strings.frontend.cancel')}}</a>
                    <button v-show="!video.active && isFileChosen && video_data.duration > 0" @click.prevent="video.active = true" class="btn btn-success" type="button">{{trans('strings.frontend.start-uploading')}}</button>
                    <button v-show="video.active" @click.prevent="stopProcess" class="btn btn-danger" type="button">{{trans('strings.frontend.stop-uploading')}}</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    
    import FileUpload from 'vue-upload-component'
    
    export default {
        
        data: function () {
            return {
                isFileChosen: false,
                isUploading: false,
                size: 52428800, //this size is in bits. So this is 10MB
                video: {},
                videoFiles: [],
                video_data: {
                    id: this.lesson.id,
                    duration: 0
                },
                events: {
                    add(file, component) {
                        //console.log(file);
                        this.$emit('fileSelected', 'add');
                        if (this.auto) {
                            component.active = true;
                        }
                        file.headers['X-Filename'] = encodeURIComponent(file.name);
                        file.data.filename = file.name;
                    },
                    progress(file, component) {
                       this.$emit('uploading', 'uploading');
                    },
                    after(file, component) {
                        if(!file.error){
                            this.$emit('endUpload', 'end');
                        } else {
                            console.log(file.error);
                        }
                    },
                    before(file, component) {
                    }
                }
                
            }
        },
        
        components: {
            FileUpload,
        },
        
        props: ['lesson', 'max_video_upload_size'],
        
        methods: {
            cancelProcess(){
                this.$emit('cancel-edit-content', 'cancel')
            },
            
            stopProcess(){
                this.video.active=false;
                this.cancelProcess();
            }
        },
        
        mounted() {
            this.size = this.max_video_upload_size * 1048576; //convert bit to Mb
            
            this.video = this.$refs.video.$data;
            if(this.lesson.content){
                this.video_data.duration = this.lesson.content.video_duration
            }
        }
    }
</script>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }
</style>