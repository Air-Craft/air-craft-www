<?php
/**
 * Class for managing plugin data
 */
class Su_Data
{

    /**
     * Constructor
     */
    function __construct()
    {
    }

    /**
     * Shortcode groups
     */
    public static function groups()
    {
        return ( array )apply_filters('su/data/groups', array(
            'all' => __('All', 'su'),
            'content' => __('Content', 'su'),
            'box' => __('Box', 'su'),
            'media' => __('Media', 'su'),
            'gallery' => __('Gallery', 'su'),
            'data' => __('Data', 'su'),
            'other' => __('Other', 'su')
        ));
    }

    public static function borders()
    {
        return ( array )apply_filters('su/data/borders', array(
            'none' => __('None', 'su'),
            'solid' => __('Solid', 'su'),
            'dotted' => __('Dotted', 'su'),
            'dashed' => __('Dashed', 'su'),
            'double' => __('Double', 'su'),
            'groove' => __('Groove', 'su'),
            'ridge' => __('Ridge', 'su')
        ));
    }

    public static function icons()
    {
        return apply_filters('su/data/icons', array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'outdent', 'indent', 'video-camera', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'users', 'link', 'cloud', 'flask', 'scissors', 'files-o', 'paperclip', 'floppy-o', 'square', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'sort', 'sort-asc', 'sort-desc', 'envelope', 'linkedin', 'undo', 'gavel', 'tachometer', 'comment-o', 'comments-o', 'bolt', 'sitemap', 'umbrella', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'reply-all', 'mail-reply-all', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'caret-square-o-down', 'caret-square-o-up', 'caret-square-o-right', 'eur', 'gbp', 'usd', 'inr', 'jpy', 'rub', 'krw', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'try', 'plus-square-o'));
    }

    /**
     * Shortcode groups
     */
    public static function examples()
    {
        return ( array )apply_filters('su/data/examples', array(
            'basic' => array(
                'title' => __('Basic examples', 'su'),
                'items' => array(
                    array(
                        'name' => __('Accordions, spoilers, different styles, anchors', 'su'),
                        'id' => 'spoilers',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/spoilers.example',
                        'icon' => 'tasks'
                    ),
                    array(
                        'name' => __('Tabs, vertical tabs, tab anchors', 'su'),
                        'id' => 'tabs',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/tabs.example',
                        'icon' => 'folder'
                    ),
                    array(
                        'name' => __('Column layouts', 'su'),
                        'id' => 'columns',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/columns.example',
                        'icon' => 'th-large'
                    ),
                    array(
                        'name' => __('Media elements, YouTube, Vimeo, Screenr and self-hosted videos, audio player', 'su'),
                        'id' => 'media',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/media.example',
                        'icon' => 'play-circle'
                    ),
                    array(
                        'name' => __('Unlimited buttons', 'su'),
                        'id' => 'buttons',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/buttons.example',
                        'icon' => 'heart'
                    ),
                    array(
                        'name' => __('Animations', 'su'),
                        'id' => 'animations',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/animations.example',
                        'icon' => 'bolt'
                    ),
                )
            ),
            'advanced' => array(
                'title' => __('Advanced examples', 'su'),
                'items' => array(
                    array(
                        'name' => __('Interacting with posts shortcode', 'su'),
                        'id' => 'posts',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/posts.example',
                        'icon' => 'list'
                    ),
                    array(
                        'name' => __('Nested shortcodes, shortcodes inside of attributes', 'su'),
                        'id' => 'nested',
                        'code' => plugin_dir_path(SU_PLUGIN_FILE) . '/inc/examples/nested.example',
                        'icon' => 'indent'
                    ),
                )
            ),
        ));
    }

    /**
     * Shortcodes
     */
    public static function shortcodes($shortcode = false)
    {
        $shortcodes = apply_filters('su/data/shortcodes', array(
	        //	accordion
	        'accordion' => array(
		        'name' => __('Accordion', 'su'),
		        'type' => 'wrap',
		        'group' => 'content',
		        'atts' => array(
			        'class' => array(
				        'default' => '',
				        'name' => __('Class', 'su'),
				        'desc' => __('Extra CSS class', 'su')
			        )
		        ),
		        'content' => __("[coll_toggle title=\"Title one\"]Content one[/coll_toggle]\n[coll_toggle title=\"Title due\"]Content due[/coll_toggle]\n", 'su'),
		        'desc' => __('Accordion container', 'su'),
		        'icon' => 'tasks'
	        ),
	        // blog
	        'blog' => array(
		        'name' => __('Blog', 'su'),
		        'type' => 'single',
		        'group' => 'content',
		        'atts' => array(
			        'categories' => array(
				        'type' => 'select',
				        'multiple' => true,
				        'values' => Su_Tools::get_terms('category'),
				        'default' => '',
				        'name' => __('Categories', 'su'),
				        'desc' => __('Select categories to show posts from', 'su')
			        ),
			        'width' => array(
				        'type' => 'select',
				        'values' => array(
					        12 => '12/12 - full width',
					        11 => '11/12',
					        10 => '10/12 - five sixths',
					        9 => '9/12 - three fourths',
					        8 => '8/12 - two thirds',
					        7 => '7/12',
					        6 => '6/12 - one half',
					        5 => '5/12',
					        4 => '4/12 - one third',
					        3 => '3/12 - one fourth',
					        2 => '2/12 - one sixth',
					        1 => '1/12 - one twelveth'
				        ),
				        'default' => 4,
				        'name' => __('Columns', 'su'),
				        'desc' => __('Set the width of a post. 12 = full width or 1 post/row, 6 = half width or 2 posts/row', 'su')
			        ),
			        'number' => array(
				        'type' => 'text',
				        'default' => get_option('posts_per_page'),
				        'name' => __('Number', 'su'),
				        'desc' => __('Set the maximum number of posts to display. default is the number set in settings/reading', 'su')
			        ),
			        'lightbox' => array(
				        'type' => 'bool',
				        'default' => 'no',
				        'name' => __('Lightbox ', 'su'),
				        'desc' => __('Open post in a lightbox on the same page', 'su')
			        ),
			        'thumb' => array(
				        'type' => 'bool',
				        'default' => 'no',
				        'name' => __('Thumbnail ', 'su'),
				        'desc' => __('Show featured image thumbnail', 'su')
			        ),
			        'color' => array(
				        'type' => 'color',
				        'values' => array(),
				        'default' => '#000',
				        'name' => __('Text Color', 'su'),
				        'desc' => __('Set the color for the text', 'su')
			        ),
			        'color_hover' => array(
				        'type' => 'color',
				        'values' => array(),
				        'default' => '#333',
				        'name' => __('Text Hover Color', 'su'),
				        'desc' => __('Set the color for the text on mouse hover', 'su')
			        ),
			        'target' => array(
				        'type' => 'select',
				        'values' => array(
					        '_self' => __('Same tab', 'su'),
					        '_blank' => __('New tab', 'su')
				        ),
				        'default' => '_self',
				        'name' => __('Target', 'su'),
				        'desc' => __('Post link target', 'su')
			        ),
			        'class' => array(
				        'default' => '',
				        'name' => __('Class', 'su'),
				        'desc' => __('Extra CSS class', 'su')
			        )
		        ),
		        'desc' => __('Flex Slider', 'su'),
		        'icon' => 'book'
	        ),
            // button
            'button' => array(
                'name' => __('Button', 'su'),
                'type' => 'wrap',
                'group' => 'content',
                'atts' => array(
                    'url' => array(
                        'values' => array(),
                        'default' => '#',
                        'name' => __('Link', 'su'),
                        'desc' => __('Button link', 'su')
                    ),
                    'target' => array(
                        'type' => 'select',
                        'values' => array(
                            '_self' => __('Same tab', 'su'),
                            '_blank' => __('New tab', 'su')
                        ),
                        'default' => '_self',
                        'name' => __('Target', 'su'),
                        'desc' => __('Button link target', 'su')
                    ),
                    'background_color' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#',
                        'name' => __('Background Color', 'su')
                    ),
                    'background_color_hover' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => ot_get_option('coll_accent_color'),
                        'name' => __('Hover Background  Color', 'su')
                    ),
                    'color' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#000',
                        'name' => __('Text color', 'su')
                    ),
                    'color_hover' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#fff',
                        'name' => __('Hover Text color', 'su')
                    ),
                    'border' => array(
                        'type' => 'border',
                        'default' => '2px solid #000',
                        'name' => __('Border', 'su')
                    ),
                    'border_hover' => array(
                        'type' => 'border',
                        'default' => '2px solid ' . ot_get_option('coll_accent_color'),
                        'name' => __('Hover Border', 'su')
                    ),
                    'radius' => array(
                        'type' => 'text',
                        'default' => '0',
                        'name' => __('Radius', 'su'),
                        'desc' => __('Radius of button corners', 'su')
                    ),
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class. If the link points to a location inside the current page, add "js-coll-local-link" as extra class', 'su')
                    )
                ),
                'content' => __('Button text', 'su'),
                'desc' => __('Styled button', 'su'),
                'icon' => 'hand-o-up'
            ),
	        // clients
            'clients' => array(
	            'name' => __('Clients', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'group' => array(
			            'type' => 'select',
			            'values' => Su_Tools::coll_get_term_slugs('coll-clients-group'),
			            'default' => '',
			            'name' => __('Group', 'su'),
			            'desc' => __('Select a Group of Clients', 'su')
		            ),
		            'width' => array(
			            'type' => 'select',
			            'values' => array(
				            12 => '12/12 - full width',
				            11 => '11/12',
				            10 => '10/12 - five sixths',
				            9 => '9/12 - three fourths',
				            8 => '8/12 - two thirds',
				            7 => '7/12',
				            6 => '6/12 - one half',
				            5 => '5/12',
				            4 => '4/12 - one third',
				            3 => '3/12 - one fourth',
				            2 => '2/12 - one sixth',
				            1 => '1/12 - one twelveth'
			            ),
			            'default' => 3,
			            'name' => __('Width', 'su'),
			            'desc' => __('Select the width the column', 'su')
		            ),
		            'target' => array(
			            'type' => 'select',
			            'values' => array(
				            '_self' => __('Same tab', 'su'),
				            '_blank' => __('New tab', 'su')
			            ),
			            'default' => '_self',
			            'name' => __('Target', 'su'),
			            'desc' => __('Button link target', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __('Button text', 'su'),
	            'desc' => __('Styled button', 'su'),
	            'icon' => 'briefcase'
            ),
	        //columns
            'columns' => array(
	            'name' => __('Columns', 'su'),
	            'type' => 'wrap',
	            'group' => 'box',
	            'atts' => array(
		            'width' => array(
			            'type' => 'select',
			            'values' => array(
				            12 => '12/12 - full width',
				            11 => '11/12',
				            10 => '10/12 - five sixths',
				            9 => '9/12 - three fourths',
				            8 => '8/12 - two thirds',
				            7 => '7/12',
				            6 => '6/12 - one half',
				            5 => '5/12',
				            4 => '4/12 - one third',
				            3 => '3/12 - one fourth',
				            2 => '2/12 - one sixth',
				            1 => '1/12 - one twelveth'
			            ),
			            'default' => 4,
			            'name' => __('Width', 'su'),
			            'desc' => __('Select the width the column', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Insert a column', 'su'),
	            'icon' => 'columns'
            ),
	        // contact
            'contact' => array(
	            'name' => __('Contact', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'to' => array(
			            'type' => 'text',
			            'default' => get_bloginfo('admin_email'),
			            'name' => __('To', 'su'),
			            'desc' => __('Insert recieving email address', 'su')
		            ),
		            'color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#000',
			            'name' => __('Color', 'su'),
			            'desc' => __('Choose the color of the text', 'su')
		            ),
		            'border_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#d5d5d5',
			            'name' => __('Border Color', 'su'),
			            'desc' => __('Choose the color of the field border', 'su')
		            ),
		            'border_color_selected' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#999',
			            'name' => __('Selected Border Color', 'su'),
			            'desc' => __('Choose the color of the selected field border', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Contact Form', 'su'),
	            'icon' => 'envelope'
            ),
	        // countdown
            'countdown' => array(
	            'name' => __('Countdown', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'y' => array(
			            'type' => 'number',
			            'min' => 2014,
			            'max' => 2020,
			            'default' => 2014,
			            'name' => __('Year', 'su'),
			            'desc' => __('Select the year', 'su')
		            ),
		            'm' => array(
			            'type' => 'number',
			            'default' => 0,
			            'min' => 0,
			            'max' => 11,
			            'name' => __('Month', 'su'),
			            'desc' => __('Set the month. January = 0', 'su')
		            ),
		            'd' => array(
			            'type' => 'number',
			            'default' => 1,
			            'min' => 1,
			            'max' => 31,
			            'name' => __('Day', 'su'),
			            'desc' => __('Set the day', 'su')
		            ),
		            'h' => array(
			            'type' => 'number',
			            'default' => 0,
			            'min' => 0,
			            'max' => 24,
			            'name' => __('Hour', 'su'),
			            'desc' => __('Set the hour', 'su')
		            ),
		            'min' => array(
			            'type' => 'number',
			            'default' => 0,
			            'min' => 0,
			            'max' => 60,
			            'name' => __('Minute', 'su'),
			            'desc' => __('Set the minute', 'su')
		            ),
		            'color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#fff',
			            'name' => __('Color', 'su'),
			            'desc' => __('Set the color for the timer', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Countdown timer', 'su'),
	            'icon' => 'clock-o'
            ),
            // flexslider
            'flexslider' => array(
                'name' => __('Flex Slider', 'su'),
                'type' => 'single',
                'group' => 'content',
                'atts' => array(
                    'id' => array(
                        'type' => 'select',
                        'values' => Su_Tools::get_sliders('coll-flexslider'),
                        'default' => '',
                        'name' => __('Slider', 'su'),
                        'desc' => __('Select a Flex Slider', 'su')
                    ),
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class', 'su')
                    )
                ),
                'desc' => __('Flex Slider', 'su'),
                'icon' => 'picture-o'
            ),
	        // gmap
            'gmap' => array(
	            'name' => __('Google Map', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'type' => array(
			            'type' => 'select',
			            'values' => array(
				            'ROADMAP' => __('roadmap', 'su'),
				            'SATELLITE ' => __('satellite', 'su'),
				            'HYBRID' => __('hybrid', 'su'),
				            'TERRAIN' => __('terrain', 'su')
			            ),
			            'default' => 'ROADMAP',
			            'name' => __('Type', 'su'),
			            'desc' => __('Select the type of the map', 'su')
		            ),
		            'latitude' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '40.7039419',
			            'name' => __('Latitude', 'su'),
			            'desc' => __('Insert latitude', 'su')
		            ),
		            'longitude' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '-74.0112864',
			            'name' => __('Longitude', 'su'),
			            'desc' => __('Insert longitude', 'su')
		            ),
		            'zoom' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '17',
			            'name' => __('Zoom', 'su'),
			            'desc' => __('Insert zoom level (1-21)', 'su')
		            ),
		            'width' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '100%',
			            'name' => __('Width', 'su'),
			            'desc' => __('Set the map width (px/%/em)', 'su')
		            ),
		            'height' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '400px',
			            'name' => __('Height', 'su'),
			            'desc' => __('Set the map width (px/%/em)', 'su')
		            ),
		            'hue' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#004cff',
			            'name' => __('Hue', 'su'),
			            'desc' => __('Set the hue color', 'su'),
		            ),
		            'saturation' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '0',
			            'name' => __('Saturation', 'su'),
			            'desc' => __('Set saturation : -100 is grayscale', 'su')
		            ),
		            'message' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => 'Your Marker Message Here',
			            'name' => __('Marker Message', 'su'),
			            'desc' => __('Set a message that shows up when a user clicks the marker', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Google Map', 'su'),
	            'icon' => 'map-marker'
            ),
	        // iframe
            'iframe' => array(
	            'name' => __('Iframe', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __('Paste the iframe embed code here', 'su'),
	            'desc' => __('Iframe scroll fix', 'su'),
	            'icon' => 'list-alt'
            ),
	        // layerslider
            'layerslider' => array(
	            'name' => __('Layer Slider', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'id' => array(
			            'type' => 'select',
			            'values' => Su_Tools::get_layer_sliders(),
			            'default' => '',
			            'name' => __('Slider', 'su'),
			            'desc' => __('Select a Layer Slider', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Layer Slider', 'su'),
	            'icon' => 'picture-o'
            ),
	        // middle
            'middle' => array(
	            'name' => __('Middle', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Center content Vertically and Horizontally. Make sure it is the only thing on the page section.', 'su'),
	            'icon' => 'arrows-v'
            ),
	        // portfolio
            'portfolio' => array(
	            'name' => __('Portfolio', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'filter' => array(
			            'type' => 'bool',
			            'default' => 'yes',
			            'name' => __('Show Filter ', 'su'),
			            'desc' => __('Check this if you want the filter to be displayed', 'su')
		            ),
		            'categories' => array(
			            'type' => 'select',
			            'multiple' => true,
			            'values' => Su_Tools::coll_get_term_slugs('coll-portfolio-category'),
			            'default' => '',
			            'name' => __('Categories', 'su'),
			            'desc' => __('Select categories to show portfolio posts from', 'su')
		            ),
		            'width' => array(
			            'type' => 'select',
			            'values' => array(
				            12 => '12/12 - full width',
				            11 => '11/12',
				            10 => '10/12 - five sixths',
				            9 => '9/12 - three fourths',
				            8 => '8/12 - two thirds',
				            7 => '7/12',
				            6 => '6/12 - one half',
				            5 => '5/12',
				            4 => '4/12 - one third',
				            3 => '3/12 - one fourth',
				            2 => '2/12 - one sixth',
				            1 => '1/12 - one twelveth'
			            ),
			            'default' => 4,
			            'name' => __('Columns', 'su'),
			            'desc' => __('Set the width of a portfolio item. 12 = full width or 1 item/row, 6 = half width or 2 items/row', 'su')
		            ),
		            'number' => array(
			            'type' => 'text',
			            'default' => -1,
			            'name' => __('Number', 'su'),
			            'desc' => __('Set the maximum number of portfolio items to display. by default it will all will be displayed', 'su')
		            ),
		            'font_size' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '16px',
			            'name' => __('Title Font Size', 'su'),
			            'desc' => __('Set the font size for the thumbnail title.', 'su')
		            ),
		            'filter_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#000',
			            'name' => __('Filter Color', 'su'),
			            'desc' => __('Set the color for the filter items', 'su')
		            ),
		            'filter_color_hover' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#333',
			            'name' => __('Text Hover Color', 'su'),
			            'desc' => __('Set the color for the filter items on mouse hover', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Flex Slider', 'su'),
	            'icon' => 'th-large'
            ),
	        // pricing table
            'pricing_table' => array(
	            'name' => __('Pricing Table', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'table' => array(
			            'type' => 'select',
			            'values' => Su_Tools::coll_get_term_slugs('coll-pricing-table'),
			            'default' => '',
			            'name' => __('Table', 'su'),
			            'desc' => __('Select a Pricing Table', 'su')
		            ),
		            'width' => array(
			            'type' => 'select',
			            'values' => array(
				            12 => '12/12 - full width',
				            11 => '11/12',
				            10 => '10/12 - five sixths',
				            9 => '9/12 - three fourths',
				            8 => '8/12 - two thirds',
				            7 => '7/12',
				            6 => '6/12 - one half',
				            5 => '5/12',
				            4 => '4/12 - one third',
				            3 => '3/12 - one fourth',
				            2 => '2/12 - one sixth',
				            1 => '1/12 - one twelveth'
			            ),
			            'default' => 3,
			            'name' => __('Width', 'su'),
			            'desc' => __('Select the width the column', 'su')
		            ),
		            'title_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#000',
			            'name' => __('Title Color', 'su'),
			            'desc' => __('Set the color for Title', 'su')
		            ),
		            'text_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#bbb',
			            'name' => __('Text Color', 'su'),
			            'desc' => __('Set the color for text.', 'su')
		            ),
		            'link_hover_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#fff',
			            'name' => __('Link Text Color Hover', 'su'),
			            'desc' => __('Set the color for the purchase button text on hover', 'su')
		            ),
		            'link_hover_color_background' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => ot_get_option('coll_accent_color'),
			            'name' => __('Link Background Color Hover', 'su'),
			            'desc' => __('Set the color for the purchase button background on hover', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Price tables', 'su'),
	            'icon' => 'usd'
            ),
            // row
            'row' => array(
                'name' => __('Row', 'su'),
                'type' => 'wrap',
                'group' => 'box',
                'atts' => array(
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class', 'su')
                    )
                ),
                'content' => __('Insert your column shortcodes here', 'su'),
                'desc' => __('Row for flexible columns', 'su'),
                'icon' => 'bars'
            ),
	        // services
            'services' => array(
	            'name' => __('Services', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'group' => array(
			            'type' => 'select',
			            'values' => Su_Tools::coll_get_term_slugs('coll-service-group'),
			            'default' => '',
			            'name' => __('Services', 'su'),
			            'desc' => __('Select a Services Group', 'su')
		            ),
		            'width' => array(
			            'type' => 'select',
			            'values' => array(
				            12 => '12/12 - full width',
				            11 => '11/12',
				            10 => '10/12 - five sixths',
				            9 => '9/12 - three fourths',
				            8 => '8/12 - two thirds',
				            7 => '7/12',
				            6 => '6/12 - one half',
				            5 => '5/12',
				            4 => '4/12 - one third',
				            3 => '3/12 - one fourth',
				            2 => '2/12 - one sixth',
				            1 => '1/12 - one twelveth'
			            ),
			            'default' => 3,
			            'name' => __('Width', 'su'),
			            'desc' => __('Select the width the column', 'su')
		            ),
		            'image_type' => array(
			            'type' => 'select',
			            'values' => array(
				            'round' => 'Rounded',
				            'original' => 'Original'
			            ),
			            'default' => 'original',
			            'name' => __('Image style', 'su'),
			            'desc' => __('Select the style of the image', 'su')
		            ),
		            'name_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#000',
			            'name' => __('Name Color', 'su'),
			            'desc' => __('Set the color for name', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Services shortcode', 'su'),
	            'icon' => 'tachometer'
            ),
	        // skill
            'skill' => array(
	            'name' => __('Skill', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'title' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => 'Skill',
			            'name' => __('Skill Name', 'su'),
			            'desc' => __('Set Skill Name', 'su')
		            ),
		            'number' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '35',
			            'name' => __('Percent number', 'su'),
			            'desc' => __('Set the knowledge percent of this skill (1 - 100)', 'su')
		            ),
		            'width' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '150',
			            'name' => __('Width ', 'su'),
			            'desc' => __('Set the width of the elipse', 'su')
		            ),
		            'height' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '150',
			            'name' => __('Height', 'su'),
			            'desc' => __('Set the height of the elipse', 'su')
		            ),
		            'thickness' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '0.05',
			            'name' => __('Thickness', 'su'),
			            'desc' => __('Set the thickness of the elipse', 'su')
		            ),
		            'title_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#aaa',
			            'name' => __('Title Color', 'su'),
			            'desc' => __('Set the color for the title', 'su')
		            ),
		            'number_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#aaa',
			            'name' => __('Number Color', 'su'),
			            'desc' => __('Set the color for the percent number', 'su')
		            ),
		            'full_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#aaa',
			            'name' => __('Elipse Color', 'su'),
			            'desc' => __('Set the color for elipse.', 'su')
		            ),
		            'percent_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => ot_get_option('coll_accent_color'),
			            'name' => __('Percent Elipse color', 'su'),
			            'desc' => __('Set the color for the percent elipse color', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __('Insert skill name', 'su'),
	            'desc' => __('Skill percentage', 'su'),
	            'icon' => 'flask'
            ),
	        // smart padding
            'smart_padding' => array(
	            'name' => __('Smart Padding', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'min' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '0',
			            'name' => __('Min', 'su'),
			            'desc' => __('Set the padding percentage for mobile devices', 'su')
		            ),
		            'max' => array(
			            'type' => 'text',
			            'values' => array(),
			            'default' => '20',
			            'name' => __('Max', 'su'),
			            'desc' => __('Set the padding percentage for desktop', 'su')
		            ),

	            ),
	            'desc' => __('Responsive Padding', 'su'),
	            'icon' => 'unsorted'
            ),
            // social icon
            'social_icon' => array(
                'name' => __('Social Icon', 'su'),
                'type' => 'single',
                'group' => 'content',
                'atts' => array(
                    'name' => array(
                        'type' => 'select',
                        'values' => array(
                            'facebook' => 'Facebook',
                            'dribbble' => 'Dribbble',
                            'twitter' => 'Twitter',
                            'youtube' => 'Youtube',
                            'instagram' => 'Instagram',
                            'github-alt' => 'Github',
                            'google-plus' => 'Google+',
                            'linkedin' => 'Linkedin',
                            'skype' => 'Skype',
                            'tumblr' => 'Tumblr',
                            'pinterest' => 'Pinterest'
                        ),
                        'default' => 'facebook',
                        'name' => __('Sevice Name', 'su'),
                        'desc' => __('Select the service name', 'su')
                    ),
                    'url' => array(
                        'values' => array(),
                        'default' => '#',
                        'name' => __('Link', 'su'),
                        'desc' => __('Button link', 'su')
                    ),
                    'font_size' => array(
                        'type' => 'text',
                        'default' => '1em',
                        'name' => __('Icon Font Size', 'su'),
                        'desc' => __('Set the size of the icon. add px / % / em / etc after the value', 'su')
                    ),
                    'width' => array(
                        'type' => 'text',
                        'default' => '36px',
                        'name' => __('Width', 'su'),
                        'desc' => __('Set the width of the button. add px / % / em / etc after the value', 'su')
                    ),
                    'height' => array(
                        'type' => 'text',
                        'default' => '36px',
                        'name' => __('Height', 'su'),
                        'desc' => __('Set the height of the button. add px / % / em / etc after the value', 'su')
                    ),
                    'radius' => array(
                        'type' => 'text',
                        'default' => '50%',
                        'name' => __('Radius', 'su'),
                        'desc' => __('Set the border radius of the button. add px / % / em / etc after the value', 'su')
                    ),
                    'padding' => array(
                        'type' => 'text',
                        'default' => '5px',
                        'name' => __('Padding', 'su'),
                        'desc' => __('Set the space between social icons. add px / % / em / etc after the value', 'su')
                    ),
                    'target' => array(
                        'type' => 'select',
                        'values' => array(
                            'self' => __('Same tab', 'su'),
                            'blank' => __('New tab', 'su')
                        ),
                        'default' => 'self',
                        'name' => __('Target', 'su'),
                        'desc' => __('Button link target', 'su')
                    ),
                    'color' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#000',
                        'name' => __('Icon Color', 'su')
                    ),
                    'color_hover' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#fff',
                        'name' => __('Icon Hover Color', 'su')
                    ),
                    'border_color' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#000',
                        'name' => __('Border Color', 'su')
                    ),
                    'background_color_hover' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => ot_get_option('coll_accent_color'),
                        'name' => __('Background Hover Color', 'su')
                    ),
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class', 'su')
                    )
                ),
                'desc' => __('Social Icon Shortcode', 'su'),
                'icon' => 'facebook-square'
            ),
	        // tabs
            'tab' => array(
	            'name' => __('Tab', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'title' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Tab Title', 'su'),
			            'desc' => __('Set a title for yout tab. Must be unique', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __('Tab content goes here', 'su'),
	            'desc' => __('Tab', 'su'),
	            'icon' => 'folder-o'
            ),
            'tabs' => array(
	            'name' => __('Tabs', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'active' => array(
			            'type' => 'number',
			            'min' => 1,
			            'max' => 100,
			            'step' => 1,
			            'default' => 1,
			            'name' => __( 'Active tab', 'su' ),
			            'desc' => __( 'Select which tab is open by default', 'su' )
		            ),
		            'active_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => ot_get_option('coll_accent_color'),
			            'name' => __('Active tab color', 'su'),
			            'desc' => __( 'Set a color for the active tab top border', 'su' )
		            ),
		            'vertical' => array(
			            'type' => 'bool',
			            'default' => 'no',
			            'name' => __( 'Vertical', 'su' ),
			            'desc' => __( 'Show tabs vertically', 'su' )
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __("[coll_tab title=\"Title 1\"]Content 1[/coll_tab]\n[coll_tab title=\"Title 2\"]Content 2[/coll_tab]\n[coll_tab title=\"Title 3\"]Content 3[/coll_tab]", 'su'),
	            'desc' => __('Tabs container', 'su'),
	            'icon' => 'folder-o'
            ),
            // team
            'team' => array(
                'name' => __('Team', 'su'),
                'type' => 'single',
                'group' => 'content',
                'atts' => array(
                    'team' => array(
                        'type' => 'select',
                        'values' => Su_Tools::coll_get_term_slugs('coll-team-teams'),
                        'default' => '',
                        'name' => __('Team', 'su'),
                        'desc' => __('Select a Team', 'su')
                    ),
                    'width' => array(
                        'type' => 'select',
                        'values' => array(
                            12 => '12/12 - full width',
                            11 => '11/12',
                            10 => '10/12 - five sixths',
                            9 => '9/12 - three fourths',
                            8 => '8/12 - two thirds',
                            7 => '7/12',
                            6 => '6/12 - one half',
                            5 => '5/12',
                            4 => '4/12 - one third',
                            3 => '3/12 - one fourth',
                            2 => '2/12 - one sixth',
                            1 => '1/12 - one twelveth'
                        ),
                        'default' => 3,
                        'name' => __('Width', 'su'),
                        'desc' => __('Select the width the column', 'su')
                    ),
                    'image_type' => array(
                        'type' => 'select',
                        'values' => array(
                            'round' => 'Rounded',
                            'original' => 'Original'
                        ),
                        'default' => 'round',
                        'name' => __('Image style', 'su'),
                        'desc' => __('Select the style of the image', 'su')
                    ),
                    'name_color' => array(
                        'type' => 'color',
                        'values' => array(),
                        'default' => '#000',
                        'name' => __('Name Color', 'su'),
                        'desc' => __('Set the color for name', 'su')
                    ),
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class', 'su')
                    )
                ),
                'desc' => __('Team Shortcode', 'su'),
                'icon' => 'users'
            ),
	        // text types
            'text' => array(
	            'name' => __('Text Types', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'type' => array(
			            'type' => 'select',
			            'values' => array(
				            '01' => '1',
				            '02' => '2',
				            '03' => '3',
				            '04' => '4',
				            '05'  => '5',
				            '06' => '6',
				            '07' => '7',
				            '08' => '8',
				            '09' => '9',
				            '10' => '10',
				            '11' => '11',
				            '12' => '12',
				            '13' => '13'

			            ),
			            'default' => '01',
			            'name' => __('Type', 'su'),
			            'desc' => __('Select the text type', 'su')
		            ),
		            'max_font_size' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Max Font Size', 'su'),
			            'desc' => __('Change the maximum font size (large screens)', 'su')
		            ),
		            'min_font_size' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Min Font Size', 'su'),
			            'desc' => __('Change the minimum font size (phone screens)', 'su')
		            ),
		            'color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#000',
			            'name' => __('Text Color', 'su'),
			            'desc' => __('Set the color for the text', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __('Dummy Text', 'su'),
	            'desc' => __('Awesome Text', 'su'),
	            'icon' => 'font'
            ),
	        // toggle
            'toggle' => array(
	            'name' => __('Toggle', 'su'),
	            'type' => 'wrap',
	            'group' => 'content',
	            'atts' => array(
		            'title' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Toggle Title', 'su'),
			            'desc' => __('Set a title for your toggle. Must be unique!', 'su')
		            ),
		            'active' => array(
			            'type' => 'bool',
			            'default' => 'no',
			            'name' => __('Active', 'su'),
			            'desc' => __('Check this if you want the toggle to be opened', 'su')
		            ),
		            'active_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => ot_get_option('coll_accent_color'),
			            'name' => __('Active Toogle color', 'su'),
			            'desc' => __( 'Set a color for the active toggle left border', 'su' )
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'content' => __("Insert content here", 'su'),
	            'desc' => __('Toggle container', 'su'),
	            'icon' => 'tasks'
            ),
	        // twitter
            'twitter' => array(
	            'name' => __('Twitter', 'su'),
	            'type' => 'single',
	            'group' => 'content',
	            'atts' => array(
		            'usr' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Username', 'su'),
			            'desc' => __('Insert the twitter account username', 'su')
		            ),
		            'nr' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Number of Tweets', 'su'),
			            'desc' => __('Set the number of tweets you want to display', 'su')
		            ),
		            'oat' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Oauth Access Token', 'su'),
			            'desc' => __('Insert your app\'s Oauth Access Token', 'su')
		            ),
		            'oats' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Oauth Access Token Secret', 'su'),
			            'desc' => __('Insert your app\'s Oauth Access Token Secret', 'su')
		            ),
		            'ck' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Consumer Key', 'su'),
			            'desc' => __('Insert your app\'s Consumer Key', 'su')
		            ),
		            'cks' => array(
			            'type' => 'text',
			            'default' => '',
			            'name' => __('Consumer Key Secret', 'su'),
			            'desc' => __('Insert your app\'s Consumer Key Secret', 'su')
		            ),
		            'color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#bdc3c7',
			            'name' => __('Main Color', 'su'),
			            'desc' => __('Set the main color', 'su')
		            ),
		            'text_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#313131',
			            'name' => __('Text Color', 'su'),
			            'desc' => __('Set the text color', 'su')
		            ),
		            'link_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => '#999',
			            'name' => __('Link Color', 'su'),
			            'desc' => __('Set the links color', 'su')
		            ),
		            'linkh_color' => array(
			            'type' => 'color',
			            'values' => array(),
			            'default' => ot_get_option('coll_accent_color'),
			            'name' => __('Link Hover Color', 'su'),
			            'desc' => __('Set the links hover color', 'su')
		            ),
		            'class' => array(
			            'default' => '',
			            'name' => __('Class', 'su'),
			            'desc' => __('Extra CSS class', 'su')
		            )
	            ),
	            'desc' => __('Twitter Shortcode', 'su'),
	            'icon' => 'twitter'
            ),
            // video
            'video' => array(
                'name' => __('Video', 'su'),
                'type' => 'wrap',
                'group' => 'content',
                'atts' => array(
	                'lightbox' => array(
		                'type' => 'bool',
		                'default' => 'no',
		                'name' => __( 'Lightbox', 'su' ),
		                'desc' => __( 'Open video in lightbox. allows scroll over it', 'su' )
	                ),
                    'class' => array(
                        'default' => '',
                        'name' => __('Class', 'su'),
                        'desc' => __('Extra CSS class', 'su')
                    )
                ),
                'content' => __('Paste the video iframe embed code here', 'su'),
                'desc' => __('Responsive youtube/vimeo video', 'su'),
                'icon' => 'video-camera'
            ),


        ));
        // Return result
        return (is_string($shortcode)) ? $shortcodes[sanitize_text_field($shortcode)] : $shortcodes;
    }
}

class Shortcodes_Ultimate_Data extends Su_Data
{
    function __construct()
    {
        parent::__construct();
    }
}
