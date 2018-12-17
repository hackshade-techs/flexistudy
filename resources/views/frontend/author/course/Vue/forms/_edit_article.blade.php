<form class="form-horizontal" @submit.prevent="updateArticle">
    <div class="form-group">
        <quill-editor
            v-model="article.article_body"
            :options="editorOption"
            @ready="onEditorReady($event)">
        </quill-editor>
    </div>
    
    <div class="form-group">
        <a href="#" @click.prevent="cancelEdit">{{trans('strings.frontend.cancel')}}</a>
        <button type="submit" class="btn btn-sm btn-success">{{trans('strings.frontend.update')}}</button>
    </div>
</form>