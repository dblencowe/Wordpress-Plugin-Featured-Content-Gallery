<?php
/*  Copyright 2009  John Hamelink  (email : john@spacewebdesign.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*********************************************************\
 Based on the work of iePlexus (email : info@ieplexus.com)
\*********************************************************/
?>

<div id="featured_content_container">
	<div class="button" id="left_button"></div>
	<div class="button" id="right_button"></div>
    <?php 
    $imgthumb = get_option('gallery-use-thumb-image') ? "thumbnailimg" : "articleimg";
    $wordquantity = get_option('gallery-rss-word-quantity') ?  get_option('gallery-rss-word-quantity') : 100;
    if (get_option('gallery-way') == 'new')	{//new way
			 $arr = split(",",get_option('gallery-items-pages'));
			 if (get_option('gallery-randomize-pages'))
			 {
			 	 shuffle($arr);
			 }
			 foreach ($arr as $post_or_page_id)   
			 { 
				 get_a_post($post_or_page_id); ?>
				 <div class="imageElement">
					 <h2><?php the_title() ?></h2>
					 <?php 
						if(get_option('gallery-use-featured-content')) {?>
					     <p><?php $key="featuredtext"; echo get_post_meta($post->ID, $key, true); ?></p>
					  <?php 
					  } else {
					  ?>
					     <p><?php echo gallery_slice_content(get_the_content()); ?></p>
					  <?php
						}
						?>
					  <img src="<?php $key="articleimg"; echo get_post_meta($post->ID, $key, true); ?>" rel="<?php the_permalink() ?>" alt="<?php $key="alttext"; echo get_post_meta($post->ID, $key, true); ?>" class="full" />
				  </div>
			 <?php 
			 } ?>
	     </div>
	     <?php
	  }
	  else { ?>
	    <?php $temp_query = $wp_query; ?>
	    <?php query_posts('category_name=' . get_option('gallery-category') . '&showposts=' . get_option('gallery-items')); ?>
		<ul class="gallery">
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	       <ul class="gallery-item">
			<li class="paused">Paused</li>
			<li class="title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></title>
			<?php 
				if(get_option('gallery-use-featured-content')) {?>
					<li class="description"><?php $key="featuredtext"; echo get_post_meta($post->ID, $key, true); ?></li>
				<?php 
				} else {
				?>
					<li class="description"><?php echo gallery_slice_content(get_the_content()); ?></li>
				<?php
				}
				?>
					<li class="image"><img src="<?php $key="articleimg"; echo get_post_meta($post->ID, $key, true); ?>" rel="<?php the_permalink() ?>" alt="<?php $key="alttext"; echo get_post_meta($post->ID, $key, true); ?>" class="full" /></li>
	      </ul>
	      <?php endwhile; else: ?>
		  </ul>
	      <?php endif; ?>
	      <?php $wp_query = $temp_query; ?>
	  <?php
	  }?>
    
</div>



