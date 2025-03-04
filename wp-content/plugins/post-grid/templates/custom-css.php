<?php

/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access
	
	
	$class_post_grid_functions = new class_post_grid_functions();
	$items_bg_color_values = $class_post_grid_functions->items_bg_color_values();
	
	//var_dump($items_bg_color_values);
	
	
	$post_grid_layout_content = get_option( 'post_grid_layout_content' );
	
	if(empty($post_grid_layout_content)){
		$layout = $class_post_grid_functions->layout_content($layout_content);
		}
	else{
		
		if(!empty($post_grid_layout_content[$layout_content])){
			$layout = $post_grid_layout_content[$layout_content];
			}
		else{
			$layout =array();
			}
		
		
		}
	
	?>
    <style type="text/css">
    <?php

	foreach($layout as $item_id=>$item_info){
		$item_css = $item_info['css'];
		$item_key = $item_info['key'];		
		
		//var_dump($item_key);	
		
		if($item_key=='categories' || $item_key=='tags'){
			
			?>
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?> a{<?php echo $item_css; ?>}
			<?php
			
			}
			
		elseif($item_key=='down_arrow'){
			
			//var_dump($item_info);
			
			$arrow_size = $item_info['arrow_size'];
			$arrow_bg_color = $item_info['arrow_bg_color'];			
			
			?>
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?>{<?php echo $item_css; ?>}
			
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?>{
				

				  border-left: <?php echo $arrow_size; ?> solid rgba(0, 0, 0, 0);
				  border-right: <?php echo $arrow_size; ?> solid rgba(0, 0, 0, 0);
				  border-top: <?php echo $arrow_size; ?> solid  <?php echo $arrow_bg_color; ?>;
				  height: 0;
				  width: 0;

				
				}
			
			
			<?php
			
			?>
			
			<?php			
		
			
			
			}	
			
			
		elseif($item_key=='up_arrow'){
			
			//var_dump($item_info);
			
			$arrow_size = $item_info['arrow_size'];
			$arrow_bg_color = $item_info['arrow_bg_color'];			
			
			?>
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?>{<?php echo $item_css; ?>}
			
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?>{
				

				  border-bottom: <?php echo $arrow_size; ?> solid <?php echo $arrow_bg_color; ?>;
				  border-left: <?php echo $arrow_size; ?> solid transparent;
				  border-right: <?php echo $arrow_size; ?> solid transparent;
				  height: 0;
				  width: 0;

				
				}
			
			
			<?php
		
			
			
			}			
			
			
					
			
		else{
			
			?>
			#post-grid-<?php echo $grid_id; ?> .element_<?php echo $item_id; ?>{<?php echo $item_css; ?>}
			<?php

			
			}
		
		
		
		}
		
	foreach($layout as $item_id=>$item_info){
		$item_css_hover = $item_info['css_hover'];
		
		echo '#post-grid-'.$grid_id.' .element_'.$item_id.':hover{'.$item_css_hover.'}';
		
		}		
		
	if($items_bg_color_type=='fixed'){
		
		echo '#post-grid-'.$grid_id.' .item{
			background:'.$items_bg_color.';
	
			}';
			
		}
	elseif($items_bg_color_type=='random'){
		
		$max_count = count($items_bg_color_values);
		$max_count = ($max_count - 1);		
		
		$i=0;
		foreach($items_bg_color_values as $value){
			
			
			$rand = rand(0,$max_count);
			echo '#post-grid-'.$grid_id.' .item:nth-child('.$i.'){
				background:'.$items_bg_color_values[$rand].';
		
				}';
				
				$i++;
			}
		

		
		}
		

	
	echo '</style>';
	

	
	

	

	if(!empty($custom_css)){
		echo '<style type="text/css">'.$custom_css.'</style>';	
		}
		
		echo '<style type="text/css">';
		
		
	echo '#post-grid-'.$grid_id.' .pagination .page-numbers, #post-grid-'.$grid_id.' .pagination .pager, #post-grid-'.$grid_id.' .paginate.next-previous a{
		
		font-size:'.$pagination_font_size.';		
		color:'.$pagination_font_color.';		
		background:'.$pagination_bg_color.';
		
		
		}';	



	echo '#post-grid-'.$grid_id.' .pagination .page-numbers:hover, #post-grid-'.$grid_id.' .pagination .page-numbers.current, #post-grid-'.$grid_id.' .pagination .pager.active{
		background:'.$pagination_active_bg_color.';
		}';	
	

		
		
		echo '#post-grid-'.$grid_id.' {
			padding:'.$container_padding.';
			background: '.$container_bg_color.' url('.$container_bg_image.') repeat scroll 0 0;
		}';

	

		
		
	if($items_media_height_style == 'auto_height'){
		$items_media_height = 'auto';
	}elseif($items_media_height_style == 'fixed_height'){
		$items_media_height = $items_media_fixed_height;
	}elseif($items_media_height_style == 'max_height'){
		$items_media_height = $items_media_fixed_height;
	}else{
		$items_media_height = '220px';
	}
		
		
		
		
		
		
		
		
		
	echo '#post-grid-'.$grid_id.' .item .layer-media{';
		
		if($items_media_height_style == 'fixed_height' || $items_media_height_style == 'auto_height'){
			echo 'height:'.$items_media_height.';';
		}elseif($items_media_height_style=='max_height'){
			echo 'max-height:'.$items_media_height.';';
		}else{
			echo 'height:'.$items_media_height.';';
		}

		echo 'overflow: hidden;
		}';	



	if($items_height_style == 'auto_height'){
		$items_height = 'auto';
		}
	elseif($items_height_style == 'fixed_height'){
		$items_height = $items_fixed_height;
		}
		
	elseif($items_height_style == 'max_height'){
		$items_height = $items_fixed_height;
		}		
		
	else{
		$items_height = '220px';
		}





	echo '#post-grid-'.$grid_id.' .item{
		margin:'.$items_margin.';
		padding:'.$item_padding.';
		';

	echo '}';
	

	echo '@media only screen and (min-width: 1024px ) {';

	echo '#post-grid-'.$grid_id.' .item{';

		if($items_height_style == 'fixed_height'){
			echo 'height:'.$items_height.';';
		}elseif($items_height_style=='max_height'){
			echo 'max-height:'.$items_height.';';
		}elseif($items_height_style=='auto_height'){
			echo 'height:auto;';
		}else{
			echo 'height:auto;';
		}


	echo '}';
	echo '}';



	echo '@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {';

	echo '#post-grid-'.$grid_id.' .item{';

		if($items_height_style_tablet == 'fixed_height'){
			echo 'height:'.$items_fixed_height_tablet.';';
		}elseif($items_height_style_tablet=='max_height'){
			echo 'max-height:'.$items_fixed_height_tablet.';';
		}elseif($items_height_style_tablet=='auto_height'){
			echo 'max-height:auto;';
		}else{
			echo 'height:auto;';
		}


	echo '}';
	echo '}';



	echo '@media only screen and ( min-width: 0px ) and ( max-width: 767px ){';

	echo '#post-grid-'.$grid_id.' .item{';

		if($items_height_style_mobile == 'fixed_height'){
			echo 'height:'.$items_fixed_height_mobile.';';
		}elseif($items_height_style_mobile=='max_height'){
			echo 'max-height:'.$items_fixed_height_mobile.';';
		}elseif($items_height_style_mobile == 'auto_height'){
			echo 'height:auto;';
		}else{
			echo 'height:auto;';
		}


	echo '}';
	echo '}';





if($grid_type!='slider'){
	
	

	
	
	echo '
	@media only screen and (min-width: 1024px ) {
	#post-grid-'.$grid_id.' .item{width:'.$items_width_desktop.'}
	
	}
	
	@media only screen and ( min-width: 768px ) and ( max-width: 1023px ) {
	#post-grid-'.$grid_id.' .item{width:'.$items_width_tablet.'}
	}
	
	@media only screen and ( max-width: 767px ) {
	#post-grid-'.$grid_id.' .item{width:'.$items_width_mobile.'}
	}';
	
	}



			
			
?>
    </style>
