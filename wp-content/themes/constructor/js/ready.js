/**
 * @package WordPress
 * @subpackage Constructor
 * 
 * @author   Anton Shevchuk <AntonShevchuk@gmail.com>
 * @link     http://anton.shevchuk.name
 */
(function($){
    $(document).ready(function(){

        // Header Drop-Down Menu
        if ($("#menu ul ul").length > 0) {

			$("#menu li:has(ul)").addClass('indicator');

			$("#menu li:has(ul)").hover(function(){
				$(this)
					.addClass('hover')
					.children('ul')
						.stop(true,true)
						.show()
					;
				$(this).find('div.menu-header-menu-container')
					   .children('ul')
                           .stop(true,true)
                           .show()
					;
			}, function(){
				$(this)
					.removeClass('hover')
					.children('ul')
					.hide()
					;
				$(this).find('div.menu-header-menu-container')
					   .children('ul').hide()
					;
			});
        }

        // Header Search Form
        var $menuSearch = $('#menusearchform .s');
        $menuSearch.mouseenter(function(){
            if (!$menuSearch.data('expand')) {
                $menuSearch.data('expand', true);
                $menuSearch.stop(true,true).animate({width:'+=32px',left:'-=16px'});
            }
        }).mouseleave(function(){
            if ($menuSearch.data('expand')) {
                $menuSearch.data('expand', false);
                $menuSearch.stop(true,true).animate({width:'-=32px',left:'+=16px'});
            }
        });

        // Header Slideshow
		if ($('.wp-sl').length > 0) {
			var sl = $('.wp-sl').wpslideshow({
			    url:wpSl.slideshow,
				thumb: wpSl.thumb,
				thumbPath: wpSl.thumbPath,
				limit: 480,
				effectTime: 1000,
				timeout: 10000,
				play: true
			});
		}

        // Tiles - small tile layout
        $('.tiles').hover(function(){
           $(this).find('.thumbnail').hide();
           $(this).find('.announce').fadeIn();
        }, function(){
           var $self = $(this);
           $self.find('.announce').fadeOut(function(){
               $self.find('.thumbnail').show();
           });
        });

		// No underline for a with img
		$('a:has(img)').css({border:0});
    });
})(jQuery);