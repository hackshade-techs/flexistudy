<span v-cloak>
    <h5>{{trans('strings.frontend.answers')}}: @{{meta.total}}</h5>
    <ul class="announcement" v-for="answer in answers">
        <div class="answer-body" :class="answer.marked_as_answer && !showEdit ? 'bg-success' : ''">
            <span class="pull-right" v-if="answer.user.can_edit">
                <a href="#" @click.prevent="fetchEditAnswer(answer.id)" v-if="answer.user.can_edit && !showEdit"><i class="fa fa-edit"></i></a>
                <a href="#" v-if="showEdit && editAnswer.id == answer.id" @click.prevent="showEdit=false">{{trans('strings.frontend.cancel')}}</a>
                <a href="#" @click.prevent="deleteAnswer(answer.id)" v-if="answer.user.can_edit && !showEdit" class="text-danger"><i class="fa fa-trash"></i></a>
            </span>
            <li>
                <div class="image-instructor">
                    <img :src="answer.user.image" alt="">
                </div>
                <div class="info-instructor">
                    <a href="">@{{answer.user.full_name}}</a>
                    <span class="text-muted">@{{answer.created_at_human}}</span>
                    <span class="text-success" v-if="answer.marked_as_answer"><i class="fa fa-star fa-2x" style="color:#4caf50;"></i> {{trans('strings.frontend.answer')}}</span>
                    
                    <p v-html="answer.body"></p>
                    
                    <div v-if="showEdit && editAnswer.id == answer.id">
                        <form @submit.prevent="updateAnswer(answer.id)">
                            <quill-editor
                                v-model="editAnswer.body"
                                :options="editorOption"
                                @ready="onEditorReady($event)">
                            </quill-editor>
                            <div class="form-submit">
                                <input type="submit" value="{{trans('strings.frontend.update')}}" :disabled="editAnswer.body=='' ? 'disabled':null" :class="editAnswer.body=='' ? 'btn btn-default btn-sm pull-right' : 'btn btn-success btn-sm pull-right'">
                            </div>
                        </form>
                    </div>
                </div>
                <span class="pull-right" v-if="!answer.user.can_edit && !showEdit">
                   <answer-mark :answer_id="answer.id" inline-template>
                        <a href="#" @click.prevent="handle" :class="{'text-info' : userHasMarked==true, 'text-primary' : userHasMarked==false}">
                            <span v-show="markCount > 0">(@{{markCount}})</span> @{{userHasMarked==true ? trans('strings.frontend.you-marked-as-helpful') : trans('strings.frontend.mark-as-helpful')}}
                        </a>
                   </answer-mark> 
                </span>
                
                <span class="pull-left" v-if="!answer.marked_as_answer && !showEdit">
                    <a href="#" @click.prevent="markAsAnswer(answer.id)">
                        {{trans('strings.frontend.mark-as-answer')}}    
                    </a>
                </span>
                
                <hr>
                
            </li>
        </div>
    </ul>
    <div class="load-more" v-if="answers.length > 0 && current_page < total_pages">
        <a href="" @click.prevent="fetchMoreAnswers()">{{trans('strings.frontend.load-more')}}</a>
    </div>
    
    <div id="respond">
        <form @submit.prevent="storeAnswer()">
            <div class="form-group">
                <quill-editor
                    v-model="body"
                    :options="editorOption"
                    @ready="onEditorReady($event)">
                </quill-editor>
            </div>
            <div class="form-submit">
                <input type="submit" value="{{trans('strings.frontend.post-answer')}}" :disabled="body=='' ? 'disabled':null" :class="body=='' ? 'btn btn-default btn-sm' : 'btn btn-success btn-sm'">
            </div>
        </form>
    </div>
    
</span>