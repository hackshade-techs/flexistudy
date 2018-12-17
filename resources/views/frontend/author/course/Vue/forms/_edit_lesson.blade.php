<div class="panel-body">
    <form @submit.prevent="updateLesson(editLesson.id)" class="form-horizontal">
        <div class="form-group">
            <label class="col-lg-2">{{trans('strings.frontend.title')}}: </label>
            <div class="col-lg-10">
	            <input type="text" v-validate="'required|max:100'" name="title" id="title" class="form-control" v-model="editLesson.title"> 
	            <small class="text-danger" v-show="errors.has('title')">@{{ errors.first('title') }}</small>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2">{{trans('strings.frontend.description')}}: </label>
            <div class="col-lg-10">
	            <input type="text" v-validate="'max:200'" name="description" id="description" class="form-control" v-model="editLesson.description"> 
	            <small class="text-danger" v-show="errors.has('description')">@{{ errors.first('description') }}</small>
            </div>
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox col-lg-12">
              <input type="checkbox" class="custom-control-input" v-model="editLesson.preview">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">{{trans('strings.frontend.free-preview')}}</span>
            </label>
        </div>
        <div class="form-group pull-right">
            <a href="#" @click.prevent="cancelEdit">{{trans('strings.frontend.cancel')}}</a>
	        <button class="btn btn-success btn-sm" type="submit" >{{trans('strings.frontend.save')}}</button>
        </div>
    </form>
</div>