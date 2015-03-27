<?php

/**
 * @file
 * Bootstrap agency template.php.
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function bootstrap_agency_preprocess_page(&$variables) {
  if (($key = array_search('container', $variables['navbar_classes_array'])) !== FALSE) {
    unset($variables['navbar_classes_array'][$key]);
  }
  $variables['navbar_classes_array'][] = 'container-fluid';
}

/**
 * Implements hook_preprocess_html().
 *
 * @see html.tpl.php
 */
function bootstrap_agency_preprocess_html(&$variables) {
  // Make the scroll spy work.
  if (($key = array_search('navbar-is-fixed-top', $variables['classes_array'])) !== FALSE) {
    unset($variables['classes_array'][$key]);
  }
  $variables['attributes_array']['data-target'] = '.navbar-collapse';
  $variables['attributes_array']['data-spy'] = 'scroll';
  $variables['attributes_array']['id'] = 'page-top';
}

/**
 * Implements hook_preprocess_block().
 *
 * @see block.tpl.php
 */
function bootstrap_agency_preprocess_block(&$variables) {
  $block = $variables['block'];

  // Create css id attribute based on the block's administrative name.
  if ($block->module == 'block') {
    $custom = block_custom_block_get($block->delta);

    $variables['block_html_id'] = drupal_html_id($custom['info']);
  }
}

/**
 * Implements hook_js_alter().
 */
function bootstrap_agency_js_alter(&$js) {
  // This code is only necessary because of [#2162165]
  // Always add bootstrap.js last.
  unset($js[drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.js']);
  $theme_path = drupal_get_path('theme', 'bootstrap_agency');
  $bootstrap = $theme_path . '/js/bootstrap.js';
  $js[$bootstrap] = drupal_js_defaults($bootstrap);
  $js[$bootstrap]['group'] = JS_THEME;
  $js[$bootstrap]['scope'] = 'footer';
}

/**
 * Implements theme_textarea().
 */
function bootstrap_agency_textarea($element) {
  // Drupal likes resizable text areas, we don't.
  $element['element']['#resizable'] = FALSE;
  return theme_textarea($element);
}
