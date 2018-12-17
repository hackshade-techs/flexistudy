<form class="form-horizontal" @submit.prevent="saveArticle">
    <div class="form-group">
        <quill-editor ref="myTextEditor"
            v-model="article"
            :options="editorOption"
            @blur="onEditorBlur($event)"
            @focus="onEditorFocus($event)"
            @ready="onEditorReady($event)">
        </quill-editor>
    </div>
    <div class="form-group">
        <a href="#" @click.prevent="cancelEdit">{{trans('strings.frontend.cancel')}}</a>
        <button type="submit" class="btn btn-sm btn-success">{{trans('strings.frontend.save')}}</button>
    </div>
</form>