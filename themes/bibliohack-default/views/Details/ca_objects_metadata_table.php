<div class="metadata-grid col-xs-12 col-sm-10 col-md-10 col-lg-10">
    {{{<ifcount code="ca_objects_x_entities" min="1" max="1">
        <div><?php print _t("Artist"); ?></div>
        <div>
            <unit 
                relativeTo="ca_objects_x_entities" 
                restrictToRelationshipTypes="author, creator, artist" 
                length="1" delimiter=" ">
                <unit relativeTo="ca_entities">
                <l>^ca_entities.preferred_labels</l>
                <ifdef code="ca_entities.entity_dates_display">
                    <span class="clarification">
                        ^ca_entities.entity_places_display, ^ca_entities.entity_dates_display
                    </span>
                </ifdef>
                </unit>
            </unit>
        </div>
     </ifcount>}}}
    {{{<ifcount code="ca_objects_x_entities" 
            restrictToRelationshipTypes="author, creator, artist, contributor" 
            min="2">
        <div><?php print _t("Artists"); ?></div>
        <div>
            <unit relativeTo="ca_objects_x_entities" 
                  delimiter=", ">
                <unit relativeTo="ca_entities">
                    <l>^ca_entities.preferred_labels</l>
                    <ifdef code="ca_entities.entity_dates_display">
                        <span class="clarification">
                            ^ca_entities.entity_dates_display
                        </span>
                    </ifdef>
                </unit>
            </unit>
        </div>
    </ifcount>}}}
    {{{<ifdef code="ca_objects.preferred_labels.name">
        <div><?php print _t("Title"); ?></div>
        <div><i>^ca_objects.preferred_labels</i></div>
    </ifdef>}}}
    {{{<ifdef code="ca_objects.nonpreferred_labels">
        <div><?php print _t("Other titles"); ?></div>
        <div>
            <unit delimiter=" ">
                <i>^ca_objects.nonpreferred_labels.name</i> 
                <!-- <span class="clarification">^ca_objects.nonpreferred_labels.type_id</span> -->
            </unit>
        </div>
    </ifdef>}}}
    {{{<ifcount code="ca_objects_x_objects" 
				restrictToRelationshipTypes="partof" 
				min="1">
        <unit relativeTo="ca_objects_x_objects" delimiter=" " checkAccess="null">
            <unit relativeTo="ca_objects" delimiter=" ">
                <div>
                    <if rule="^ca_objects.work_type =~ /serie/">
                        <?php print _t("Serie") ?>
                    </if>
                    <if rule="^ca_objects.work_type =~ /portfolio/">
                        <?php print _t("Portfolio") ?>
                    </if>
                </div>
                <div>^ca_objects.preferred_labels</div>
            </unit>
        </unit>
    </ifcount>}}}

    <?php
        if(is_array($object_related_items)){
            foreach($object_related_items as $oritem){
                if(preg_match("/serie/i", $oritem['work_type'])){
                    print "<tr><td>"."Serie"."</td>";
                    print "<td>".$oritem['label']."</td></tr>";
                }
                if( preg_match("/portfolio/i", $oritem['work_type']) ){
                    print "<tr><td>"."Portfolio"."</td>";
                    print "<td>".$oritem['label']."</td></tr>";
                }
            }
        }
    ?>
    <?php	if( is_array($dates) && array_key_exists('creation', $dates) ): ?>
        <div><?php print _t("Creation date"); ?></div>
        <div><?php print $dates['creation']['value']; ?></div>
    <?php else: ?>
    {{{<ifdef code="ca_objects.object_dates_display">
        <div><?php print _t("Creation date"); ?></div>
        <div><i>^ca_objects.object_dates_display</i></div>
    </ifdef>}}}
    <?php endif; ?>

    {{{<ifcount code="ca_objects.object_dates" min="2">
        <div><?php print _t("Other dates"); ?></div>
        <div>
            <unit delimiter=", " skipWhen="^ca_objects.object_dates.object_dates_type =~ /creación/">
                ^ca_objects.object_dates.object_dates_value 
                <span class="clarification">
                    ^ca_objects.object_dates.object_dates_type
                </span>
            </unit>
        </div>
    </ifcount>}}}
    {{{<ifdef code="ca_objects.dimensions_display">
        <div><?php print _t("Dimensions"); ?></div>
        <div>^ca_objects.dimensions_display</div>
    </ifdef>}}}				
    {{{<ifdef code="ca_objects.materialstech_display">
        <div><?php print _t("Technique"); ?></div>
        <div>^ca_objects.materialstech_display</div>
    </ifdef>}}}						
    {{{<ifdef code="ca_objects.components_display">
        <div><?php print _t("Components"); ?></div>
        <div>^ca_objects.components_display</div>
    </ifdef>}}}
    {{{<ifdef code="ca_objects.inscriptions_display">
        <div><?php print _t("Inscriptions"); ?></div>
        <div>^ca_objects.inscriptions_display</div>
    </ifdef>}}}
    {{{<ifdef code="ca_places">
        <div><?php print _t("Places"); ?></div>
        <div>^ca_places</div>
    </ifdef>}}}
    {{{<ifdef code="ca_objects.edition_display">
        <div><?php print _t("Edition"); ?></div>
        <div>^ca_objects.edition_display</div>
    </ifdef>}}}

    {{{<ifdef code="ca_objects.state_display">
        <div><?php print _t("State"); ?></div>
        <div>^ca_objects.state_display</div>
    </ifdef>}}}
    {{{<ifdef code="ca_objects.provenance_display">
        <div><?php print _t("Provenance"); ?></div>
        <div>^ca_objects.provenance_display</div>
    </ifdef>}}}

    {{{<ifdef code="ca_occurrences.entry_date">
        <div><?php print _t("Entry date"); ?></div>
        <div>^ca_occurrences.entry_date</div>
    </ifdef>}}}
    <?php if(!empty($acquisition)): ?>
        <div><?php print _t("Acquisition"); ?></div>
        <div><?php print $acquisition; ?></div>
    <?php endif; ?>

    {{{<ifdef code="ca_objects.idno">
        <div><?php print _t("ID"); ?></div>
        <div>^ca_objects.idno</div>
    </ifdef>}}}
    {{{<ifdef code="ca_objects.description">
        <div><?php print _t("Description"); ?></div>
        <div>
            <span class="trimText">^ca_objects.description</span>
        </div>
    </ifdef>}}}
    {{{<ifcount code="ca_objects_x_occurrences" restrictToTypes="exhibition" min="1">
        <div>
            <td colspan="2">
                <b><?php print _("Exhibitions"); ?></b>
            </td>
        </div>	
        <div>
            <ifcount code="ca_objects_x_occurrences" 
                        restrictToTypes="exhibition" 
                        min="1" max="1">
            <div><?php print _t("Exhibition"); ?>:</div>
            </ifcount>
            <ifcount code="ca_objects_x_occurrences" 
                        restrictToTypes="exhibition" 
                        min="2">
            <div><?php print _t("Exhibitions"); ?>:</div>
            </ifcount>
            <div>
            <unit relativeTo="ca_objects_x_occurrences" 
                    restrictToTypes="exhibition" delimiter="<br>">
                <unit relativeTo="ca_occurrences" delimiter=" ">
                    <l>^ca_occurrences.preferred_labels</l>
                </unit>
            </unit>
            </div>
    </div>
    </ifcount>}}} 
</div>