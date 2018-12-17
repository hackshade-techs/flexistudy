<form @submit.prevent="updateSection(editSection.id)" class="form-horizontal" v-if="showEdit&&editSection.id == section.id">
    <div class="form-group">
        <label for="title" class="col-lg-2 control-label">{{trans('strings.frontend.title')}}:</label>
        <div class="col-lg-10">
            <input type="text" v-validate="'required|max:100'" name="title" id="title" class="form-control"v-model="editSection.title"> 
            <small class="text-danger" v-show="errors.has('title')">@{{ errors.first('title') }}</small>
        </div>
    </div>
    <div class="form-group clearfix">
        <label for="objective" class="col-lg-2 control-label">{{trans('strings.frontend.section-objective')}}:</label>
        <div class="col-lg-10">
            <input type="text" v-validate="'max:200'" name="objective" id="objective" class="form-control" v-model="editSection.objective"> 
            <small class="text-danger" v-show="errors.has('objective')">@{{ errors.first('objective') }}</small>
            <small>{{trans('strings.frontend.section-objective-detail')}}</small>
        </div>
    </div>
    <div class="form-group pull-right">
        <div class="col-lg-12">
            <a href="#" @click.prevent="cancelEdit" v-if="showEdit">{{trans('strings.frontend.cancel')}}</a>
	        <button class="btn btn-success btn-sm" type="submit" >{{trans('strings.frontend.save')}}</button>
        </div>
    </div>
</form>