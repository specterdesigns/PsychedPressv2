<?php
add_action( 'admin_footer', 'rv_custom_dashboard_widget' );
function rv_custom_dashboard_widget() {
	if ( get_current_screen()->base !== 'dashboard' ) {
		return;
	}
	?>

	<div id="custom-id" class="welcome-panel" style="display: none;">
		<div class="welcome-panel-content">
			<h2>Welcome!</h2>
			<p class="about-description">You can Edit Your Site Here</p>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<h3>Get Started</h3>
					<a class="button button-primary button-hero load-customize hide-if-no-customize" href="">Customize Your Site</a>
					<p class="hide-if-no-customize"><a href="">Change Your Site Appearance</a></p>
				</div>
				<div class="welcome-panel-column">
					<h3>Next Steps</h3>
					<ul>
						<li><a href="<?php echo get_home_url(); ?>" class="welcome-icon welcome-view-site">View your site</a></li>
					</ul>
				</div>
				<div class="welcome-panel-column welcome-panel-last">
					<h3>Theme Options</h3>
					<ul>
						
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('#welcome-panel').after($('#custom-id').show());
		});
	</script>
<?php }