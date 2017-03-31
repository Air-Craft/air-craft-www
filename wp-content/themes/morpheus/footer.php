<?php
$fullwidth = ot_get_option('coll_header_fullwidth');
$fullwidth = ($fullwidth) ? '' : 'row';

$logo = ot_get_option('coll_footer_logo');
$logohtml = '';
if (!empty($logo)) {
    $logohtml .= '<div class="logo">';
    $logohtml .= '<a class="no-border" href="' . home_url() . '" >';
    $logohtml .= '<img src="' . $logo . '" alt="' . get_bloginfo('name') . '" />';
    $logohtml .= '</a>';
    $logohtml .= '<p>' . get_bloginfo('description') . '</p>';
    $logohtml .= '</div>';
}

$text = ot_get_option('coll_footer_text');
?>

<?php ?>

<footer class="site-footer">
    <div class="background"></div>
    <div class="coll-footer-wrapper <?php echo $fullwidth; ?>">
        <div class="large-12 columns footer-container">
            <?php echo $logohtml; ?>
            <div class="bottom">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu', // menu slug from step 1
                    'container' => false, // 'div' container will not be added
                    'menu_class' => 'nav', // <ul class="nav">
                    'fallback_cb' => '', // name of default function from step 2
                ));
                ?>
                <span class="text"><?php echo do_shortcode($text); ?></span>
            </div>
        </div>
    </div>
</footer>
</div>  <!-- end main-->
<!-- scroll bar-->
<div class="js-coll-scrollbar">
    <div class="js-coll-scrollbar-content">

    </div>
</div>
<!-- prelaoder -->
<?php
$preloader = ot_get_option('coll_preloader');
if (!empty($preloader)) {
    ?>

    <div class="coll-site-preloader">
        <div class="coll-preloader-container">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>

<?php }; ?>
<?php wp_footer(); ?>
</body>
</html>
