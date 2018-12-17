<div class="col-md-12">
    <form v-if="showCreate" @submit.prevent="storeSection" class="form-horizontal">
        <strong>{{trans('strings.frontend.new-section')}}</strong>
        <hr />
        <div class="form-group">
            <label class="col-lg-2 label-right">{{trans('strings.frontend.title')}}: </label>
            <div class="col-lg-10">
                <input type="text" v-validate="'required|max:100'" name="title" id="title" class="form-control" placeholder="{{trans('strings.frontend.enter-title')}}" v-model="title"> 
                <small class="text-danger" v-show="errors.has('title')">@{{ errors.first('title') }}</small>
                <small class="text-danger" v-if="err.title">@{{ err.title[0] }}</small>
            </div>
        </div>
        <div class="form-group">
            <label for="objective" class="col-lg-2 control-label">{{trans('strings.frontend.section-objective')}}:</label>
            <div class="col-lg-10">
                <input type="text" v-validate="'max:200'" name="objective" id="objective" class="form-control" placeholder="{{trans('strings.frontend.enter-objective')}}" v-model="objective"> 
                <small class="text-danger" v-show="errors.has('objective')">@{{ errors.first('objective') }}</small><br />
                <small>{{trans('strings.frontend.section-objective-detail')}}</small>
            </div>
        </div>
        <div class="form-group pull-right">
            <a href="#" @click="showCreate = false">{{trans('strings.frontend.cancel')}}</a>
            <button class="btn btn-success" type="submit" >{{trans('strings.frontend.save')}}</button>
        </div>
    </form>
</div>