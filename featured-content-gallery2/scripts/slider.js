$(document).ready(function(){var image_number=($('#featured_content_container .gallery-item').size()-1);var num=0;var permalink=$('#featured_content_container .gallery-item:eq(0) .image img').attr("rel");$('#featured_content_container .description,#featured_content_container .title').fadeTo("slow",0.66);$('#featured_content_container .gallery-item:gt(0)').hide();if(image_number<=0){$('#featured_content_container #left_button,#featured_content_container  #right_button').remove();}$('#featured_content_container li.image').click(function(){window.location.href=permalink;});function next(){$('#featured_content_container .paused').slideUp("fast");num++;$('#featured_content_container .gallery-item').hide();if(num>image_number){num=0;}permalink=$('.gallery-item:eq('+num+') .image img').attr("rel");$('#featured_content_container .gallery-item:eq('+num+')').fadeIn();}function previous(){$('#featured_content_container .paused').slideUp("fast");num--;$('#featured_content_container .gallery-item').hide();if(num<0){num=image_number;}permalink=$('#featured_content_container .gallery-item:eq('+num+') .image img').attr("rel");$('#featured_content_container .gallery-item:eq('+num+')').fadeIn();}$('#featured_content_container #right_button').click(function(){next();});$('#featured_content_container #left_button').click(function(){previous();});$("#featured_content_container").mouseover(function(){$("#featured_content_container #left_button, #featured_content_container #right_button, #featured_content_container .title, #featured_content_container .paused").fadeTo("slow",0.66);$('#featured_content_container .paused').slideDown("fast");$('#featured_content_container .description').fadeTo("slow",0.80);$('#featured_content_container').stopTime();});$("#featured_content_container").mouseleave(function(){$('#featured_content_container .paused').slideUp("fast");$("#featured_content_container #left_button, #featured_content_container #right_button, #featured_content_container .title").fadeTo("slow",0.33);$('#featured_content_container .description').fadeTo("slow",0.66);slide();});function slide(){if(image_number>0){$('#featured_content_container').everyTime(10000,"slide",function(){num++;$('#featured_content_container .gallery-item').hide();if(num>image_number){num=0;}permalink=$('#featured_content_container .gallery-item:eq('+num+') .image img').attr("rel");$('#featured_content_container .gallery-item:eq('+num+')').fadeIn();});}}slide();});
