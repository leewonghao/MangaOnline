          	$(function(){
			 $banner=$('.banner');
			if ((screen.width==1024) && (screen.height==768))
			{
				$banner. hide();
			}
			if ((screen.width==800) && (screen.height==600))
			{
				$banner. hide();
			}
			else
			{
        		$window=$(window);
        		$topDefault=parseFloat($banner.css('top'), 10);
        		$window.scroll(function(){
        			$top=$(this).scrollTop();
        			$banner.stop().animate({top: $top+$topDefault}, 1000, 'easeOutCirc');
        		});
    
        		$wiBanner=$banner.outerWidth()*2;
        		zindex($('#wrapper').outerWidth());
        		$window.resize(function(){
        			zindex($('#wrapper').outerWidth());
        		});
        		function zindex(maxWidth){
        			if($window.width() <= maxWidth+$wiBanner){
        				$banner.addClass('zindex');
        			}else{
        				$banner.removeClass('zindex');
        			}
        		};
			}
        	});