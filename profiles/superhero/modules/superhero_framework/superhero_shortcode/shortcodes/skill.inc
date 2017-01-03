<?php

function _skill_shortcode_info(&$shortcodes) {
  $shortcodes['skill'] = array(
      'title' => t('Skill bar'),
      'description' => t('Create Skill Process'),
      'process callback' => '_skill',
      'tips callback' => '_skill_tips',
  );
}

function _skill($attrs, $text) {
  $attrs = shortcode_attrs(array(
      'percent' => '',
	  'title' => ''
   ), $attrs);
  return theme('_skill',$attrs);
}

function _skill_theme(&$themes) {
  $path = drupal_get_path('module', 'superhero_shortcode');
  $themes['_skill'] = array(
      'template' => 'skill',
      'path' => $path . '/theme',
      'pattern' => 'shortcode__',
      'preprocess functions' => array(
          'template_preprocess',
          '_preprocess_shortcode_skill',
      ),
      'variables' => array(
          'percent' => '',
		  'title' => ''
      )
  );
}

function _preprocess_shortcode_skill(&$vars) {
  $vars['element_id'] = drupal_html_id('skill_bar');
  $vars['theme_hook_suggestions'][] = 'shortcode__skill';
}

function _skill_tips($format, $long) {
  $output = "[skill percent='' title=''][/skill]";
  return $output;
}