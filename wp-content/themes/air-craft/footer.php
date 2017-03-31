<?php
$fullwidth = ot_get_option('coll_header_fullwidth');
$fullwidth = ($fullwidth) ? '' : 'row';

// $logo = ot_get_option('coll_footer_logo');
// $logohtml = '';
// if (!empty($logo)) {
    // $logohtml .= '<div class="logo">';
    // $logohtml .= '<a class="no-border" href="' . home_url() . '" >';
    // $logohtml .= '<img src="' . $logo . '" alt="' . get_bloginfo('name') . '" />';
    // $logohtml .= '</a>';
    // $logohtml .= '<p>' . get_bloginfo('description') . '</p>';
    // $logohtml .= '</div>';
// }

// $text = ot_get_option('coll_footer_text');
?>

<?php ?>

<footer class="site-footer">
	<div class="row">
		<div class="copyright">2015&ndash;<?php echo date('Y');?> Air Craft Media Ltd. &bull; London UK</div>
    	<div class="logo"><img src="<?php echo trailingslashit(get_stylesheet_directory_uri())?>img/AC-Logo-footer.png" alt="Air Craft — Music, Movement, Amazing"/></div>
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
