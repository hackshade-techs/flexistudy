@extends('frontend.layouts.app')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.course-landing-page')}}
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
                                <h5>{{trans('strings.frontend.course-landing-page')}}</h5>
                            </div>
                            <div class="panel-body">
								<edit-course :course="{{$course->toJson()}}" course_tags="{{$course->tagList}}" :alltags="{{ collect($tags) }}" inline-template>
								    @include('frontend.author.course.Vue._edit_course')
								</edit-course>
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
