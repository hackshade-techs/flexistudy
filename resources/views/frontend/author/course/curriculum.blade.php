@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.course-curriculum')}}
@stop
@section('after-styles')
    <style type="text/css">
        .file-uploads {
            overflow: hidden;
            position: relative;
            text-align: center;
            display: inline-block;
            background: #585858;
            padding: 8px;
            cursor: pointer;
            color: #ffffff;
            font-weight: normal;
            font-size: 12px;
        }
        .panel-body.lessons {
            padding: 15px;
            /*background: #fdf2f2;*/
        }
        .panel-heading.success{background:palegreen !important;}
    </style>

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
                                <h5>{{trans('strings.frontend.course-curriculum')}}</h5>
                            </div>
                            <div class="panel-body">
                                
                                @if(!$course->hasPreviewContent())
                                    <div class="alert alert-danger">
                                        {{trans('strings.frontend.course-has-no-preview')}}
                                    </div>
                                @endif
                                <!-- VUE template -->
    				            <manage-section :course="{{$course->id}}" :course_obj="{{$course->toJson()}}" inline-template>
    				                <div v-cloak>
    				                    <span class="text-success">@{{saveStatus}}</span>
    				                    
    				                    <draggable :options="{'handle': '.dragme', pull: 'true'}" @change="updateSectionSort">
                                            <div class="panel panel-primary clearfix" v-for="section, index in sections">
                                                <div class="panel-heading dragme">
                                        	        {{trans('strings.frontend.section')}} @{{ index+1 }}: @{{ section.title }} 
                                        	        <span class="pull-right">
                                            	        <a href="#" @click.prevent="fetchSection(section.id)" v-if="!showEdit">
                                            	            <i class="fa fa-edit"></i> {{trans('strings.frontend.edit-section')}}
                                        	            </a>
                                            	        <a href="#" @click.prevent="deleteSection(section.id)" v-if="!showEdit">
                                            	            <i class="fa fa-trash"></i> {{trans('strings.frontend.delete-section')}}
                                        	            </a>
                                        	        </span>
                                    	        </div>
                                    	        <div class="panel-body">
                                        	        <!-- Edit section -->
                                        	        <div class="clearfix">
                                                	    @include('frontend.author.course.Vue.forms._edit_section')
                                            	    </div>
                                    	            
                                    	            <!-- lessons within section -->
                                    	            <draggable style="min-height: 1px;"  :list="section.lessons" :options="{'handle': '.dragme', group: 'sorting'}"  @change="updateLessonSort">
                                                	    <div class="panel-group clearfix" v-for="lesson, index in section.lessons" :key="lesson.id">
                                        				    <div class="panel shadow panel-default">
                                        				        <div class="panel-heading clearfix" :class="lesson.preview ? 'success':''">
                                        				            <h4 class="panel-title dragme">
                                        				                {{trans('strings.frontend.lesson')}} @{{ index+1 }}: @{{ lesson.title }}  
                                        				                <small>
                                        				                <a href="#" @click.prevent="fetchEditLesson(lesson.id)" v-if="!showEditLesson" class="text-info"><i class="fa fa-edit"></i> {{trans('strings.frontend.edit-lesson')}}</a> - 
                                                                        <a href="#" @click.prevent="deleteLesson(lesson.id)" v-if="!showEditLesson" class="text-danger"><i class="fa fa-trash"></i> {{trans('strings.frontend.delete-lesson')}}</a>
                                                                        </small>
                                                            	       
                                                            	        <div class="pull-right" v-if="!showEditLesson">
                                                            	            <a data-toggle="collapse" v-if="!lesson.content && lesson.lesson_type == 'quiz'" style="color: #fff;" :href="'#lesson-'+lesson.id" class="btn btn-xs btn-success">
                                                            	                <i class="fa fa-angle-down"></i> {{trans('strings.frontend.add-question')}}
                                                        	                </a>
                                                        	                
                                                        	                
                                                            	            <a data-toggle="collapse" v-if="!lesson.content && lesson.lesson_type != 'quiz'" style="color: #fff;" :href="'#lesson-'+lesson.id" class="btn btn-xs btn-success">
                                                            	                <i class="fa fa-angle-down"></i> {{trans('strings.frontend.add-content')}}
                                                        	                </a>
                                                            	            <a data-toggle="collapse" v-if="lesson.content" :href="'#lesson-'+lesson.id"><i class="fa fa-angle-down"></i> {{trans('strings.frontend.manage-content')}}</a>
                                                            	        </div>
                                        				            </h4>
                                        				            
                                        				        </div>
                                        				        <!-- edit lesson form -->
                                        				        <div v-if="showEditLesson && editLesson.id == lesson.id">
                                    				                <edit-lesson :lesson="lesson" :section="section.id" @cancel-edit-lesson="cancelLessonEdit" inline-template>
                                    				                    @include('frontend.author.course.Vue.forms._edit_lesson')
                                    				                </edit-lesson>
                                    				            </div>
                                    				            
                                    				            
                                        				        <div :id="'lesson-'+lesson.id" class="panel-collapse collapse">
                                        				            <div class="panel-body lessons">
                                        				                <div v-if="!showAddAttachment">
                                            				                <!-- if lesson already has content, display the content here -->
                                            				                <div v-if="lesson.content && lesson.content.content_type=='article'">
                                            				                    <i class="fa fa-file-text fa-2x"></i> {{trans('strings.frontend.text-lesson')}}
                                            				                    <span><a href="#" @click.prevent="fetchEditContent(lesson.content.id)" v-if="!showEditContent"><i class="fa fa-edit"></i> {{trans('strings.frontend.edit-content')}}</a></span>
                                            				                    <span class="pull-right"><a :href="'/'+course_obj.slug+'/learn/'+lesson.uid" target="_blank"><i class="fa fa-eye"></i> {{trans('strings.frontend.preview-content')}}</a></span>
                                            				                </div>
                                            				                
                                            				                <!-- if lesson is video display form or upload button depending on the content type -->
                                            				
                                            				                <div v-if="lesson.content && lesson.content.content_type=='video'">
                                            				                    <i class="fa fa-play-circle fa-2x"></i> {{trans('strings.frontend.video-lesson')}}
                                            				                    <span><a href="#" v-if="!showEditContent" @click.prevent="setContentLesson(lesson.id, 'video', lesson.content_source, 'edit')"><i class="fa fa-edit"></i> {{trans('strings.frontend.edit-content')}}</a></span>
                                            				                    <span class="pull-right"><a :href="'/'+course_obj.slug+'/learn/'+lesson.uid" target="_blank"><i class="fa fa-eye"></i> {{trans('strings.frontend.preview-content')}}</a></span>
                                            				                </div>
                                        				                </div>
                                        				                
                                        				                <!------------------------------------------------------------------------------------------------------------------------------------->
                                            				                <div v-if="lesson.content">
                                                				                <!-- display form to upload lesson resources -->
                                                    				            
                                            				                    <div class="col-lg-12 col-sm-12" v-if="!lesson.attachments.length && !showEditContent">
                                            				                        <div class="row">
                                            				                            <a href="#" @click.prevent="clickAddAttachment()" v-if="!showAddAttachment" class="file_upload_option pull-right"><i class="fa fa-paperclip"></i> {{trans('strings.frontend.add-resource')}}</a>
                                            				                        
                                                				                        <div class="file-upoad-form" v-if="showAddAttachment">
                                                                                            <form method="POST" :action="'/author/lesson/'+lesson.id+'/attachment/upload'" class="form-inline" enctype="multipart/form-data">
                                                    				                    
                                                    				                            {{csrf_field()}}
                                                    				                            
                                                                                                <div class="form-group pull-right">
                                                                                                    
                                                                                                    <input type="file" id="attachment" @change="fileSelected" name="attachment" /><br />
                                                                                                    <button type="submit" disabled class="btn btn-primary btn-xs attachment-submit-btn">
                                                                                                        {{trans('strings.frontend.upload')}}
                                                                                                    </button>
                                                                                                    <a href="#" @click.prevent="showAddAttachment=false">
                                                                                                        <i class="fa fa-times text-danger"></i> {{trans('strings.frontend.cancel')}}
                                                                                                    </a>
                                                                                                    <br />
                                                                                                    <div class="help-block pull-right">
                                                                                                        {{trans('strings.frontend.upload-msg')}}
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                				                    
                                            				                    <span v-if="lesson.attachments" class="pull-right">
                                            				                        <ul class="list-inline" v-for="attachment in lesson.attachments">
                                            				                            <li>
                                            				                                <form>
                                            				                                    <b><i class="fa fa-paperclip"></i> {{trans('strings.frontend.attachment')}}:</b>
                                            				                                    <a :href="'/uploads/attachments/'+attachment.filename" target="_blank">@{{attachment.filename}}</a> &nbsp;
                                            				                                    
                                                				                                <a href="#" @click.prevent="deleteAttatchment(lesson.id, attachment.key)">
                                                				                                    <i class="fa fa-times text-danger"></i>
                                            				                                    </a>
                                        				                                    </form>
                                        				                                </li>
                                            				                        </ul>
                                            				                    </span>
                                                				                   
                                        				                    </div>
                                        				                
                                        				                
                                        				                <!------------------------------------------------------------------------------------------------------------------------------------->
                                        				                
                                        				                <!-- display the upload buttons if the lesson has no content yet -->
                                        				                
                                        				                <!-- if lesson is a quiz -->
                                        				                <div v-if="!content_type && !lesson.content && lesson.lesson_type == 'quiz'">
                                    				                        <ul class="list-unstyled" v-if="!editing_question">
                                        				                        <li v-for="(q, index) in lesson.quiz_questions">
                                        				                            @{{index+1}} - <span v-html="strippedContent(q.question)"></span> - 
                                        				                                <a href="#" @click.prevent="deleteQuestion(q.id)" class="text-danger"><i class="fa fa-trash"></i></a> &nbsp;
                                        				                                <a href="#" @click.prevent="editQuestion(q)" class="text-success"><i class="fa fa-pencil"></i></a>
                                        				                            <ul class="list-unstyled answer-choices">
                                        				                                <li v-for="(answer, index) in q.answers">
                                        				                                    <i class="fa fa-angle-double-right"></i> @{{answer.answer}} <span class="fa fa-check" v-if="answer.correct"></span>
                                        				                                </li>
                                        				                            </ul>
                                        				                        </li>    
                                        				                    </ul>
                                        				                    
                                        				                    
                                        				                    
                                        				                    <edit-question :q="questionBeingEdited" inline-template v-if="editing_question && questionBeingEdited" @question-created="questionCreated()">
                                        				                        <div>
                                        				                            <div class="col-md-12">
                                            				                            <form class="form-horizontal" @submit.prevent="updateQuestion">
                                            				                                <div class="form-group">
                                                                                                <label>Question:</label>
                                                                                                <quill-editor ref="myTextEditor"
                                                                                                    v-model="question.question"
                                                                                                    :options="editorOption">
                                                                                                </quill-editor>
                                                                                            </div>
                                                                                            
                                                                                            <div class="form-group">
                                                                                                <a href="#" @click.prevent="addAnswer=true" v-if="!addAnswer && question.question">
                                                                                                    <i class="fa fa-plus"></i> New answer
                                                                                                </a>
                                                                                            </div>
                                                                                            
                                                                                            <ul class="list-unstyled">
                                                                                                <li v-for="(answer, index) in question.answers">
                                                                                                    @{{index+1}} - @{{answer.answer}} <i class="fa fa-check text-success" v-if="answer.correct"></i> <i class="fa fa-times text-warning" v-if="!answer.correct"></i> - 
                                                                                                        <a href="#" @click.prevent="removeAnswer(index)"><i class="fa fa-remove text-danger"></i> remove</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                            
                                                                                            <div v-if="addAnswer">
                                                                                                <div class="form-group">
                                                                                                    <label>Answer</label><br />
                                                                                                    <textarea class="form-control" v-model="newText"></textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="custom-control custom-checkbox">
                                                                                                      <input type="checkbox" class="custom-control-input" v-model="newCorrect">
                                                                                                      <span class="custom-control-indicator"></span>
                                                                                                      <span class="custom-control-description">Correct Answer?</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Explain why the answer is or isn't the best choice:</label><br />
                                                                                                    <input class="form-control" type="text" v-model="newExplanation">
                                                                                                    
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <button @click.prevent="saveAnswer()" v-if="newText && (newText.replace(/ /g,'')).length" class="btn btn-xs btn-default pull-right">Add answer</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <span class="text-danger" v-if="countCorrect == 0 || countCorrect > 1">
                                                                                                ** {{trans('strings.frontend.you-must-add-one-correct-answer')}} **
                                                                                            </span>
                                                                                            <div class="form-group" v-if="question.answers && question.answers.length > 1">
                                                                                                
                                                                                                <button type="submit" class="btn btn-xs btn-success pull-right" v-if="countCorrect == 1">
                                                                                                    {{trans('strings.frontend.update')}}
                                                                                                </button>
                                                                                            </div>
                                                                                            
                                            				                            </form>
                                        				                            </div>
                                        				                            
                                        				                        </div>
                                        				                    </edit-question>
                                        				                    
                                        				                    <a href="#" @click.prevent="fetchSections()" v-if="editing_question">Cancel</a>
                                        				                    
                                        				                    
                                        				                    
                                        				                    
                                        				                    
                                        				                    
                                        				                    <create-question inline-template :lesson="lesson.id" @cancel-edit-content="cancelLessonEdit" @question-created="questionCreated()" v-if="!editing_question">
                                        				                        <div>
                                        				                            
                                        				                    
                                            				                        <button class="btn btn-default btn-sm" @click.prevent="addQuestion=true" v-if="!addQuestion"><i class="fa fa-plus"></i> {{trans('strings.frontend.add-question')}}</button>
                                            				                        <hr />
                                                				                    <div class="col-md-12" v-if="addQuestion">
                                                				                        <form class="form-horizontal" @submit.prevent="saveQuestion">
                                                                                            <div class="form-group">
                                                                                                <label>Question:</label>
                                                                                                <quill-editor ref="myTextEditor"
                                                                                                    v-model="question"
                                                                                                    :options="editorOption"
                                                                                                    @blur="onEditorBlur($event)"
                                                                                                    @focus="onEditorFocus($event)"
                                                                                                    @ready="onEditorReady($event)">
                                                                                                </quill-editor>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <a href="#"@click.prevent="addAnswer=true" v-if="!addAnswer && question">
                                                                                                    <i class="fa fa-plus"></i> New answer
                                                                                                </a>
                                                                                            </div>
                                                                                            
                                                                                            <ul class="list-unstyled">
                                                                                                <li v-for="(ans, index) in answers">
                                                                                                    @{{index+1}} - @{{ans.text}} <i class="fa fa-check text-success" v-if="ans.correct"></i> <i class="fa fa-times text-warning" v-if="!ans.correct"></i> - 
                                                                                                        <a href="#" @click.prevent="removeAnswer(index)"><i class="fa fa-remove text-danger"></i> remove</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                            <div v-if="addAnswer">
                                                                                                <div class="form-group">
                                                                                                    <label>Answer</label><br />
                                                                                                    <textarea class="form-control" v-model="answer.text"></textarea>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label class="custom-control custom-checkbox">
                                                                                                      <input type="checkbox" class="custom-control-input" v-model="answer.correct">
                                                                                                      <span class="custom-control-indicator"></span>
                                                                                                      <span class="custom-control-description">Correct Answer?</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label>Explain why the answer is or isn't the best choice:</label><br />
                                                                                                    <input class="form-control" type="text" v-model="answer.explanation">
                                                                                                    
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <button @click.prevent="saveAnswer()" v-if="answer.text && (answer.text.replace(/ /g,'')).length" class="btn btn-xs btn-default pull-right">Add answer</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                            <span class="text-danger" v-if="countCorrect == 0 || countCorrect > 1">
                                                                                                ** {{trans('strings.frontend.you-must-add-one-correct-answer')}} **
                                                                                            </span>
                                                                                            <hr />
                                                                                            <div class="form-group">
                                                                                                <a href="#" @click.prevent="cancelEdit">{{trans('strings.frontend.cancel')}}</a>
                                                                                                <button type="submit" class="btn btn-xs btn-success" v-if="countCorrect == 1 && answers.length > 1">
                                                                                                    {{trans('strings.frontend.save')}}
                                                                                                </button>
                                                                                               
                                                                                            </div>
                                                                                        </form>
                                                				                    </div>
                                                				                </div>
                                        				                    </create-question>
                                        				                    
                                        				                    
                                        				                    
                                        				                </div>
                                        				                
                                        				                <!-- if lesson is not a quiz -->
                                        				                <div v-if="!content_type && !lesson.content && lesson.lesson_type != 'quiz'">
                                        				                    
                                        				                    <div class="btn-group btn-group-justified">
                                        				                        <div class="btn-group">
                                                                                    <a href="#" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                                      <i class="fa fa-play-circle"></i> {{trans('strings.frontend.add-video-content')}}
                                                                                      <span class="caret"></span>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu">
                                                                                        @if(config('settings.allow_video_upload'))
                                                                                            <li><a href="#" @click.prevent="setContentLesson(lesson.id, 'video', 'upload', 'create')"><i class="fa fa-upload"></i> {{trans('strings.frontend.upload-video')}}</a></li>
                                                                                        @endif
                                                                                        @if(config('settings.allow_youtube_video'))
                                                                                            <li><a href="#" @click.prevent="setContentLesson(lesson.id, 'video', 'youtube', 'create')"><i class="fa fa-youtube"></i> {{trans('strings.frontend.youtube-link')}}</a></li>
                                                                                        @endif
                                                                                        @if(config('settings.allow_vimeo_video'))
                                                                                            <li><a href="#" @click.prevent="setContentLesson(lesson.id, 'video', 'vimeo', 'create')"><i class="fa fa-vimeo"></i> {{trans('strings.frontend.vimeo-link')}}</a></li>
                                                                                        @endif
                                                                                        @if(config('settings.allow_s3_video'))
                                                                                            <li><a href="#" @click.prevent="setContentLesson(lesson.id, 'video', 's3', 'create')"><i class="fa fa-cubes"></i> {{trans('strings.frontend.s3-link')}}</a></li>
                                                                                        @endif
                                                                                    </ul>
                                                                                </div>
                                                                                <a href="#" class="btn btn-warning" @click.prevent="setContentLesson(lesson.id, 'article', null)"><i class="fa fa-file-text"></i> {{trans('strings.frontend.add-text-content')}}</a>
                                                                                
                                                                            </div>
                                        				                </div>
                                        				                
                                    				                    <!-- if video content chosen -->
                                    				                    
                                        				                <div class="col-md-12" v-if="content_type=='video_upload' && contentLesson == lesson.id">
                                        				                    <video-upload :lesson="lesson" :max_video_upload_size="{{config('settings.max_video_upload_size')}}" @cancel-edit-content="cancelLessonEdit"></video-upload>
                                        				                    
                                        				                    
                                        				                    <div class="col-md-12" v-if="lessonAction=='edit'" class="pull-left">
                                        				                        <b>{{trans('strings.frontend.your-current-video')}} @{{lesson.content.video_filename}}</b>.
                                        				                        {{trans('strings.frontend.file-will-be-deleted')}}
                                        				                    </div>
                                        				                </div>
                                        				                
                                        				                <div class="col-md-12" v-if="(content_type=='video_youtube' || content_type=='video_s3' || content_type=='video_vimeo') && contentLesson == lesson.id">
                                        				                    @include('frontend.author.course.Vue.forms._video_embed')
                                        				                </div>
                                        				                
                                        				                <!-- if article content is chosen -->
                                        				                <div class="col-md-12" v-if="content_type=='article' && contentLesson == lesson.id">
                                        				                    <create-article :lesson="lesson.id" @cancel-edit-content="cancelLessonEdit" inline-template>
                                        				                        @include('frontend.author.course.Vue.forms._create_article')
                                        				                    </create-article>
                                        				                </div>
                                        				                
                                        				                <div class="col-md-12" v-if="editContent.content_type=='article' && showEditContent && editContent['lesson_id']==lesson.id">
                                        				                    <edit-article :edit_content="editContent"  @cancel-edit-content="showEditContent=false" inline-template>
                                        				                        @include('frontend.author.course.Vue.forms._edit_article')
                                        				                    </edit-article>
                                        				                </div>
                                        				            </div>
                                        				        </div>
                                        				    </div>
                                        				</div>
                                    				</draggable>
                                    				<!--/end lessons -->
                                    
                                    			</div>
                                            </div>
                                        </draggable>
    				                    
    				                    @include('frontend.author.course.Vue.forms._create_section')
    				                    
    				                    <div v-if="createLesson">
                                            <create-lesson :course="course" @cancel-create-lesson="cancelLessonCreate" inline-template>
                                                @include('frontend.author.course.Vue.forms._create_lesson')
                                            </create-lesson>
                                        </div>
                                            
                                        <div class="row">
                                    	    <!-- action buttons -->
                                    	    <div class="col-md-6" v-if="!createLesson && !showCreate">
                                				<a href="#" @click.prevent="createLesson = true" class="btn btn-block btn-primary"><i class="fa fa-plus-square"></i> {{trans('strings.frontend.add-a-lesson')}}</a>
                                			</div>
                                			<div class="col-md-6" v-if="!createLesson && !showCreate">
                                    	        <button class="btn btn-default btn-block" v-if="!showCreate" @click.prevent="showCreate = true"><i class="fa fa-plus-square"></i> {{trans('strings.frontend.add-a-section')}}</button>
                                    	    </div>
                                	    </div>
    				                    
    				                </div>
    				            </manage-section>
    				            
    				            <!-----/ end VUE template --->
    				            
    				            
    				        </div>
    			        </div>
			        </div>
    			</div>
    		</div>
    	</div>
    </section>

@endsection

@section('after-scripts')

@endsection