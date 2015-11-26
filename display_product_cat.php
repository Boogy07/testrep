/**
* Add category titles of the product to shop loop in WooCommerce 2.4+ as a link.
* @param object $post
* @print string
* @author anwar baksh
*/
function showProductCategory($post) {
	$catsinClass = preg_grep("/product_cat/", get_post_class( '', $post->ID )); // extract the categories from class array
	if( $catsinClass ) { // let's make sure the category is in the class array
		$totalCats = count($catsinClass); $i=0; 
		if( $totalCats == 1) {echo "<div class='proCats'>Category: ";} else {echo "<div class='proCats'>Categories: ";}
		foreach($catsinClass as  $cats) { $i++;
		  $catParts = explode('product_cat-', $cats); // extract category title
		  $productCat = ucwords( preg_replace('/-/', ' ', $catParts[1]) ); // clean up and capitalize
		  $productCatURL = $catParts[1]; // orginal for the url
		  echo "<a href='/product-category/$productCatURL'>$productCat</a>";
		  if( $totalCats > 1 && $i < $totalCats) {echo ", ";}
		} echo "</div>";
	} else {echo '&nbsp;'; } // can't find category of product
} 
add_action( 'woocommerce_after_shop_loop_item_title', 'showProductCategory' ); // the first param can change I guess