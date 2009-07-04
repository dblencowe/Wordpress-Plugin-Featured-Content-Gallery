$(document).ready(function() {
	//Number of 'gallery-item's -1 to make things function the way they should
	var image_number=($('#featured_content_container .gallery-item').size()-1);
	var num=0;
	var permalink = $('#featured_content_container .gallery-item:eq(0) .image img').attr("rel");
	$('#featured_content_container.description,#featured_content_container .title').fadeTo("slow", 0.66 );
	$('#featured_content_container.gallery-item:gt(0)').hide();
	
	if ( image_number <= 0 ) {
		$('#featured_content_container #left_button,#featured_content_container  #right_button').remove();
	}
	
	$('#featured_content_container li.image').click(function(){
		window.location.href=permalink;
	});
	
	
	function next(){
		$('#featured_content_container .paused').slideUp("fast");
		num++;
		$('#featured_content_container .gallery-item').hide(); //hide ALL images
		if ( num > image_number ) { //if the image we're currently on is greater than the number of images
			num=0; //set the number to 0 to reset
		}
		
		permalink = $('.gallery-item:eq('+num+') .image img').attr("rel");
		$('#featured_content_container .gallery-item:eq('+num+')').fadeIn(); //show only the gallery-item we want
	}
	
	function previous(){
		$('#featured_content_container .paused').slideUp("fast");
		num--; //1
		$('#featured_content_container .gallery-item').hide(); //hide ALL images
		if (  num < 0 ) { //if the image we're currently on is less than 0 (start of list)
			num = image_number; //set the number to the number of images there are (end of list)
		}
		permalink = $('#featured_content_container .gallery-item:eq('+num+') .image img').attr("rel");
		$('#featured_content_container .gallery-item:eq('+num+')').fadeIn(); //show only the gallery-item we want
	}
	
	$('#featured_content_container #right_button').click(function(){
		next();
	});
	
	$('#featured_content_container #left_button').click(function(){
		previous();
	});
	
	
	// Mouse effects
	$("#featured_content_container").mouseover(function()	{
		$("#featured_content_container #left_button, #featured_content_container #right_button, #featured_content_container .title, #featured_content_container .paused").fadeTo("slow", 0.66);
		$('#featured_content_container .paused').slideDown("fast");
		$('#featured_content_container .description').fadeTo("slow",0.80);
		$('#featured_content_container').stopTime();
	});
	
	$("#featured_content_container").mouseleave(function()	{
		$('#featured_content_container .paused').slideUp("fast");
		$("#featured_content_container #left_button, #featured_content_container #right_button, #featured_content_container .title").fadeTo("slow", 0.33);
		$('#featured_content_container .description').fadeTo("slow",0.66);
		slide();
	});
	
	// Timer effects
		function slide(){
		if ( image_number > 0 ) {
			$('#featured_content_container').everyTime(10000, "slide" ,function() {
				num++;
				$('#featured_content_container .gallery-item').hide(); //hide ALL images
				if ( num > image_number ) { //if the image we're currently on is greater than the number of images
					num=0; //set the number to 0 to reset
				}
				permalink = $('#featured_content_container .gallery-item:eq('+num+') .image img').attr("rel");
				$('#featured_content_container .gallery-item:eq('+num+')').fadeIn(); //show only the gallery-item we want
			});
		}
	}
	
	slide();
}); 
