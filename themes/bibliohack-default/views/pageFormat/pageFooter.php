<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/pageFooter.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015-2021 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
?>
		<div style="clear:both; height:1px;"><!-- empty --></div>
		</div><!-- end pageArea --></div><!-- end col --></div>
		<!-- end row --></div>
		<!-- end container -->

		<!-- @theme  A continuación está el footer donde hay que cambiar los textos, links e íconos para poner la data correcta del lugar -->
		<!-- start footer -->
		<footer id="footer" class="footer container">
			<div class="row justify-content-between footer-container">
				<div class="col-md-2 d-none d-md-block">
					<?php
					// @theme acá se cambia el logo de la institución del footer
					print caNavLink($this->request, caGetThemeGraphic($this->request, 'logo-moderno-vertical.jpg'), "brand-logo", "", "","");
					?>
				</div>
				<div class="col-12 col-md-8 footer-text">
					<ul class="social-icons">
						<li class="list-inline-item circular-icon">
							<a href="https://www.facebook.com/museodeartemodernodebuenosaires" 
							target="_blank">
							<i class="fa-brands fa-facebook-f"></i>
							</a>
						</li>
						<li class="list-inline-item circular-icon">
							<a href="https://www.instagram.com/modernoba" 
							target="_blank">
							<i class="fa-brands fa-instagram"></i>
							</a>
						</li>
						<li class="list-inline-item circular-icon">
							<a href="https://www.twitter.com/modernoba" 
							target="_blank">
							<i class="fa-brands fa-twitter"></i>
							</a>
						</li>
						<li class="list-inline-item circular-icon">
								<a href="https://artsandculture.google.com/partner/museo-de-arte-moderno-de-buenos-aires-museo-moderno" 
								target="_blank">
								<i class="fa-brands fa-google"></i>
								</a>
						</li>
						<li class="list-inline-item circular-icon">
							<a href="https://www.youtube.com/user/modernodebuenosaires" 
							target="_blank">
								<i class="fa-brands fa-youtube"></i>
							</a>
						</li>
					</ul>
					<p>© 2017 Museo de Arte Moderno de Buenos Aires</p>
					<p>Av. San Juan 350. San Telmo. Buenos Aires. C1147AAO.<br>Tel: +54 011 4361-6919</p>
				</div>
				<div class="col-6 d-md-none">
					<a 
						class="left-block" 
						href="<?php 
							print caNavUrl($this->request,'','',''); ?>" 
						id="mm-footerbrand"
					>MuseoModerno</a>
				</div>
				<div class="col-6 col-md-2">
					<a 
						class="right-block" 
						href="http://www.buenosaires.gob.ar/" 
						id="mm-bsasbrand"
					>BsAsCiudad</a>
				</div> 
			</div><!-- end footer-container -->
			<div style="font-size:12px; text-align:right; color:#999; padding:0 0.5rem 0.35rem 0;"
			  class="ca-bbh">
			  <p>
				  <a style="color:#999;" href="http://collectiveaccess.org">collective access</a>
				  <span>/</span>
				  <a style="color:#999;" href="http://bibliohack.org">bibiohack</a>
			  </p>
	   		</div>	
		</footer><!-- end footer -->

		<?php
			//
			// Output HTML for debug bar
			//
			if(Debug::isEnabled()) {
				print Debug::$bar->getJavascriptRenderer()->render();
			}
		?>
	
		<?php print TooltipManager::getLoadHTML(); ?>
		<div id="caMediaPanel"> 
			<div id="caMediaPanelContentArea">
			
			</div>
		</div>
		<script type="text/javascript">
			/*
				Set up the "caMediaPanel" panel that will be triggered by links in object detail
				Note that the actual <div>'s implementing the panel are located here in views/pageFormat/pageFooter.php
			*/
			var caMediaPanel;
			jQuery(document).ready(function() {
				if (caUI.initPanel) {
					caMediaPanel = caUI.initPanel({ 
						panelID: 'caMediaPanel',										/* DOM ID of the <div> enclosing the panel */
						panelContentID: 'caMediaPanelContentArea',		/* DOM ID of the content area <div> in the panel */
						exposeBackgroundColor: '#FFFFFF',						/* color (in hex notation) of background masking out page content; include the leading '#' in the color spec */
						exposeBackgroundOpacity: 0.7,							/* opacity of background color masking out page content; 1.0 is opaque */
						panelTransitionSpeed: 400, 									/* time it takes the panel to fade in/out in milliseconds */
						allowMobileSafariZooming: true,
						mobileSafariViewportTagID: '_msafari_viewport',
						closeButtonSelector: '.close'					/* anything with the CSS classname "close" will trigger the panel to close */
					});
				}
			});
			/*(function(e,d,b){var a=0;var f=null;var c={x:0,y:0};e("[data-toggle]").closest("li").on("mouseenter",function(g){if(f){f.removeClass("open")}d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mousemove",function(g){if(Math.abs(c.x-g.ScreenX)>4||Math.abs(c.y-g.ScreenY)>4){c.x=g.ScreenX;c.y=g.ScreenY;return}if(f.hasClass("open")){return}d.clearTimeout(a);a=d.setTimeout(function(){f.addClass("open")},b)}).on("mouseleave",function(g){d.clearTimeout(a);f=e(this);a=d.setTimeout(function(){f.removeClass("open")},b)})})(jQuery,window,200);*/
		</script>
	</body>
</html>
