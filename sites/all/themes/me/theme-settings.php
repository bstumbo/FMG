<?php
require_once dirname(__FILE__) . '/inc/theme-settings-header.inc';
function me_form_system_theme_settings_alter(&$form,&$form_state,$form_id = NULL) {
	me_theme_settings_header($form,$form_state);
}