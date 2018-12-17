@extends ('backend.layouts.app')

@section ('title', trans('menus.backend.sidebar.featured-courses') )

@section('after-styles')
    <style type="text/css">
      .dragArea {
        min-height: 10px;
      }
      .dragme{
        cursor: move;
      }
    </style>
@endsection

@section('page-header')
    <h1>
        {{ trans('menus.backend.sidebar.featured-courses') }}
        <small>{{ trans('labels.backend.courses.featured-courses-small') }}</small>
    </h1>
@endsection

@section('content')
    <featured-courses inline-template>
      <section class="content" v-cloak>
        <div class="row">
            
          <div class="col-md-6">
              <div class="box box-solid" v-cloak>
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('menus.backend.sidebar.courses') }}</h3>
                  <span class="text-warning">{{ trans('labels.backend.courses.drag-here') }}</span>
                </div>
                    <div class="box-body" >
                      <ul class="list-group" >
                        <draggable v-model="courses" class="dragArea" :options="{group:'courselist'}">
                          <li class="list-group-item dragme" v-for="course in courses">
                            <i class="fa fa-bars"></i>
                              @{{course.title}}
                              <span class="label label-warning pull-right">
                                @{{course.category}}  
                              </span>
                              <span class="label label-default pull-right">
                                @{{course.average_rating}} (@{{course.total_reviews}} @{{course.total_reviews | pluralize('review')}})
                              </span>
                          </li>
                        </draggable>
                      </ul>
                    </div>
                  <!-- /.box-body -->
                  
                  
              </div>
          </div>
          
          <div class="col-md-6">
              <div class="box box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('labels.backend.courses.featured-courses') }}</h3>
                    <span class="text-success">{{ trans('labels.backend.courses.drop-here') }}</span>
                  </div>
                  <div class="box-body">
                    <ul class="list-group">
                      <draggable v-model="featured_courses" class="dragArea" :options="{group:'courselist'}">
                        <li class="list-group-item dragme" v-for="course in featured_courses">
                          <i class="fa fa-bars"></i>
                          @{{course.title}}
                          <span class="label label-warning pull-right">
                            @{{course.category}}  
                          </span>
                          <span class="label label-default pull-right">
                            @{{course.average_rating}} (@{{course.total_reviews}} @{{course.total_reviews | pluralize('review')}})
                          </span>
                        </li>
                      </draggable>
                    </ul>
                    <button type="button" class="btn btn-success" @click.prevent="updateFeaturedList">{{ trans('labels.backend.courses.update-featured-list') }}</button>
                    <span class="pull-right" v-show="saveStatus">@{{saveStatus}}</span>
                  </div>
                  <!-- /.box-body -->
              </div>
          </div>
          
          
          
        </div>
        <!-- /.row -->
      </section>
    </featured-courses>
@endsection