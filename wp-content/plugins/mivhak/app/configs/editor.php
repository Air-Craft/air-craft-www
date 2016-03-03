<?php

use Amarkal\UI;

return new Amarkal\Extensions\WordPress\Editor\Plugin(array(
    'slug'      => 'mivhak_button',
    'row'       => 1,
    'script'    => Mivhak\JS_URL.'/editor.js',
    'callback'  => new Amarkal\Extensions\WordPress\Editor\FormCallback(array(
        new Amarkal\UI\Components\DropDown(array(
            'name'          => 'lang',
            'title'         => 'Language',
            'help'          => 'Choose the programming language.',
            'default'       => 'javascript',
            'options'       => include('langs.php')
        )),
        new UI\Components\ToggleButton(array(
            'name'          => 'tag',
            'title'         => 'Display Type',
            'help'          => 'Choose between displaying the code inlined with the text, or in its own block.',
            'default'       => 'pre',
            'labels'        => array(
                'code'      => 'Inline',
                'pre'       => 'Block' 
            )
        )),
        new UI\Components\ToggleButton(array(
            'name'          => 'visibility',
            'title'         => 'Initial Visibility',
            'help'          => 'Hidden code blocks will not be visible to the user until he clicks on "show code"',
            'description'   => '(applicable to code blocks only)',
            'default'       => 'visible',
            'labels'        => array(
                'visible'      => 'Visible',
                'hidden'       => 'Hidden' 
            )
        )),
        new UI\Components\Text(array(
            'name'          => 'caption',
            'title'         => 'Caption Text',
            'help'          => 'Add a description to your code',
            'description'   => '(applicable to code blocks only)'
        )),
        new UI\Components\Text(array(
            'name'          => 'highlight',
            'title'         => 'Highlight Line(s)',
            'help'          => 'Highlight specific code lines or a range of lines',
            'description'   => '(i.e. 1, 3-5, 7-12)'
        )),
        new UI\Components\Spinner(array(
            'name'          => 'start_line',
            'title'         => 'Starting Line',
            'default'       => 1,
            'min'           => 1,
            'help'          => 'Choose the first line number',
        )),
        new UI\Components\CodeEditor(array(
            'name'      => 'code',
            'title'     => 'Code',
            'language'  => 'javascript',
            'default'   => "/**\n * Insert your code here\n */",
            'full'      => true
        ))
    ))
));
