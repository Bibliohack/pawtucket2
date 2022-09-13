<?php
/** ---------------------------------------------------------------------
 * themes/default/Front/front_page_html : Front page of site 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
 * @package CollectiveAccess
 * @subpackage Core
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
?>
<div class="home-page">
	<div class="row">
		<div class="col-sm-12">
			<h1>Explora nuestra colección</h1>
			<h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam libero, eaque quam quidem dicta aut, at possimus cupiditate quos ex debitis rerum maiores. Ullam nisi eligendi totam cumque eum. Animi.</h2>
		</div>
 	</div><!-- end row -->
	<div class="row">
		<div class="col-sm-12">
			<form class="home-search-form" role="search" action="<?php print caNavUrl($this->request, '', 'MultiSearch', 'Index'); ?>">
				<div class="searchbar">
					<div class="form-group">
						<input type="text" class="form-control" id="homeSearchInput" placeholder="Search" name="search" autocomplete="off" />
					</div>
					<button type="submit" class="btn-search" id="homeSearchButton"><i class="fa fa-search"></i></button>
				</div>
			</form>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#homeSearchButton').prop('disabled',true);
					$('#homeSearchInput').on('keyup', function(){
						$('#homeSearchButton').prop('disabled', this.value == "" ? true : false);     
					})
				});
			</script>
		</div>
	</div><!-- end row -->
	<div class="row">
		<div class="col-sm-12">
			<h3>Ultimas adquisiciones</h3>
			<?php
				// print $this->render("Front/featured_set_slideshow_html.php");
				print $this->render("Front/featured_set_grid_html.php");
				// print $this->render("Front/gallery_set_links_html.php");
			?>
		</div>
	</div><!-- end row -->
</div>