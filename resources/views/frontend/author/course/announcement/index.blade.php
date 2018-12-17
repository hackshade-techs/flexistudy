@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.announcements')}}
@stop
@section('content')
    @include('frontend.author.course._top')
    
    
    
    <section id="create-course-section" class="create-course-section">
        <div class="container">
            <div class="row">
            	<div class="col-md-3">
    				@include('frontend.author.course._sidebar')
    			</div>
    			<div class="col-md-9">
    			    <div class="tab-content">
        			    <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <h5>
                                    {{trans('strings.frontend.announcements')}}
                                    <a href="{{ route('frontend.author.announcements.create', $course) }}" class="btn btn-default btn-sm pull-right {{$course->approved && $course->published ? 'null' : 'disabled' }}">
                                        {{trans('strings.frontend.create')}}
                                    </a>
                                </h5>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
        				            <thead>
        				                <th>{{trans('strings.frontend.announcement')}}</th>
        				                <th>{{trans('strings.frontend.created-on')}}</th>
        				                <th>{{trans('strings.frontend.courses')}}</th>
        				            </thead>
        				            <tbody>
        				                @foreach($announcements as $announcement)
            				                <tr>
            				                    <td>
            				                        <a href="#" id="toggler" data-toggle="popover" data-placement="top" data-popover-content="#announcementBody" data-original-title="{!! $announcement->title !!}">{{$announcement->title}}</a>
        				                            
        				                        </td>
            				                    <td>{{$announcement->created_at}}</td>
            				                    <td>
            				                        @foreach($announcement->courses as $course)
            				                            {{$course->title}} {{$loop->last ? '':', '}}
            				                        @endforeach
            				                    </td>
            				                </tr>
            				                
            				                <div id="announcementBody" class="hidden">
    			                                {!! $announcement->body !!}
    			                            </div>
        				                @endforeach
        				            </tbody>
        				        </table>
                            </div>
                            <div class="panel-footer clearfix">
                                <a href="{{ route('frontend.author.announcements.create', $course) }}" class="btn btn-default btn-sm pull-right {{$course->approved && $course->published ? 'null' : 'disabled' }}">
                                    {{trans('strings.frontend.create')}}
                                </a>
                            </div>
                        </div>
                    </div>

    				
    			</div>
    		</div>
    	</div>
    </section>

@endsection

@section('after-scripts')
    <script type="text/javascript">
        $("[data-toggle=popover]").popover({
            container: 'body',
            html: true,
            trigger: "hover",
            content: function () {
                var clone = $($(this).data('popover-content')).clone(true).removeClass('hidden');
                return clone;
            }
    
        });

    </script>
    
    <style>
          /* Popover */
          .popover {
              min-width: 500px;
          }
          /* Popover Header */
          .popover-title {
              background-color: #14548e; 
              color: #FFFFFF; 
              font-size: 18px;
              text-align:center;
          }
          /* Popover Body */
          .popover-content {
              background-color: #fff;
              color: #d3d3;
              padding: 20px;
          }
          /* Popover Arrow */
          .arrow {
              border-top-color: #14548e !important;
          }
          </style>
    
    
@endsection
