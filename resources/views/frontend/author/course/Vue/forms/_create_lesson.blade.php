<div class="col-md-12">
    <form @submit.prevent="storeLesson" class="form-horizontal">
        <strong>{{trans('strings.frontend.new-lesson')}}</strong>
        <hr/>
        <div class="form-group">
            <label class="col-lg-2">{{trans('strings.frontend.title')}}: </label>
            <div class="col-lg-10">
                <input type="text" v-validate="'required|max:100'" name="title" id="title" class="form-control" placeholder="{{trans('strings.frontend.enter-title')}}" v-model="title"> 
                <small class="text-danger" v-show="errors.has('title')">@{{ errors.first('title') }}</small>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-2">Lesson type: </label>
            <div class="col-lg-10">
	            <select class="form-control" v-model="lesson_type">
	                <option value="lecture" selected>Lecture</option>
	                <option value="quiz">Quiz</option>
	            </select>
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-lg-2">{{trans('strings.frontend.description')}}: </label>
            <div class="col-lg-10">
                <input type="text" v-validate="'max:200'" name="description"  id="description" class="form-control" placeholder="{{trans('strings.frontend.enter-description')}}" v-model="description"> 
                <small class="text-danger" v-show="errors.has('description')">@{{ errors.first('description') }}</small>
            </div>
        </div>
        
        <label class="custom-control custom-checkbox col-lg-10 col-lg-offset-1" v-if="lesson_type == 'lecture'">
          <input type="checkbox" class="custom-control-input" v-model="preview">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">{{trans('strings.frontend.free-preview')}}</span>
        </label>
        <div class="form-group">
            <span class="pull-right">
                <a href="#" @click.prevent="cancelCreate">{{trans('strings.frontend.cancel')}}</a>
                <button class="btn btn-success btn-sm" type="submit">{{trans('strings.frontend.save')}}</button>
            </span>
        </div>
    </form>
</div>