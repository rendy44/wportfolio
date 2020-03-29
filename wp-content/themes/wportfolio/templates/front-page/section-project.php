<?php
/**
 * Section project template for front-page.
 *
 * @author WPerfekt
 * @package WPortfolio
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Make sure it is success process.
if ( $project_success ) {
	?>
	<div class="project-items-wrapper">
		<div class="frow">
			<?php
			foreach ( $project_items as $project_item ) {

				// Save object into variable.
				$node = $project_item->node;
				?>
				<div class="col-sm-1-2">
					<div class="project-item">
						<a href="<?php echo esc_attr( $node->url ); ?>" target="_blank"><h3><?php echo esc_html( $node->name ); ?></h3></a>
						<span class="forked"></span>
						<p><?php echo esc_html( $node->description ); ?></p>
						<ul class="project-languages">
							<?php foreach ( $node->languages->edges as $language ) { ?>
								<li><span style="background-color: <?php echo esc_attr( $language->node->color ); ?>"><?php echo esc_html( $language->node->name ); ?></span></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php
}
