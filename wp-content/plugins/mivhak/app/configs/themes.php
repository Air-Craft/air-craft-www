<?php

/**
 * List of all ace editor themes
 */
$themes = array(
    'ambiance',
    'chaos',
    'chrome',
    'clouds',
    'clouds_midnight',
    'cobalt',
    'crimson_editor',
    'dawn',
    'dreamweaver',
    'eclipse',
    'github',
    'idle_fingers',
    'katzenmilch',
    'kr_theme',
    'kuroir',
    'merbivore',
    'merbivore_soft',
    'mono_industrial',
    'monokai',
    'pastel_on_dark',
    'solarized_dark',
    'solarized_light',
    'terminal',
    'textmate',
    'tomorrow',
    'tomorrow_night',
    'tomorrow_night_blue',
    'tomorrow_night_bright',
    'tomorrow_night_eighties',
    'twilight',
    'vibrant_ink',
    'xcode'
);
$themes_assoc = array();
foreach( $themes as $theme )
{
    $themes_assoc[$theme] = '';
    foreach( explode( '_', $theme ) as $c )
    {
        $themes_assoc[$theme] .= ucfirst($c).' ';
    }
}
return $themes_assoc;