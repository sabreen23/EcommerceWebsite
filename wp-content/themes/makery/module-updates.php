<div class="widget widget-slider sidebar-widget">
	<div class="widget-title">
		<h4><?php _e('New Items', 'makery'); ?></h4>
	</div>
	<?php if(empty(ThemexUser::$data['current']['updates'])) { ?>
	<span class="secondary"><?php _e('No shops favorited yet.', 'makery'); ?></span>
	<?php } else { ?>
	<div class="element-slider" data-effect="slide" data-pause="0" data-speed="0">
		<ul>
			<?php
			$counter=0;
			foreach(ThemexUser::$data['current']['updates'] as $product) {
				$attachment=get_post_thumbnail_id($product);
				$thumbnail=wp_get_attachment_url($attachment);	
				
				$counter++;
				if($counter==1) {
				?>
				<li class="clearfix">
				<?php } ?>
					<div class="column fourcol static <?php if($counter==3) { ?>last<?php } ?>">
						<div class="image-border small">
							<div class="image-wrap">
								<a href="<?php echo get_permalink($product); ?>" title="<?php echo get_the_title($product); ?>">
									<?php if($thumbnail!==false) { ?>
									<img src="<?php echo themex_resize($thumbnail, 150, 150); ?>" alt="" />
									<?php } else { ?>
									<img src="<?php echo THEME_URI.'images/product.png'; ?>" alt="" />
									<?php } ?>
								</a>
							</div>
						</div>
					</div>
				<?php 
				if($counter==3) {
				$counter=0;
				?>
				</li>
				<?php 
				}
			}
			if($counter!==0) {
			?>
			</li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>