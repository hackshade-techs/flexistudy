<script>

	$(document).ready(function() {
		setTimeout(function() {
			$('.alert-messages').fadeOut("slow", function(){
				$(this).remove();
			})
		}, 4500);
		
        $('.main-search').focus(function () {
            var div = $('div.left').hide();    
        });
        
        $('.main-search').blur(function () {
            var div = $('div.left').show();    
        });
        
	});
	
	
	
	// stick footer to bottom
	
    function footer() {
        if ($(window).height() > $('body').height()){
            var extra = $(window).height() - $('body').height();
             $("section:last").addClass('last-section');
             $('.last-section').css('padding-bottom', extra);
        }
    }
    
    $( document ).ready(function() {
       // footer();
    });
    
    
    // Typeahead
    var courses = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/search/courses?search=%QUERY%',
            wildcard: '%QUERY%'
        },
        
    });
    
    // authors
    var authors = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/search/authors?search=%QUERY%',
            wildcard: '%QUERY%'
        },
        
    });
    
    $('.main-search').typeahead({
            hint: false,
            highlight: true,
            minLength: 1
        }, 
        {
            name: 'courses',
            display: 'title',
            //limit: 6,
            source: courses,
            templates: {
                //header: '<h5 class="result-title">Courses</h5>',
                suggestion: function(el){
                     return '<div class="tt-suggestion tt-selectable"><a href="/courses/'+el.slug+'/learn">' + el.title + ' <span class="search-item">COURSE</span></a></div>'
                }

            },
            
        },
        {
            name: 'authors',
            display: 'name',
            //limit: 4,
            source: authors,
            templates: {
                //header: '<h5 class="result-title">Authors</h5>'
                suggestion: function(el){
                     return '<div class="tt-suggestion tt-selectable"><a href="/user/'+el.username+'">' + el.name + ' <span class="search-item">AUTHOR</span></a></div>'
                }
            }
        });
    
    
    
</script>


@if(Auth::check())
    <!--------------------- modal for sending messages --------------------->
    <div class="modal fade" id="sendMessage" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-body clearfix">
              @include('frontend._messaging._create_form')
            </div>
            <div class="modal-footer clearfix">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <!--------------------- //modal for sending message --------------------->
    
    <script type="text/javascript">
        $(document).on("click", ".sendMessage", function () {
             var receiver_id = $(this).data('id');
             $(".modal-body #receiver_id").val(receiver_id );
        });
    </script>
@endif
<script>
    $(document).ready(function($) {
      var wHeight = window.innerHeight;
      $('#mk-fullscreen-searchform').css('top', wHeight / 10);
      $(window).resize(function() {
        wHeight = window.innerHeight;
        $('#mk-fullscreen-searchform').css('top', wHeight / 10);
      });
      // Search
      $('#search-button').click(function() {
        console.log("Open Search, Search Centered");
        $("div.mk-fullscreen-search-overlay").addClass("mk-fullscreen-search-overlay-show");
      });
      $("a.mk-fullscreen-close").click(function() {
        console.log("Closed Search");
        $("div.mk-fullscreen-search-overlay").removeClass("mk-fullscreen-search-overlay-show");
      });
    });
</script>


<script>
    $('#mark-all-as-read').on("click", function(e){
        e.preventDefault();
        $('#delete-notification').submit();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.feature-slider').delay(2000).fadeIn(2000);
        $('.spinner').delay(500).fadeOut(200);
    })
    
    
    // scroll reveal
    window.sr = ScrollReveal();
    
    sr.reveal('.jumbotron .left', {
      duration: 2000,
      origin:'right'
    });
    
    
    sr.reveal('.search-form-box', {
       duration: 2000,
       origin: 'bottom',
       delay: 1000,
       scale: 0.8,
    });

    
    sr.reveal('#testimonial div', {
      duration: 2000,
      origin:'right',
      delay: 1500,
    });
</script>