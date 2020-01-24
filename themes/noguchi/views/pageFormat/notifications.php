<?php
/* ----------------------------------------------------------------------
 * views/pageFormat/notifications.php : 
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
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
 
	if (sizeof($this->getVar('notifications'))) {
		foreach($this->getVar('notifications') as $va_notification) {
?>
			<div class="notificationMessage block text-align-center alert text" role="alert">
				<a href="#" onclick="jQuery('.notificationMessage').hide(); return false;" class="alertClose">x</a>
<?php
				switch($va_notification['type']) {
					case __NOTIFICATION_TYPE_ERROR__:
						print $va_notification['message'];
						break;
					case __NOTIFICATION_TYPE_WARNING__:
						print $va_notification['message'];
						break;
					default:
						print $va_notification['message'];
						if(strpos($va_notification['message'], 'registering') !== false){
							# --- registration message - add google analytics code
							Session::setVar('triggerRegistrationGA', 'RegistrationGA');
						}
						break;
				}
?>
			</div>
<?php
		}
	}
?>