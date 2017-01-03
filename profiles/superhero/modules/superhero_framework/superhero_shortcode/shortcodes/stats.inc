<?php

function _stats_shortcode_info(&$shortcodes) {
  $shortcodes['stats'] = array(
      'title' => t('Stats'),
      'description' => t('Js Stats shortcode'),
      'process callback' => '_stats',
      'tips callback' => '_stats_tips',
  );
}

function _stats($attrs, $text) {
  $attrs = shortcode_attrs(array(
      'class' => '',
      'icon' => '',
      'timer' => '',
      'number' => ''), $attrs);
  $attrs['content'] = $text;
  return trim(theme('_stats', $attrs));
}

function _stats_theme(&$themes) {
  $path = drupal_get_path('module', 'superhero_shortcode');
  $themes['_stats'] = array(
      'template' => 'stats',
      'path' => $path . '/theme',
      'pattern' => 'shortcode__',
      'preprocess functions' => array(
          'template_preprocess',
          '_preprocess_shortcode_stats',
      ),
      'variables' => array(
          'class' => '',
          'icon' => '',
          'timer' => '',
          'number' => '',
          'content' => '',
      )
  );
}

function _preprocess_shortcode_stats(&$vars) {
  $vars['stats_id'] = drupal_html_id("sp_stats");
  $vars['theme_hook_suggestions'][] = 'shortcode__stats';
}

function _stats_tips($format,$long) {
  $output = "[stats number='' icon='' class='']Title[/stats]";
  return $output;
}
