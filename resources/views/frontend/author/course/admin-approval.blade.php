@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.admin-approval')}}
@stop
@section('after-styles')
    <style type="text/css">
        .timeline {
            position: relative;
            padding: 21px 0px 10px;
            margin-top: 4px;
            margin-bottom: 30px;
        }
        
        .timeline .line {
            position: absolute;
            width: 4px;
            display: block;
            background: currentColor;
            top: 0px;
            bottom: 0px;
            margin-left: 30px;
        }
        
        .timeline .separator {
            border-top: 1px solid currentColor;
            padding: 5px;
            padding-left: 40px;
            font-style: italic;
            font-size: .9em;
            margin-left: 30px;
        }
        
        .timeline .line::before { top: -4px; }
        .timeline .line::after { bottom: -4px; }
        .timeline .line::before,
        .timeline .line::after {
            content: '';
            position: absolute;
            left: -4px;
            width: 12px;
            height: 12px;
            display: block;
            border-radius: 50%;
            background: currentColor;
        }
        
        .timeline .panel {
            position: relative;
            margin: 10px 0px 21px 70px;
            clear: both;
        }
        
        .timeline .panel::before {
            position: absolute;
            display: block;
            top: 8px;
            left: -24px;
            content: '';
            width: 0px;
            height: 0px;
            border: inherit;
            border-width: 12px;
            border-top-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
        }
        
        .timeline .panel .panel-heading.icon * { font-size: 20px; vertical-align: middle; line-height: 40px; }
        .timeline .panel .panel-heading.icon {
            position: absolute;
            left: -59px;
            display: block;
            width: 40px;
            height: 40px;
            padding: 0px;
            border-radius: 50%;
            text-align: center;
            float: left;
        }
        
        .timeline .panel-outline {
            border-color: transparent;
            background: transparent;
            box-shadow: none;
        }
        
        .timeline .panel-outline .panel-body {
            padding: 10px 0px;
        }
        
        .timeline .panel-outline .panel-heading:not(.icon),
        .timeline .panel-outline .panel-footer {
            display: none;
        }

    </style>
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
                                <h5>{{trans('strings.frontend.admin-approval')}}</h5>
                            </div>
                            <div class="panel-body">
								
								<!-- Timeline -->
                                <div class="timeline">
                                    <!-- Line component -->
                                    <div class="line text-muted"></div>
                                    
                                    @foreach($approvals as $approval)
                                        <article class="panel panel-{{ $approval->decision == 'approved' ? 'success' : 'danger' }}">
                                            <!-- Icon -->
                                            <div class="panel-heading icon">
                                                <i class="fa fa-{{ $approval->decision == 'approved' ? 'check' : 'times' }}"></i>
                                            </div>
                                            <!-- /Icon -->
                                    
                                            <!-- Heading -->
                                            <div class="panel-heading">
                                                <h2 class="panel-title">
                                                    {{ $approval->decision == 'approved' ? trans('strings.frontend.approved') : trans('strings.frontend.disapproved') }}
                                                </h2>
                                            </div>
                                            <!-- /Heading -->
                                    
                                            <!-- Body -->
                                            <div class="panel-body">
                                                {{$approval->comment}}
                                            </div>
                                            <!-- /Body -->
                                    
                                            <!-- Footer -->
                                            <div class="panel-footer">
                                                <b>{{trans('strings.frontend.reviewed-on')}} {{ $approval->created_at }}</b>
                                            </div>
                                            <!-- /Footer -->
                                    
                                        </article>
                                    @endforeach
                                </div>
                                <!-- /Timeline -->
								
								
							</div>
    			        </div>
			        </div>
				</div>
			</div>
		</div>
	</section>



@endsection

@section('after-scripts')
	<script>
        // Tags

        var taglist = [
            @foreach ($tags as $tag)
                {tag: "{{$tag}}" },
            @endforeach
        ];


        $( document ).ready(function() {
            $('#tags').selectize({
                plugins: ['remove_button', 'restore_on_backspace'],
                delimiter: ',',
                persist: false,
                valueField: 'tag',
                labelField: 'tag',
                searchField: 'tag',
                options: taglist,
                create: function(input) {
                    return {
                        tag: input
                    }
                }
            });
        });
        
        // permalink
        $("#title").keyup(function(){
			var str = sansAccent($(this).val());
			str = str.replace(/[^a-zA-Z0-9\s]/g,"");
			str = str.toLowerCase();
			str = str.replace(/\s/g,'-');
			$("#permalink").val(str);        
		});
		
		w = "àâäçéèêëîïôöùûüÿÀÂÄÇÉÈÊËÎÏÔÖÙÛÜŸ".split("");
        w.push("Œ","œ");
        wo = "aaaceeeeiioouuuyAAACEEEEIIOOUUUY".split("");
        wo.push("OE","oe");
		function sansAccent(text){
          for(var i=0 ; i< w.length ; i++){
            text = text.replace( new RegExp(w[i],"g") , wo[i]);
          }
          return text;
        }
    </script>
@endsection
