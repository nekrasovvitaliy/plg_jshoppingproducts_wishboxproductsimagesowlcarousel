<?php
	// 
	defined('_JEXEC') or die;

	// 
	// 
	extract($displayData);
?>


<script type="text/javascript">
	jQuery(document).ready
	(
		function()
		{
			jQuery('#wishboxproductsimagesowlcarousel').owlCarousel
			(
				{
					items:		3,
					loop:		true,
					margin:		10,
					nav:		true,
					responsive:	{
									0:{
									items:1
									},
									600:{
										items:3
									},
									1000:{
										items:5
									}
								}
				}
			);  
		}
	);
</script>
===================================
<div class="container text-center">
	<div class="row">
		<div class="col-lg-3">
			<div class="plg_jshoppingproducts_wishboxproductsimagesowlcarousel">
				<div id="wishboxproductsimagesowlcarousel" class="owl-carousel owl-theme">
					<?php foreach($images as $image) { ?>
					<div class="ext-item-wrap">
						<div class="ext-bxslider-manufacturers-img">
							<a href="<?php echo $curr->link; ?>">
								<img
									class="jshop_img_thumb"
									src="<?php echo $config->image_product_live_path; ?>/<?php echo $image->image_thumb; ?>"
									alt="<?php echo htmlspecialchars($image->img_alt); ?>"
									title="<?php echo htmlspecialchars($image->img_title); ?>"
									onclick="jshop.showImage(<?php echo $image->image_id; ?>)"
								/>
							</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
	</div>
</div>

===================================