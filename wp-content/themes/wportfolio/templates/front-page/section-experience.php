<?php
/**
 * Section experience template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="text-center">
	<p><?php echo esc_html( $experience_content ); ?></p>
</div>
</div>
</div>
<div class="frow">
	<div class="col-md-2-3">
		<div class="experience-items-wrapper">
			<div class="frow">
				<?php foreach ( $experience_items as $experience_item ) { ?>
					<div class="col-sm-1-2">
						<div class="experience-item">
							<div class="company-logo" style="background-image: url(<?php echo esc_attr( $experience_item['logo'] ); ?>)"></div>
							<div class="experience-detail">
								<h3 class="company-name"><?php echo esc_html( $experience_item['name'] ); ?> <sup><a href="<?php echo esc_attr( $experience_item['url'] ); ?>" class="company-url" target="_blank">[?]</a></sup></h3>
								<span class="experience-role"><?php echo esc_html( $experience_item['role'] ); ?></span>
								<span class="company-location"><?php echo esc_html( $experience_item['location'] ); ?></span>
								<span class="experience-period"><?php echo esc_html( $experience_item['start'] ); ?> - <?php echo esc_html( $experience_item['end'] ); ?></span>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
