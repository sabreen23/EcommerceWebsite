<?php
/*
Template Name: Shop Shipping
*/
?>
<?php get_header(); ?>
<?php get_sidebar('profile-left'); ?>
<div class="column fivecol">
	<div class="element-title indented">
		<h1><?php _e('Shipping Zones', 'makery'); ?></h1>
	</div>
	<?php ThemexInterface::renderTemplateContent('shop-shipping'); ?>
	<?php if(!ThemexWoo::isActive() || ThemexCore::checkOption('shop_shipping') || !ThemexWoo::isShipping()) { ?>
	<span class="secondary"><?php _e('This shop does not exist.', 'makery'); ?></span>
	<?php 
	} else {	
	$zones=ThemexShop::getShippingZones(ThemexShop::$data['ID']);
	?>
	<table class="profile-table">
		<thead>
			<tr>
				<th><?php _e('Name', 'makery'); ?></th>
				<th><?php _e('Regions', 'makery'); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($zones as $zone) { ?>
			<tr>
				<td>
					<a href="<?php echo ThemexCore::getURL('shop-zone', $zone['id']); ?>"><?php echo $zone['title']; ?></a>
				</td>
				<td>
					<?php 
					if($zone['type']=='default' || (empty($zone['countries']) && empty($zone['postcodes']))) {
						echo '&ndash;';
					} else {
						echo themex_list(ThemexWoo::getShippingRegions(), $zone['countries']);
						
						if(!empty($zone['countries']) && !empty($zone['postcodes'])) {
							echo ', ';
						}
						
						echo implode(',', $zone['postcodes']);
					}
					?>
				</td>
				<td class="textright nobreak">
					<a href="<?php echo ThemexCore::getURL('shop-zone', $zone['id']); ?>" title="<?php _e('Edit', 'makery'); ?>" class="element-button small square secondary">
						<span class="fa fa-pencil"></span>
					</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<a href="<?php echo ThemexCore::getURL('shop-zone'); ?>" class="element-button primary"><?php _e('Add Zone', 'makery'); ?></a>
	<?php } ?>
</div>
<?php get_sidebar('profile-right'); ?>
<?php get_footer(); ?>