<div class="grid-container col-xs-12 col-sm-10 col-md-10 col-lg-10">
    <div class="metadata-grid">
        <!-- A cada div que contenga un item de la tabla de metadatos (artista, fechas, ID, etc) se le debe asignar la clase de css "metadata-item" -->
        <!-- A cada primer item dentro de cada fila (Título, Artistas, etc.) se lo debe poner dentro de un <p> -->
        <!-- Para agregar estilos de itálica, negrita, subrayado, etc., usar las clases de css del archivo _helpers.scss -->
        {{{<ifcount code="ca_objects_x_entities" min="1" max="1">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Artist"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
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
                </p>
            </div>
        </ifcount>}}}
        
        {{{<ifcount code="ca_objects_x_entities" 
                restrictToRelationshipTypes="author, creator, artist, contributor" 
                min="2">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Artists"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
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
                </p>   
            </div>
        </ifcount>}}}

        {{{<ifdef code="ca_objects.preferred_labels.name">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Title"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content italic">
                    ^ca_objects.preferred_labels
                </p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.nonpreferred_labels">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Other titles"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
                    <unit delimiter=" ">
                        <i>^ca_objects.nonpreferred_labels.name</i> 
                        <!-- <span class="clarification">^ca_objects.nonpreferred_labels.type_id</span> -->
                    </unit>
                </p>
            </div>
        </ifdef>}}}

        {{{<ifcount code="ca_objects_x_objects" 
                    restrictToRelationshipTypes="partof" 
                    min="1">
            <unit relativeTo="ca_objects_x_objects" delimiter=" " checkAccess="null">
                <unit relativeTo="ca_objects" delimiter=" ">
                    <div class="metadata-item">
                        <if rule="^ca_objects.work_type =~ /serie/">
                            <p class="metadata-item-title"><?php print _t("Serie") ?></p>
                        </if>
                        <if rule="^ca_objects.work_type =~ /portfolio/">
                            <p class="metadata-item-title"><?php print _t("Portfolio") ?></p>
                        </if>
                    </div>
                    <div class="metadata-item">
                    <p class="metadata-item-content">^ca_objects.preferred_labels</p>
                    </div>
                </unit>
            </unit>
        </ifcount>}}}

        <!-- TODO: revisar qué hace el siguiente bloque -->
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
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Creation date"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
                    <?php print $dates['creation']['value']; ?>
                </p>
            </div>
        <?php else: ?>
        {{{<ifdef code="ca_objects.object_dates_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Creation date"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content italic">^ca_objects.object_dates_display</p>
            </div>
        </ifdef>}}}
        <?php endif; ?>

        {{{<ifcount code="ca_objects.object_dates" min="2">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Other dates"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
                    <unit delimiter=", " skipWhen="^ca_objects.object_dates.object_dates_type =~ /creación/">
                        ^ca_objects.object_dates.object_dates_value 
                        <span class="clarification">
                            ^ca_objects.object_dates.object_dates_type
                        </span>
                    </unit>
                </p>
            </div>
        </ifcount>}}}

        {{{<ifdef code="ca_objects.dimensions_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Dimensions"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.dimensions_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.materialstech_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Technique"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.materialstech_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.components_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Components"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.components_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.inscriptions_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Inscriptions"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.inscriptions_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_places">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Places"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_places</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.edition_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Edition"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.edition_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.state_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("State"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.state_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.provenance_display">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Provenance"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.provenance_display</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_occurrences.entry_date">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Entry date"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_occurrences.entry_date</p>
            </div>
        </ifdef>}}}

        <?php if(!empty($acquisition)): ?>
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Acquisition"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
                    <?php print $acquisition; ?>
                </p>
            </div>
        <?php endif; ?>

        {{{<ifdef code="ca_objects.idno">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("ID"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">^ca_objects.idno</p>
            </div>
        </ifdef>}}}

        {{{<ifdef code="ca_objects.description">
            <div class="metadata-item">
                <p class="metadata-item-title">
                    <?php print _t("Description"); ?>
                </p>
            </div>
            <div class="metadata-item">
                <p class="metadata-item-content">
                    <span class="trimText">^ca_objects.description</span>
                </p>
            </div>
        </ifdef>}}}

        <!-- TODO: revisar qué hace el siguiente bloque -->
        {{{<ifcount code="ca_objects_x_occurrences" restrictToTypes="exhibition" min="1">
            <div class="metadata-item">
                <p class="metadata-item-title"><b><?php print _("Exhibitions"); ?></b></p>
            </div>	
            <div class="metadata-item">
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
</div>