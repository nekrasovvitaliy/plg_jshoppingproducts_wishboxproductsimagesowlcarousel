<?php
	// 
	defined('_JEXEC') or die;
	
	// 
	use \Joomla\CMS\HTML\HTMLHelper;
	use \Joomla\CMS\Uri\Uri;
	
	// 
	// 
	extract($displayData);
	// 
	// 
	HTMLHelper::_('script', Uri::root().'plugins/jshoppingproducts/wishboxproductsimagesowlcarousel/owlcarousel/owl.carousel.js');
?>


<script type="text/javascript">

	function wishboxproductsimagesowlcarousel_create()
	{
		// 
		// 
		window.wishboxproductsimagesowlcarousel = jQuery('#list_product_image_thumb').owlCarousel
		(
			{
				items:		3,
				loop:		true,
				margin:		10,
				nav:		true,
				responsive:	{
								0:
								{
									items:1
								},
								600:
								{
									items:3
								},
								1000:
								{
									items:5
								}
							}
			}
		);
	}
	jQuery(document).ready
	(
		function()
		{
			/*
			var $owlTeam;
if( $window.width() < 680 ) {
    $('.team .owlCarousel').owlCarousel({
        autoPlay: false
        , singleItem:true
        , transitionStyle : "fade"
        , pagination : true
    });
    $owlTeam = $('.team .owlCarousel').data('owlCarousel');
}

$window.resize(function() {
    if( $window.width() < 680 ) {
        $('.team .owlCarousel').owlCarousel({
            autoPlay: false
            , singleItem:true
            , transitionStyle : "fade"
            , pagination : true
        });
        $owlTeam = $('.team .owlCarousel').data('owlCarousel');
    } else {
        if( typeof $owlTeam != 'undefined' ) {
            $owlTeam.destroy();
        }
    }
});
*/
			// 
			// 
			jshop.setAttrValueOld = jshop.setAttrValue;
			// 
			// 
			jshop.setAttrValue = function(id, value)
			{
				// 
				// 
				jQuery('#list_product_image_thumb').data('owlCarousel').destroy();
				// 
				// 
				jshop.setAttrValueOld(id, value);
			};
			// 
			// 
			jshop.reloadAttribEvents[jshop.reloadAttribEvents.length] = function(json)
											{
												// 
												// 
												wishboxproductsimagesowlcarousel_create();
											};
			// 
			// 
			wishboxproductsimagesowlcarousel_create();
		}
	);
</script>
<style>
	.productfull .image_thumb_list .sblock0
	{
		width: auto;
	}
</style>