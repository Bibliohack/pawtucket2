<?php
	MetaTagManager::setWindowTitle($this->request->config->get("app_display_name").": About the Gallery");
?>
<div class="row contentbody_sub aboutPages">
	<div class="col-sm-8">
		<H1>About Susan Eley Fine Art</H1>
		<p>
			Susan Eley Fine Art was founded in the spring of 2006 by Susan Eisner Eley as a salon-style gallery. Situated in an Upper West Side townhouse in Manhattan, the Gallery offers an intimate viewing experience, contrary to the more formal presentations of art in typical white box galleries. Eley opened the Gallery to attract a new, untapped audience for contemporary art and to provide regular gallerygoers with a fresh, alternative way to enjoy art.
		</p>
		<p>
			The Gallery focuses on contemporary art by emerging and mid-career artists, who work in a range of media, from paint to photography to sculpture and print. Solo and group exhibitions showcase abstract and figurative work from a diverse body of artists from the US, Asia, Latin America and Europe. Gallery artists are dynamic, active professionals, who produce strong bodies of work that constantly shift and evolve.
		</p>
		<p>
			In addition to the exhibition program, the Gallery regularly hosts collector talks, political fundraisers, <a href="http://www.vicamillersalons.com/" target="_blank">literary and poetry salons</a> and panel discussions on a variety of cultural and political topics. The Gallery has participated in art fairs in Miami, Houston, San Francisco, New York City and Saratoga Springs, and abroad in Toronto. SEFA has a strong online presence through platforms such as <a href="https://artsy.net/susan-eley-fine-art" target="_blank">artsy.net</a> and <a href="https://www.1stdibs.com/dealers/susan-eley-fine-art/?utm_source=susaneleyfineart.com&utm_medium=referral&utm_campaign=dealer" target="_blank">1stdibs.com</a>.
		</p>
		<br/><br/>
		<H1>Director Bio</H1>
		<p>
			Before establishing the Gallery, Eley was an editor and writer for national and regional publications featuring articles on fine art, dance and travel. (<a href="http://www.huffingtonpost.com/susan-eley" target="_blank">Author archive</a>) Eley worked in public relations and education at the Morgan Library & Museum, NY, the Mayor's Art Commission of the City of New York and interned at the Peggy Guggenheim Collection in Venice, Italy. She is also a former professional ballet dancer with the Feld Ballet, NY. Eley has a BA in Art History from Brown University and an MA in Visual Arts Administration from NYU.
		</p>
		<br/><br/>
		<H1>Accessibility Statement</H1>
		<p>
			Susan Eley Fine Art is committed to ensuring digital accessibility for individuals with disabilities. We are continually working on our website to improve the user experience for everyone, and applying the relevant accessibility standards. For additional assistance or any accessibility concerns, please contact us at 917.952.7641 or email: <a href="mailto:susie@susaneleyfineart.com">susie@susaneleyfineart.com</a>.
		</p>
		
		<div class="row" style="margin-top:50px;">
			<div class="col-xs-4 fullWidthImg" style="padding-top:30px;">
				<a href="https://www.arttable.org/" target="_blank"><?php print caGetThemeGraphic($this->request, 'arttable-logo.png', array('alt' => 'Art Table')); ?></a>
			</div>
			<div class="col-xs-4 fullWidthImg" style="padding-top:30px;">
				<a href="http://womenartdealers.org/" target="_blank"><?php print caGetThemeGraphic($this->request, 'awad-logo.jpg', array('alt' => 'Association of Women Art Dealers')); ?></a>
			</div>
			<div class="col-xs-4 fullWidthImg" style="padding-top:30px;">
				<a href="https://www.artmoney.com/us" target="_blank"><?php print caGetThemeGraphic($this->request, 'art-money-logo.png', array('alt' => 'Art Money')); ?></a>
				<br/><small>10 Payments. 10 Months. No Interest.</small>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-md-3 col-md-offset-1">
	 	<div class="thumbnail">
	 		<?php print caGetThemeGraphic($this->request, 'about_building.jpg', array('alt' => 'Exterior of Susan Eley Fine Art NYC')); ?>
	 		<small>NYC</small>
	 	</div>
	 	<div class="thumbnail">
	 		<?php print caGetThemeGraphic($this->request, 'about_hudson.jpg', array('alt' => 'Exterior of Susan Eley Fine Art Hudson NY')); ?>
	 		<small>Hudson, NY</small>
	 	</div>
	</div>
</div><!-- end row -->