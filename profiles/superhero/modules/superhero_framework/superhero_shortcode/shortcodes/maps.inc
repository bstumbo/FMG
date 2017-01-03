<?php

function _maps_shortcode_info(&$shortcodes) {
  $shortcodes['maps'] = array(
      'title' => t('Maps'),
      'description' => t('Create maps shortcode'),
      'process callback' => '_maps',
      'tips callback' => '_maps_tips',
  );
    $shortcodes['marker'] = array(
        'title' => t('Map Marker'),
        'description' => t('Create map marker shortcode'),
        'process callback' => '_maps_marker',
    );
}

function _maps($attrs, $text) {
  drupal_add_js('http://maps.google.com/maps/api/js?sensor=false');
	drupal_add_js(drupal_get_path('module','superhero_shortcode').'/js/gmap.js');
	drupal_add_css(drupal_get_path('module','superhero_shortcode').'/css/gmap.css');
  $attrs = shortcode_attrs(array(
        'class' => '',
        'height' => '400px',
        'zoom' => '14'), $attrs);
    $attrs['content'] = $text;
    return trim(theme('_maps', $attrs));
}

function _maps_marker($attrs, $text){
    $attrs = shortcode_attrs(array(
        'link' => '',
        'title' => '',
        'image' => '',
        'phone' => '',
        'latitude' => '',
        'longitude' => ''), $attrs);
    $attrs['content'] = $text;
    return "<div class=\"superhero-gmap-marker\" data-link=\"{$attrs['link']}\" data-title=\"{$attrs['title']}\" data-image=\"{$attrs['image']}\" data-phone=\"{$attrs['phone']}\" data-latitude=\"{$attrs['latitude']}\" data-longitude=\"{$attrs['longitude']}\">{$text}</div>";
}

function _maps_theme(&$themes) {
  $path = drupal_get_path('module', 'superhero_shortcode');
    $themes['_maps'] = array(
        'template' => 'maps',
        'path' => $path . '/theme',
        'preprocess functions' => array(
            'template_preprocess',
            'superheor_shortcode_preprocess_shortcode_maps',
        ),
        'variables' => array(
            'class' => '',
            'zoom' => '14',
            'height' => '400px',
            'content' => '',
        )
    );
}

function superheor_shortcode_preprocess_shortcode_maps(&$vars) {
  $vars['attributes_array']['id'] = drupal_html_id('superhero_gmap_shortcode');
	$vars['attributes_array']['class'][] = drupal_html_class('superhero_gmap_shortcode');
	$vars['attributes_array']['style'] = "height:{$vars['height']}";
	$vars['attributes_array']['data-zoom'] = $vars['zoom'];
}

function _maps_tips($format,$long) {
  $output = "[maps class='' type='' link='' title='' image='' phone='' zoom='']ADDRESS[/maps]";
  return $output;
}
