<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2018 Whirl-i-Gig
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
 
	$t_object = 			$this->getVar("item");
	$va_comments = 			$this->getVar("comments");
	$va_tags = 				$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");
	$vn_pdf_enabled = 		$this->getVar("pdfEnabled");
	$vn_id =				$t_object->get('ca_objects.object_id');
?>
<div class="row">
	<!--- only shown at small screen size -->
	<!-- <div class='col-xs-12 navTop'>
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div> -->
	<!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
			<!-- @theme changes: Switched the image and the object details. Removed all hr. Added css classes. -->
			<!-- start object header -->
			<div class='header col-xs-12 col-sm-10 col-md-10 col-lg-12'>
			<!-- <div class='col-sm-6 col-md-6 col-lg-5'> -->
				<!-- Artwork artist/creator -->
				<h2>{{{<unit relativeTo="ca_objects_x_entities" delimiter="<br/>"><unit relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l></unit></unit>}}}</h2>

				<!-- Artwork name -->
				<h3>{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"> ➔ </ifcount>}}}{{{ca_objects.preferred_labels.name}}}</h3>

				<!-- <h6>{{{<unit>^ca_objects.type_id</unit>}}}</h6> -->
				<!-- <HR> -->
				
				<!-- {{{<ifdef code="ca_objects.measurementSet.measurements">^ca_objects.measurementSet.measurements (^ca_objects.measurementSet.measurementsType)</ifdef><ifdef code="ca_objects.measurementSet.measurements,ca_objects.measurementSet.measurements"> x </ifdef><ifdef code="ca_objects.measurementSet.measurements2">^ca_objects.measurementSet.measurements2 (^ca_objects.measurementSet.measurementsType2)</ifdef>}}} -->
				
				
				<!-- {{{<ifdef code="ca_objects.idno"><h6>Identifier:</H6>^ca_objects.idno<br/></ifdef>}}}
				{{{<ifdef code="ca_objects.containerID"><h6>Box/series:</H6>^ca_objects.containerID<br/></ifdef>}}}				 -->
				
				<!-- {{{<ifdef code="ca_objects.description">
					<div class='unit'><h6>Description</h6>
						<span class="trimText">^ca_objects.description</span>
					</div>
				</ifdef>}}} -->
				
				<!-- Artwork date -->
				<!-- {{{<ifdef code="ca_objects.dateSet.setDisplayValue"><h6>Date:</h6>^ca_objects.dateSet.setDisplayValue<br/></ifdef>}}} -->
				{{{<ifdef code="ca_objects.object_dates.object_dates_value">
					<h4>
						<unit length="1" delimiter=" ">
							<if rule="^ca_objects.object_dates.object_dates_type =~ /creación/">
							^ca_objects.object_dates.object_dates_value</if>
						</unit>
					</h4>
				</ifdef>}}}
			
				<!-- <hr></hr> -->
					<!-- <div class="row">
						<div class="col-sm-6">		
							{{{<ifcount code="ca_entities" min="1" max="1"><h6>Related person</h6></ifcount>}}}
							{{{<ifcount code="ca_entities" min="2"><h6>Related people</h6></ifcount>}}}
							{{{<unit relativeTo="ca_objects_x_entities" delimiter="<br/>"><unit relativeTo="ca_entities"><l>^ca_entities.preferred_labels</l></unit> (^relationship_typename)</unit>}}}
							
							
							{{{<ifcount code="ca_places" min="1" max="1"><h6>Related place</h6></ifcount>}}}
							{{{<ifcount code="ca_places" min="2"><h6>Related places</h6></ifcount>}}}
							{{{<unit relativeTo="ca_objects_x_places" delimiter="<br/>"><unit relativeTo="ca_places"><l>^ca_places.preferred_labels</l></unit> (^relationship_typename)</unit>}}}
							
							{{{<ifcount code="ca_list_items" min="1" max="1"><h6>Related Term</h6></ifcount>}}}
							{{{<ifcount code="ca_list_items" min="2"><h6>Related Terms</h6></ifcount>}}}
							{{{<unit relativeTo="ca_objects_x_vocabulary_terms" delimiter="<br/>"><unit relativeTo="ca_list_items"><l>^ca_list_items.preferred_labels.name_plural</l></unit> (^relationship_typename)</unit>}}}
							
						</div> -->
						<!-- end col -->				
						<!-- <div class="col-sm-6 colBorderLeft">
							{{{map}}}
						</div>
					</div> -->
					<!-- end row -->
						
			</div>
			<!-- end object header -->

			
			<!-- start object image -->
			<div class='col-xs-12 col-sm-10 col-md-10 col-lg-12'>
			<!-- <div class='col-sm-6 col-md-6 col-lg-5 col-lg-offset-1'> -->
				{{{representationViewer}}}
				
				
				<!-- <div id="detailAnnotations"></div> -->
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4", "primaryOnly" => $this->getVar('representationViewerPrimaryOnly') ? 1 : 0)); ?>
				
				<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled | $vn_pdf_enabled) {
						
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
				?>				
						<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a></div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
				<?php				
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					if ($vn_pdf_enabled) {
						print "<div class='detailTool'><span class='glyphicon glyphicon-file'></span>".caDetailLink($this->request, "Download as PDF", "faDownload", "ca_objects",  $vn_id, array('view' => 'pdf', 'export_format' => '_pdf_ca_objects_summary'))."</div>";
					}
					print '</div><!-- end detailTools -->';
				}				

				?>

			</div>
			<!-- end object image -->
		</div><!-- end row -->
	</div><!-- end container -->
	<!-- </div> -->
	<!-- end col -->

	<!-- @theme aqui se incluye la tabla de metadatos -->
	<?php 
		include 'ca_objects_metadata_table.php';
	?>
	
	<!-- TODO: biblio sacar este navbar right -->
	<!-- <div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div> -->
		<!-- end detailNavBgLeft -->
	<!-- </div> -->
	<!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>