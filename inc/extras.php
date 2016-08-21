<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Shapely
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * function to show the footer info, copyright information
 */
function shapely_child_footer_info() {
  //printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'shapely' ) , '<a href="http://colorlib.com/" target="_blank">Colorlib</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
	?>
  <div id="legal">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
            <ul class="nav-horizontal" id="menu-footer-bottom">
              <li class="menu-item"><a href="https://ppgps.rultralight.com/mentions-legales/" target="_blank">Privacy Policy</a></li>
              <li class="menu-item"><a href="https://ppgps.rultralight.com/disclaimer/" target="_blank">Terms &amp; Conditions</a></li>
            </ul>
        </div>
        <div class="col-sm-6">
          <p id="site-info" style="float:right;">©R.ultralight <span id="year">2016</span> <script>jQuery("#year").html(new Date().getFullYear());</script></p>
        </div>
      </div>
    </div>
	</div>
	<?php
  }

