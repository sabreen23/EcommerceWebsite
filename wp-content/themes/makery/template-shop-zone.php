<?php get_header(); ?>
<?php get_sidebar('profile-left'); ?>
<div class="column fivecol">
	<?php $zone=ThemexShop::getShippingZone(ThemexShop::$data['ID'], get_query_var('shop-zone')); ?>
	<div class="element-title indented">
		<?php if(empty($zone) || !empty($zone['id'])) { ?>		
		<h1><?php _e('Edit Zone', 'makery'); ?></h1>
		<?php } else { ?>		
		<h1><?php _e('Add Zone', 'makery'); ?></h1>
		<?php } ?>
	</div>
	<?php if(!ThemexWoo::isActive() || ThemexCore::checkOption('shop_shipping') || !ThemexWoo::isShipping()) { ?>
	<span class="secondary"><?php _e('This shop does not exist.', 'makery'); ?></span>
	<?php } else if(empty($zone)) { ?>
	<span class="secondary"><?php _e('This zone does not exist.', 'makery'); ?></span>
	<?php } else { ?>
	<form action="" method="POST" class="site-form">
		<div class="message">
			<?php ThemexInterface::renderMessages(themex_value('success', $_POST, false)); ?>
		</div>
		<table class="profile-fields">
			<tbody>
				<tr>
					<th><?php _e('Name', 'makery'); ?></th>
					<td>
						<div class="field-wrap">
							<input type="text" name="title" value="<?php echo esc_attr($zone['title']); ?>" <?php if($zone['type']=='default') { ?>readonly="readonly"<?php } ?> />
						</div>
					</td>
				</tr>
				<?php if($zone['type']!='default') { ?>
				<tr>
					<th><?php _e('Countries', 'makery'); ?></th>
					<td>
						<?php
						echo ThemexInterface::renderOption(array(
							'id' => 'countries[]',
							'type' => 'select',
							'options' => ThemexWoo::getShippingRegions(),
							'value' => themex_array('countries', $zone),
							'wrap' => false,
							'attributes' => array(
								'class' => 'element-chosen',
								'multiple' => 'multiple',
								'data-placeholder' => __('Select Options', 'makery'),
							),
						));
						?>
					</td>
				</tr>
				<tr>
					<th><?php _e('Postcodes', 'makery'); ?></th>
					<td>
						<div class="field-wrap">
							<input type="text" name="postcodes" value="<?php echo esc_attr($zone['postcodes']); ?>" />
						</div>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php 
		$methods=ThemexWoo::getShippingMethods();
		foreach($methods as $method) {
		?>
			<?php if($method->id=='free_shipping' && $method->enabled=='yes') { ?>
			<h3><?php echo $method->title; ?></h3>
			<table class="profile-fields">
				<tbody>
					<tr>
						<th><?php _e('Status', 'makery'); ?></th>
						<td>
							<div class="element-select">
								<span></span>
								<?php 
								echo ThemexInterface::renderOption(array(
									'id' => 'free_shipping_enabled',
									'type' => 'select',
									'options' => array(
										'yes' => __('Enabled', 'makery'),
										'no' => __('Disabled', 'makery'),
									),
									'value' => themex_value('enabled', $zone['methods']['free_shipping'], 'yes'),
									'wrap' => false,
								));
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th><?php _e('Minimum Amount', 'makery'); ?></th>
						<td>
							<div class="field-wrap">
								<input type="text" name="free_shipping_min_amount" value="<?php echo ThemexWoo::formatPrice(themex_value('min_amount', $zone['methods']['free_shipping'], '0')); ?>" />
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
			<?php if($method->id=='flat_rate' && $method->enabled=='yes') { ?>
			<h3><?php echo $method->title; ?></h3>
			<table class="profile-fields">
				<tbody>
					<tr>
						<th><?php _e('Status', 'makery'); ?></th>
						<td>
							<div class="element-select">
								<span></span>
								<?php 
								echo ThemexInterface::renderOption(array(
									'id' => 'flat_rate_enabled',
									'type' => 'select',
									'options' => array(
										'yes' => __('Enabled', 'makery'),
										'no' => __('Disabled', 'makery'),
									),
									'value' => themex_value('enabled', $zone['methods']['flat_rate'], 'yes'),
									'wrap' => false,
								));
								?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<table class="profile-table halved">
				<thead>
					<tr>
						<th><?php _e('Shipping Class', 'makery'); ?></th>
						<th><?php _e('Cost', 'makery'); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr> 
						<td><?php _e('All Classes', 'makery'); ?></td>
						<td>
							<div class="field-wrap">
								<input type="text" name="flat_rate_default_cost" value="<?php echo ThemexWoo::formatPrice(themex_value('default_cost', $zone['methods']['flat_rate'], '0')); ?>" />
							</div>
						</td>
					</tr>
					<?php
					$classes=ThemexWoo::getShippingClasses();
					$costs=themex_array('costs', $zone['methods']['flat_rate']);

					foreach($classes as $index => $class) {
					?>
					<tr> 
						<td><?php echo $class->name; ?></td>
						<td>
							<div class="field-wrap">
								<input type="text" name="flat_rate_cost[<?php echo $index; ?>]" value="<?php echo ThemexWoo::formatPrice(themex_value($class->slug, $costs, '0')); ?>" />
								<input type="hidden" name="flat_rate_class[<?php echo $index; ?>]" value="<?php echo $class->slug; ?>" />
							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } ?>
			<?php if($method->id=='local_pickup' && $method->enabled=='yes') { ?>
			<h3><?php echo $method->title; ?></h3>
			<table class="profile-fields">
				<tbody>
					<tr>
						<th><?php _e('Status', 'makery'); ?></th>
						<td>
							<div class="element-select">
								<span></span>
								<?php 
								echo ThemexInterface::renderOption(array(
									'id' => 'local_pickup_enabled',
									'type' => 'select',
									'options' => array(
										'yes' => __('Enabled', 'makery'),
										'no' => __('Disabled', 'makery'),
									),
									'value' => themex_value('enabled', $zone['methods']['local_pickup'], 'yes'),
									'wrap' => false,
								));
								?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php } ?>
		<?php } ?>
		<a href="#" class="element-button element-submit primary"><?php _e('Save Changes', 'makery'); ?></a>
		<?php if(!empty($zone['id']) && $zone['type']=='custom') { ?>
		<a href="#zone_form" title="<?php _e('Remove', 'makery'); ?>" class="element-button element-colorbox secondary square">
			<span class="fa fa-times"></span>
		</a>
		<?php } ?>
		<input type="hidden" name="zone_id" value="<?php echo $zone['id']; ?>" />
		<input type="hidden" name="shop_id" value="<?php echo ThemexShop::$data['ID']; ?>" />
		<input type="hidden" name="shop_action" value="update_shipping" />
	</form>
	<div class="site-popups hidden">
		<div id="zone_form">
			<div class="site-popup small">
				<form class="site-form" method="POST" action="">
					<p><?php _e('Are you sure you want to permanently remove this zone?', 'makery'); ?></p>
					<a href="#" class="element-button element-submit primary"><?php _e('Remove Zone', 'makery'); ?></a>
					<input type="hidden" name="zone_id" value="<?php echo $zone['id']; ?>" />
					<input type="hidden" name="shop_id" value="<?php echo ThemexShop::$data['ID']; ?>" />
					<input type="hidden" name="shop_action" value="remove_shipping" />
				</form>
			</div>
		</div>
	</div>
	<!-- /popups -->
	<?php } ?>
</div>
<?php get_sidebar('profile-right'); ?>
<?php get_footer(); ?>