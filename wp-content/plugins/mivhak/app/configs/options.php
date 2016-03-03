<?php

use Amarkal\Extensions\WordPress\Options;
use Amarkal\UI\Components;

return array(
    'banner'        => Mivhak\IMG_URL.'/banner.jpg',
    'title'         => 'Mivhak',
    'subtitle'      => 'A lightweight syntax highlighter for WordPress',
    'version'       => 'v'.Mivhak\PLUGIN_VERSION,
    'author'        => 'Askupa Software',
    'author_url'    => 'http://askupasoftware.com',
    'sidebar_title' => 'Mivhak',
    'sidebar_icon'  => 'dashicons-editor-code',
    'footer_icon'   => Mivhak\IMG_URL.'/askupa-logo.png',
    'footer_text'   => date("Y").' © Askupa Software',
    'subfooter_text'=> 'If you like Mivhak, please give it <a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/mivhak?filter=5#postform">★★★★★</a> rating on WordPress.org. Thanks!',
    'sections'      => array(
        new Options\Section(array(
            'title'         => 'General',
            'description'   => 'General syntax highlighting settings.',
            'icon'          => 'fa-gear',
            'fields'        => array(
                new Components\ToggleButton(array(
                    'name'          => 'line_numbers',
                    'title'         => 'Line Numbers',
                    'default'       => 'OFF',
                    'help'          => 'Show/hide line numbers for highlighted code blocks.'
                )),
                new Components\ToggleButton(array(
                    'name'          => 'show_meta',
                    'title'         => 'Show Meta Bar',
                    'default'       => 'ON',
                    'help'          => 'Show/hide a header bar with meta information and controls.'
                )),
                new Components\Spinner(array(
                    'name'          => 'min_lines',
                    'title'         => 'Minimum Lines',
                    'min'           => 1,
                    'step'          => 1,
                    'default'       => 1,
                    'help'          => 'Code blocks with less lines than specified here will not show a meta header bar.'
                )),
                new Components\ToggleButton(array(
                    'name'          => 'auto_assign',
                    'title'         => 'Auto Assign',
                    'labels'        => array('PRE', 'CODE', 'XHR'),
                    'multivalue'    => true,
                    'help'          => 'Choose the HTML elements that you want Mivhak to automatically syntax-highlight.'
                )),
                new Amarkal\UI\Components\DropDown(array(
                    'name'          => 'default_lang',
                    'title'         => 'Default Language',
                    'help'          => 'Choose a programming language that will be used by default for code blocks that have no specified programming language.',
                    'default'       => '',
                    'options'       => array( '' => 'None' ) + include('langs.php')
                ))
            )
        )),
        new Options\Section(array(
            'title'         => 'Appearance',
            'icon'          => 'fa-paint-brush',
            'description'   => 'Setup the look and feel of Mivhak',
            'fields'        => array(
                new Components\ToggleButton(array(
                    'name'          => 'css_toggle',
                    'title'         => 'Use Custom CSS',
                    'help'          => 'Toggle on/off to use the custom CSS on the next field. The CSS code will be printed in the document\'s head',
                    'default'       => 'OFF'
                )),
                new Components\CodeEditor(array(
                    'name'          => 'css',
                    'title'         => 'Custom CSS Code',
                    'help'          => 'Insert your custom CSS here. Since this will be printed in the head of the document (as opposed to making an http request), it is not recommended to use this for big CSS changes (hundreds of lines of code).',
                    'language'      => 'css',
                    'default'       => "/**\n * Insert your custom CSS here\n */"
                )),
                new Components\Spinner(array(
                    'name'          => 'font_size',
                    'title'         => 'Font Size',
                    'help'          => 'Set the code editor font size in pixels.',
                    'min'           => 0,
                    'default'       => 12
                )),
                new Components\DropDown(array(
                    'name'          => 'theme',
                    'title'         => 'Theme',
                    'help'          => 'Choose a highlighter theme that best matches your blog\'s theme style.',
                    'default'       => 'default.css',
                    'options'       => include __DIR__.'/themes.php'
                )),
                new Components\Content(array(
                    'title'         => 'Preview',
                    'full_width'    => true,
                    'template'      => Mivhak\PLUGIN_DIR . '/preview.phtml'
                ))
            )
        ))
    )
);