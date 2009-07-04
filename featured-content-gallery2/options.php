<?php
$location = $options_page; // Form Action URI
?>

<div class="wrap">
	<h2>Featured Content Gallery 2 Configuration</h2>
	<p>Use the options below to select the content for your gallery, to style your gallery, and to configure the gallery slides and transitions.</p>
        <form method="post" action="options.php"><?php wp_nonce_field('update-options'); ?>
		<fieldset name="general_options" class="options">
        <div style="padding-top: 15px"></div>
        <u><strong>Featured Content Gallery 2 Code</strong></u> - If not already included, add this code to your template file where you want the Featured Content Gallery to be displayed:<br />
        <blockquote>&lt;&#63;php include &#40;ABSPATH &#46; '/wp-content/plugins/featured-content-gallery2/gallery.php'&#41;&#59; &#63;&#62;</blockquote>
        <div style="padding-top: 10px"></div>
        <?php  $galleryoldway = (get_option('gallery-way') == 'old' || get_option('gallery-way') == '') ? "checked" : ""; 
        		   $gallerynewway = get_option('gallery-way') == 'new' ? "checked" : ""; 
        ?>
        <u><strong>Featured Content Selection</strong></u> - Select either a blog category or individual post/page IDs for your featured content:<br />
        <div style="padding-top: 5px"></div>
        <table width="690" border="0" cellpadding="0" cellspacing="7">
        <tr>
    	<td width="330">
        <input type="radio" name="gallery-way" id="gallery-way" size="25" value="old"  <?php print $galleryoldway; ?>>
        			Select here to use category selection
        </td>
  		<td width="360">
        <input type="radio" name="gallery-way" id="gallery-way" size="25" value="new"  <?php print $gallerynewway; ?>>
        			Select here to use individual post or page IDs
        </td>
		</tr>
  	    <tr>
    	<td>
        Category Name:<br />
                    <input name="gallery-category" id="gallery-category" size="25" value="<?php echo get_option('gallery-category'); ?>"></input> 
        </td>
    	<td>
        Post or Page IDs <span class="style1">(comma separated no spaces)</span>:<br />
                    <input name="gallery-items-pages" id="gallery-items-pages" size="25" value="<?php echo get_option('gallery-items-pages'); ?>"></input>
        </td>
  	    </tr>
  	    <tr>
        <td>
        Number of Items to Display:<br />
        			<input name="gallery-items" id="gallery-items" size="25" value="<?php echo get_option('gallery-items'); ?>"></input> 
        </td>
        <td>
        <?php $checked3 = get_option('gallery-randomize-pages') ? "checked" : ""; ?>
                    <input type="checkbox" name="gallery-randomize-pages" id="gallery-randomize-pages" <?php print $checked3 ?>> 
        Check here to randomize post/page ID display
        </td>
  	    </tr>
		</table>
        <div style="padding-top: 10px"></div>
		<u><strong>Remove Jquery from header?</strong></u><br />
		<table width="500" border="0" cellpadding="0" cellspacing="10">
			<tr>
				<td width="250">
					<?php $jquerychecked = get_option('gallery-jquery') ? "checked" : ""; ?>
					<input type="checkbox" name="gallery-jquery" id="gallery-jquery" <?php print $jquerychecked ?>> Only check here if you are experiencing problems with jQuery
				</td>
			</tr>
		</table>
        <div style="padding-top: 10px"></div>
        <u><strong>Required Custom Fields</strong></u>
        <div style="padding-top: 5px"></div>
        For each post or page you want to display in your gallery, regardless of your selections above, you <strong>must</strong> include a custom field. For the main gallery image, use the key <strong>articleimg</strong> and the full url of your image in the value.
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="gallery-items,gallery-way,gallery-items-pages,gallery-category,gallery-randomize-pages,gallery-jquery" />

		</fieldset>
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Update Options') ?>" /></p>
        <p><em>Featured Content Gallery WordPress Plugin 2 v1.0.0 by <a href="http://www.spacewebdesign.co.uk">John Hamelink from spacewebdesign</a></em></p>
		<p><em>Based on the work by iePlexus</em></p>
	</form>      
</div>
