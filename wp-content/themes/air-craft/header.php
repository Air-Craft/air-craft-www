<!DOCTYPE html>
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <!-- Title -->
    <title><?php get_template_part('inc/title') ?></title>

    <!--    google fonts -->
    <?php echo ot_get_option('coll_google_fonts'); ?>

    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<?php

global $coll_is_mobile;
$slidein = (ot_get_option('coll_header_slide')) ? ot_get_option('coll_header_slide') : '';
$slidein = (!$coll_is_mobile) ? $slidein : '';
$slidein = (
    is_page_template('template-sectioned.php') ||
    is_singular('coll-portfolio') ||
    (is_singular('post') && has_post_thumbnail()) ||
    (is_home() && has_post_thumbnail(get_option('page_for_posts')))
) ? $slidein : '';

$fullwidth = ot_get_option('coll_header_fullwidth');
$fullwidth = ($fullwidth) ? '' : 'row';
$logourl = trailingslashit(get_stylesheet_directory_uri()).'img/AC-Logo-nav.png';// ot_get_option('coll_site_logo');
$logo2url = trailingslashit(get_stylesheet_directory_uri()).'img/AC-Logo-nav.png';// ot_get_option('coll_site_logo_static');
$logopos = ot_get_option('coll_logo_position');
$logopos = ($logopos) ? $logopos : 'coll-left';
$menupos = ot_get_option('coll_menu_position');
$menupos = ($menupos) ? $menupos : 'coll-right';
?>
<header class="site-header <?php if (!empty($slidein)) echo $slidein[0]; ?>">
    <div class="background"></div>
    <div class="<?php echo $fullwidth; ?>">
        <div class="logo <?php echo $logopos; ?>">
            <a class="no-border" href="<?php echo home_url(); ?>">
                <?php if (!empty($logourl)) { ?>
                    <img class="logo-img" src="<?php echo $logourl; ?>" title="" alt="<?php bloginfo('name'); ?>">
                <?php } ?>
            </a>
        </div>
        <nav class="mainmenu  <?php echo $menupos; ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => '',
                'menu_class' => 'sf-menu', //Adding the class for dropdowns
                'before' => '',
                'fallback_cb' => ''

            ));
            ?>
        </nav>

    </div>
</header>
<header class="site-header mobile">
    <div class="background"></div>
    <div class="row">
        <div class="logo">
            <a class="no-border" href="<?php echo home_url(); ?>">
                <?php if (!empty($logourl)) { ?>
                    <img class="logo-img" src="<?php echo $logourl; ?>" title="" alt="<?php bloginfo('name'); ?>">
                <?php } ?>
            </a>
        </div>
        <a id="coll-menu-icon" class="no-border" href=""><i class="fa fa-bars"></i></a>
        <nav class="mainmenu">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => '',
                'menu_class' => 'sf-menu', //Adding the class for dropdowns
                'before' => '',
                'fallback_cb' => ''

            ));
            ?>
        </nav>
    </div>
</header>
<?php if (!empty($slidein)) : ?>
<div class="site-header static">
    <div class="<?php echo $fullwidth; ?>">
        <div class="logo <?php echo $logopos; ?>">
            <a class="no-border" href="<?php echo home_url(); ?>">
                <?php if (!empty($logo2url)) : ?>
                    <img class="logo-img" src="<?php echo $logo2url; ?>" title="" alt="<?php bloginfo('name'); ?>">
                <?php else : ?>
                    <img class="logo-img" src="<?php echo $logourl; ?>" title="" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
            </a>
        </div>
        <nav class="mainmenu  <?php echo $menupos; ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => '',
                'menu_class' => 'sf-menu', //Adding the class for dropdowns
                'before' => '',
                'fallback_cb' => ''
            ));
            ?>
        </nav>
    </div>
</div>
<?php endif; ?>