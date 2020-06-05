<?php
	$t_item = $this->getVar("item");
	$va_comments = $this->getVar("comments");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");	
	
	$vn_previous_id = $this->getVar("previousID");
	$vn_next_id = $this->getVar("nextID");
	
	$vs_status = $t_item->get("ca_occurrences.status", array("convertCodesToDisplayText" => true));
	$va_access_values = caGetUserAccessValues();
	
	$vs_placeholder = $this->request->config->get("site_host").caGetThemeGraphicUrl("placeholder.png");
	$vs_placeholder_tag = '<img nopin="nopin"  src="'.$vs_placeholder.'"  alt="Image Not Available" />';

?>
    <main id="main" role="main" class="ca bibliography bibliography_detail nomargin">

        <section class="wrap block block-top">


<?php
 			# --- not sure what the back nav would be here since there is no exhibitions browse
 			if($x && $vs_back = ResultContext::getResultsLinkForLastFind($this->request, 'ca_occurrences', '< Back to Results', 'eyebrow', array())){
?>           
            <div class="text-gray block-quarter back">
<?php
				print $vs_back;
?>
            </div>
<?php
 			}
 			
 			#if($vs_reps = $t_item->getWithTemplate("<unit relativeTo='ca_objects' restrictToRelationshipTypes='describes,depicts'>^ca_object_representations.representation_id</unit>", array("checkAccess" => $va_access_values))){
 				#$va_rep_ids = explode(";", $vs_reps);
 				#if(is_array($va_rep_ids) && sizeof($va_rep_ids)){
 			if($va_object_ids = $t_item->get("ca_objects.object_id", array("returnAsArray" => true,"restrictToRelationshipTypes" => array("describes","depicts"), "checkAccess" => $va_access_values))){
 				$va_media = array();
 				$va_thumbs = array();
 				$va_titles = array();
 				foreach($va_object_ids as $vn_object_id){
 					$t_object = new ca_objects($vn_object_id);
 					if($t_rep = $t_object->getPrimaryRepresentationInstance(array("checkAccess" => $va_access_values))){
						if(!$t_rep_for_meta_tags){
 							$t_rep_for_meta_tags = $t_rep;
 						}
						$vs_mimetype = $t_rep->getMediaInfo('media', 'original', 'MIMETYPE');
						# --- only show images here, not pdf viewer.  link pdf's to archival detail page
						$vs_media = $t_object->get("ca_object_representations.media.page", array("checkAccess" => $va_access_values));
						if($vs_mimetype = "application/pdf"){
							# --- link pdf's to archival detail page
							$vs_media = caDetailLink($vs_media, '', 'ca_objects', $vn_object_id);
						}
						$va_media[] = $vs_media;
						$va_thumbs[] = $t_rep->get("ca_object_representations.media.icon.url");
						$va_titles[] = str_replace(array("'", "\""), array("", ""), $t_object->get("ca_objects.preferred_labels.name"));
					}					
 				}
 				if(sizeof($va_media)){
?>  

            <div class="ca-object-viewer">

                <div class="module_slideshow is-finite slideshow-main no_dots" data-thumbnails="slideshow-thumbnails">
                    <div class="slick-slider slider-main">
<?php
						foreach($va_media as $vs_media){
?>
							<div class="slick-slide">
								<div class="img-container">
									<div class="img-wrapper contain"><?php print $vs_media; ?></div>
								</div>
							</div>
<?php
						}
?>
                    </div>
                </div>
<?php
					if(is_array($va_thumbs) && (sizeof($va_thumbs) > 1)){
?>
					<ul class="slideshow-thumbnails" data-as-nav="slider-main" data-is-nav="true">
<?php
						foreach($va_thumbs as $vn_i => $vs_thumb_url){
							print '<li><a href="#" data-index="'.$vn_i.'" '.(($vn_i == 0) ? 'class="selected"' : '').'><img src="'.$vs_thumb_url.'" alt="'.$va_titles[$vn_i].'"></a></li>';
						}
?>
					</ul>
<?php
					}else{
?>
						<div class="block-half"><br/></div>
<?php						
					}
?>
            </div>
<?php
				}
			}
?>

            <div class="wrap-max-content text-align-center">

                <div class="block">
<?php
		switch(strToLower($vs_status)){
			case "published":
			case "research suspended":
?>
            <div class="wrap-max-content text-align-center">

                <div class="block">

                   <div class="block-quarter">
                        <h2 class="subheadline-l">{{{^ca_occurrences.preferred_labels.name}}}</h2>
                    </div>
                    {{{<ifdef code="ca_occurrences.date.display_date">
						<div class="block-quarter">
							<div class="subheadline text-gray">^ca_occurrences.date.display_date</div>
						</div>
					</ifdef>}}}
                    {{{<ifnotdef code="ca_occurrences.date.display_date"><ifdef code="ca_occurrences.date.parsed_date">
						<div class="block-quarter">
							<div class="subheadline text-gray">^ca_occurrences.date.parsed_date</div>
						</div>
                    </ifdef></ifnotdef>}}}
                    {{{<ifcount min="1" code="ca_entities" restrictToRelationshipTypes="primary_venue">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Primary Venue</div>
							<div class="ca-data"><unit relativeTo="ca_entities" restrictToRelationshipTypes="primary_venue" delimeter="<br/>">^ca_entities.preferred_labels.displayname</unit></div>
						</div>
					</ifcount>}}}
					{{{<ifdef code="ca_occurrences.idno">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Identifier</div>
							<div class="ca-data">^ca_occurrences.idno</div>
						</div>
					</ifdef>}}}
					{{{<ifdef code="ca_occurrences.exhibition_comments">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Comments</div>
							<div class="ca-data">^ca_occurrences.exhibition_comments</div>
						</div>
					</ifdef>}}}
					{{{<ifdef code="ca_occurrences.published_on">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Published On</div>
							<div class="ca-data">^ca_occurrences.published_on</div>
						</div>
                    </ifdef>}}}
                    {{{<ifdef code="ca_occurrences.suspended">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Research Suspended On</div>
							<div class="ca-data">^ca_occurrences.suspended</div>
						</div>
                    </ifdef>}}}
                    {{{<ifdef code="ca_occurrences.last_updated_on">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Last Updated On</div>
							<div class="ca-data">^ca_occurrences.last_updated_on</div>
						</div>
                    </ifdef>}}}
				</div>
{{{<ifcount code="ca_occurrences.related" min="1">
                <div class="module_accordion">
                    <div class="items">

		<ifcount code="ca_occurrences.related" min="1" restrictToTypes="exhibition">
                        <div class="item">
                            <div class="trigger small">Related Exhibitions</div>            
                            <div class="details">
                                <div class="inner">
                                    <ul class="ca-data text-align-left related">
                                        <unit relativeTo="ca_occurrences.related" restrictToTypes="exhibition" delimiter=" ">
											<li>
												<l><i>^ca_occurrences.preferred_labels.name</i>, <unit relativeTo='ca_entities' restrictToRelationshipTypes='primary_venue'>^ca_entities.preferred_labels.displayname</unit>, ^ca_occurrences.date.display_date</l>
											</li>
                                        </unit>
                                    </ul>
                                </div>
                            </div>
                        </div>
		</ifcount>
		<ifcount code="ca_occurrences.related" min="1" restrictToTypes="bibliography">
                        <div class="item">
                            <div class="trigger small">Related Bibliography</div>            
                            <div class="details">
                                <div class="inner">
                                    <ul class="ca-data text-align-left related">
                                        <unit relativeTo="ca_occurrences.related" restrictToTypes="bibliography" delimiter=" " sort="ca_occurrences.bib_year_published">
											<li>
												<l>^ca_occurrences.preferred_labels.name</l>
											</li>
                                        </unit>
                                    </ul>
                                </div>
                            </div>
                        </div>
		</ifcount>

                    </div>
                </div>
</ifcount>}}}


            </div>
        </section>
<?php
	if($vn_previous_id || $vn_next_id){
?>
		<section class="widget-pagination block-top">
			<div class="layout-2">
				<div class="col">
<?php
					if($vn_previous_id){
						print caDetailLink('&lt; PREVIOUS', 'text-dark eyebrow previous', 'ca_objects', $vn_previous_id);
					}
?>
				</div>
				<div class="col">
<?php
			
					if($vn_next_id){
						print caDetailLink('NEXT &gt;', 'text-dark eyebrow next', 'ca_objects', $vn_next_id);
					}
?>					
				</div>
		</section>
<?php
	}
?>
{{{<ifcount code="ca_objects" restrictToRelationshipTypes="part" restrictToTypes="artwork,cast,chronology_image,edition,element,group,reproduction,study,version" min="1">
        <section class="wrap block border">
            <div class="block text-align-center">
                <h4 class="subheadline-bold">Checklist of Artworks</h4>
            </div>
            <div class="module_slideshow is-finite manual-init slideshow-related">
                <div class="slick-slider">
					<unit relativeTo="ca_objects" restrictToRelationshipTypes="part" restrictToTypes="artwork,cast,chronology_image,edition,element,group,reproduction,study,version" delimiter=" " sort="ca_objects.idno_sort">
						<div class="slick-slide">
							<div class="item">
								<l>
									<div class="img-wrapper archive_thumb block-quarter">
										<ifdef code="ca_object_representations.media.medium.url"><img nopin="nopin"  src="^ca_object_representations.media.medium.url" alt="^ca_objects.preferred_labels.name"/></ifdef>
										<ifnotdef code="ca_object_representations.media.medium.url"><?php print $vs_placeholder_tag; ?></ifnotdef>
									</div>
									<div class="text block-quarter">
										<div class="ca-identifier text-gray">^ca_objects.idno</div>
										<div class="more">                                
											<div class="thumb-text clamp" data-lines="2">^ca_objects.preferred_labels.name</div>
											<ifdef code="ca_objects.date.display_date"><div class="ca-identifier text-gray">^ca_objects.date.display_date%delimiter=,_</div></ifdef>
											<ifnotdef code="ca_objects.date.display_date"><ifdef code="ca_objects.date.parsed_date"><div class="ca-identifier text-gray">^ca_objects.date.parsed_date%delimiter=,_</div></ifdef></ifnotdef>
										</div>
									</div>
								</l>
							</div>
						</div>
					</unit>
				</div>
			</div>
        </section>
</ifcount>}}}
<?php

			break;
			# ----------------------------------------------------
			case "research pending":
			default:
?>
            <div class="wrap-max-content text-align-center">

                <div class="block">

                   <div class="block-quarter">
                        <h2 class="subheadline-l">{{{^ca_occurrences.preferred_labels.name}}}</h2>
                    </div>
                    {{{<ifdef code="ca_occurrences.date.display_date">
						<div class="block-quarter">
							<div class="subheadline text-gray">^ca_occurrences.date.display_date</div>
						</div>
					</ifdef>}}}
                    {{{<ifnotdef code="ca_occurrences.date.display_date"><ifdef code="ca_objects.date.parsed_date">
						<div class="block-quarter">
							<div class="subheadline text-gray">^ca_occurrences.date.parsed_date</div>
						</div>
                    </ifdef></ifnotdef>}}}
                    {{{<ifcount min="1" code="ca_entities" restrictToRelationshipTypes="primary_venue">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Primary Venue</div>
							<div class="ca-data"><unit relativeTo="ca_entities" restrictToRelationshipTypes="primary_venue" delimeter="<br/>">^ca_entities.preferred_labels.displayname</unit></div>
						</div>
					</ifcount>}}}
					{{{<ifdef code="ca_occurrences.idno">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Identifier</div>
							<div class="ca-data">^ca_occurrences.idno</div>
						</div>
					</ifdef>}}}
                    {{{<ifdef code="ca_occurrences.status">
						<div class="block-quarter">
							<div class="eyebrow text-gray">Status</div>
							<div class="ca-data">^ca_occurrences.status</div>
						</div>
					</ifdef>}}}
				</div>
			</div>
		</section>
<?php
	if($vn_previous_id || $vn_next_id){
?>
	<div class="wrap">
		<section class="widget-pagination block-top">
			<div class="layout-2">
				<div class="col">
<?php
					if($vn_previous_id){
						print caDetailLink('&lt; PREVIOUS', 'text-dark eyebrow previous', 'ca_objects', $vn_previous_id);
					}
?>
				</div>
				<div class="col">
<?php
			
					if($vn_next_id){
						print caDetailLink('NEXT &gt;', 'text-dark eyebrow next', 'ca_objects', $vn_next_id);
					}
?>					
				</div>
		</section>
	</div>
<?php
	}

			break;
			# ----------------------------------------------------
		}
?>
    </main>
<?php
	# --- meta tags
	MetaTagManager::addMeta("twitter:title", str_replace('"', '', $t_item->get("ca_occurrences.preferred_labels.name")));
	MetaTagManager::addMetaProperty("og:title", str_replace('"', '', $t_item->get("ca_occurrences.preferred_labels.name")));
	MetaTagManager::addMetaProperty("og:url", $this->request->config->get("site_host").caNavUrl("*", "*", "*"));
	if($t_rep_for_meta_tags){
		MetaTagManager::addMetaProperty("og:image", $t_rep_for_meta_tags->get("ca_object_representations.media.large.url"));
		MetaTagManager::addMetaProperty("og:image:secure_url", $t_rep_for_meta_tags->get("ca_object_representations.media.large.url"));
		MetaTagManager::addMeta("twitter:image", $t_rep_for_meta_tags->get("ca_object_representations.media.large.url"));
		$va_media_info = $t_rep_for_meta_tags->getMediaInfo('media', 'large');
		MetaTagManager::addMetaProperty("og:image:width", $va_media_info["WIDTH"]);
		MetaTagManager::addMetaProperty("og:image:height", $va_media_info["HEIGHT"]);
	}	
?>
