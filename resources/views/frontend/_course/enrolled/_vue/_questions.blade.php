<div>
    <span v-show="!showDetail" v-cloak>
        <span v-if="!showCreate && !showEdit">
            <div class="panel panel-body">
                <form class="form-horizontal">
                    <div class="col-md-10 col-xs-12 col-sm-12">
                        <span v-if="searching" class="question-search">
                            <vue-fuse :keys="keys" :list="questions" :defaultAll="false" :threshold="0.3"></vue-fuse>
                        </span>
                    </div>
                    <div class="col-md-2 col-xs-12 col-sm-12">
                        <span class="pull-right">
                            <a href="#" class="btn btn-primary btn-sm" @click.prevent="showCreate=true">
                                {{trans('strings.frontend.ask-a-question')}}
                            </a>
                        </span>
                    </div>
                </form>
            </div>
            <div class="panel panel-warning" v-if="results_count == 0">
                <div class="panel-heading">
                    @{{results_count}} {{trans('strings.frontend.no-results')}}.

                </div>
            </div>
            
            <div class="panel panel-body">
                
                <ul class="announcement" v-for="question in questions">
                    <span class="pull-right" v-if="question.user.can_edit">
                        <a href="#" @click.prevent="fetchEditQuestion(question.id)"><i class="fa fa-edit"></i></a>
                        <a href="#" @click.prevent="deleteQuestion(question.id)"><i class="fa fa-trash"></i></a>
                    </span>
                    
                    <a :href="'/courses/'+question.course_slug+'/learn/question/'+question.slug">
                        <li>
                            <div class="image-instructor text-center">
                                <img :src="question.user.image" alt="">
                            </div>
                            <h6 class="xsm black bold question">@{{question.title}}</h6>
                            <div class="info-instructor">
                                @{{question.user.full_name}}
                                <span class="text-muted">@{{question.created_at_human}}</span>
                                <span class="text-muted pull-right">@{{question.answers.length}} @{{question.answers.length | pluralize( trans('strings.frontend.response') )}} </span>
                                <br /><br />
                                
                                <span class="pull-right text-success" v-if="question.answered">
                                    <i class="fa fa-star fa-2x"style="color: #4caf50;"></i> {{trans('strings.frontend.answered')}}
                                </span>
                                <p style="font-size:11px;">@{{strippedHTML(question.body) | truncate(100)}}</p>
                            </div>
                            <hr class="line">
                            
                        </li>
                    </a>
                </ul>
                <div class="load-more" v-if="questions.length > 0 && current_page < total_pages">
                    <a href="" @click.prevent="fetchMoreQuestions()">{{trans('strings.frontend.load-more')}}</a>
                </div>
            </div>
        </span>
        
        <!-- create form -->
        <div class="panel panel-body" v-if="showCreate">
            <form @submit.prevent="storeQuestion">
                <div class="form-group">
                    <input class="form-control" v-model="title" placeholder="{{trans('strings.frontend.question-title')}}" />
                </div>
                <div class="form-group">
                    <quill-editor
                        v-model="body"
                        :options="editorOption"
                        @ready="onEditorReady($event)">
                    </quill-editor>
                </div>
                
                <div class="form-group">
                    <span class="pull-right">
                        <a href="#" @click.prevent="showCreate=false">{{trans('strings.frontend.cancel')}}</a>
                        <button type="submit" :class="(title=='') || (body=='') ? 'btn btn-sm btn-default' : 'btn btn-sm btn-primary'" :disabled="(title=='') || (body=='') ? 'disabled':null">{{trans('strings.frontend.ask-a-question')}}</button>
                    </span>
                </div>
            </form>
        </div>
        
        <!-- edit form -->
        <div class="panel panel-body" v-if="showEdit">
            <form @submit.prevent="updateQuestion(editQuestion.id)">
                <div class="form-group">
                    <input class="form-control" v-model="editQuestion.title"/>
                </div>
                <div class="form-group">
                    <quill-editor
                        v-model="editQuestion.body"
                        :options="editorOption"
                        @ready="onEditorReady($event)">
                    </quill-editor>
                </div>
                
                <div class="form-group">
                    <span class="pull-right">
                        <a href="#" @click.prevent="showEdit=false">{{trans('strings.frontend.cancel')}}</a>
                        <button type="submit" :class="(editQuestion.title=='') || (editQuestion.body=='') ? 'btn btn-sm btn-default' : 'btn btn-sm btn-primary'" :disabled="editQuestion.title=='' || editQuestion.body=='' ? 'disabled':null">
                            {{trans('strings.frontend.update-question')}}    
                        </button>
                    </span>
                </div>
            </form>
            
        </div>
    </span>
    
    
</div>