@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management'))

@section('after-styles')
    {{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
    <h1>
        {{ trans('labels.backend.courses.course-management') }}
        <small>{{ trans('labels.backend.courses.course-management-small') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ $course->title }} <span class="text-muted"> - <small>{{$course->author->name}}</small></span>
            </h3>
            
            <span class="pull-right">
                <a href="{{route('frontend.course.show', $course)}}" target="_blank">
                    <i class="fa fa-eye"></i> {{ trans('labels.backend.courses.preview') }}</a>
            </span>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">
                      {!! $course->status() !!}
                  </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{route('admin.courses.status.update', $course)}}" class="form-horizontal">
                    <div class="box-body">
                        @if(!$courseHasContent)
                        <div class="alert alert-danger">
                            {{trans('strings.backend.course-has-no-preview')}}
                        </div>
                        @endif
                       
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{ trans('labels.backend.courses.review-comment') }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="comment" placeholder="{{ trans('labels.backend.courses.enter-comment') }}"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">{{ trans('labels.backend.courses.decision') }}</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="decision">
                                    <option></option>
                                    @if($course->hasPreviewContent())
                                        <option value="approved">{{ trans('labels.backend.courses.approved') }}</option>
                                    @endif
                                    <option value="disapproved">{{ trans('labels.backend.courses.not-approved') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <a href="{{route('admin.courses.index')}}" class="btn btn-default">{{ trans('labels.backend.courses.cancel') }}</a>
                    <button type="submit" class="btn btn-info pull-right">{{ trans('labels.backend.courses.submit-review') }}</button>
                  </div>
                  <!-- /.box-footer -->
                  <h4>{{trans('strings.frontend.course-image')}}</h4>
                  <img src="{{Helper::coverImage($course)}}" class="img-responsive img-rounded" />
                </form>
              </div>
              <!-- /.box -->
              
            </div>
            
            
            
            
            <div class="col-md-6">
                
                <ul class="timeline">
                	@foreach($approvals as $approval)
                    	<li class="time-label">
                		  <span class="{{ $approval->decision == 'approved' ? 'bg-green' : 'bg-red'}}">
                			{{ $approval->created_at->format('Y-m-d') }}
                		  </span>
                    	</li>
                    	<li>
                    	  <div class="timeline-item">
                    		<span class="time"><i class="fa fa-clock-o"></i> {{ $approval->created_at->format('H:i:s') }}</span>
                    
                    		<div class="timeline-body">
                    		  {{ $approval->comment }}
                    		</div>
                    	  </div>
                    	</li>
                    @endforeach     
                </ul>
                
            </div>
            
            
            
            
            
        </div><!-- /.box-body -->
    </div><!--box-->

@endsection

@section('after-scripts')
    
@endsection
