(function($) {
    $(function() {
        $('[data-toggle="push"]').each(function() {
            var $this = $(this);

            var $target = $($this.data('target') || $this.attr('href') || '#navbar');
            var direction = $this.data('direction') || 'left';
            
            $target.addClass('navbar-push').addClass('navbar-push-' + direction);
            
            var $canvas = $($this.data('canvas') ||  'body');
            $canvas.addClass('push-canvas');
            
            $this.on('click', function(e) {
                $this.toggleClass('active');
                if ($this.is('.fa-bars')) {
                    $this.toggleClass('fa-rotate-90');
                }
                $canvas.toggleClass('pushed-' + direction);
                $target.toggleClass('in');
                
            });
        });
    });
    
    $(window).on('resize', function() {
        if($(window).width() < 768) {
            $('.search-btn').removeClass('btn-sm');
            $('.search-btn').addClass('btn-block');
        }
        if($(window).width() > 767) {
            $('.search-btn').addClass('btn-sm');
            $('.search-btn').removeClass('btn-block');
        }
    });
    
    if($(window).width() < 768){
        $('.search-btn').removeClass('btn-sm');
        $('.search-btn').addClass('btn-block');
    }


    $('.dropdown').on('mouseover', function(){
        $(this).addClass('open');    
    });
    
    $('.dropdown').on('mouseout', function(){
        $(this).removeClass('open');    
    });
    
    
})(jQuery);
