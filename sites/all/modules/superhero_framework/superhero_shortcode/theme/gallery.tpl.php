<?php $html_id = drupal_html_id('superhero_gallery');?>
<div id="<?php print $html_id;?>">
<?php if($filter == 'yes'):?>
<div class="gallery-filters btn-group">
	<a href="#" class="btn btn-default active" data-filter="*"><?php print t('Show All');?></a><?php foreach($categories as $category):?><a href="#" class="btn btn-default" data-filter=".<?php print drupal_html_class($category);?>"><?php print $category;?></a><?php endforeach;?>
</div>
<?php endif;?>
<div class="supperhero-gallery columns-<?php print $cols?>"><?php print $content;?></div>
</div>
<style type="text/css">
.supperhero-gallery{
	margin: 3px -1.2% 0 -1%;
}
.supperhero-gallery.columns-2 .superhero-gallery-item{
	width: 47%;
	margin: 0px 1.13% 25px;
	padding: 0;
}
.supperhero-gallery.columns-3 .superhero-gallery-item{
	width: 31%;
	margin: 0px 1.13% 25px;
	padding: 0;
}
.supperhero-gallery.columns-4 .superhero-gallery-item{
	margin: 0 1.1% 25px;
	padding: 0;
	width: 22.7%;
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($){
		var $gallery = $('#<?php print $html_id;?> .supperhero-gallery');
		$gallery.isotope({
			// options
			itemSelector : '.superhero-gallery-item',
			layoutMode : 'fitRows'
		});
		<?php if($filter == 'yes'):?>
		var $filter = $('#<?php print $html_id;?> .gallery-filters');
		$filter.find('a').click(function(){
			var selector = $(this).attr('data-filter');
			$filter.find('a').removeClass('active');
			$(this).addClass('active');
			
			$gallery.isotope({ filter: selector });
			return false;
		});
		<?php endif;?>
	})
</script>