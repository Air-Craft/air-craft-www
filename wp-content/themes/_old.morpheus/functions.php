<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/10/13
 * Time: 11:16 AM
 * To change this template use File | Settings | File Templates.
 */

load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusPluginActivation.php');

load_template(trailingslashit(get_template_directory()) . 'functions/Mobile_Detect.php');
load_template(trailingslashit(get_template_directory()) . 'functions/settings.php');
load_template(trailingslashit(get_template_directory()) . 'functions/enqueue.php');
load_template(trailingslashit(get_template_directory()) . 'functions/utils.php');
load_template(trailingslashit(get_template_directory()) . 'functions/twitter.php');

load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusUtils.php');
load_template(trailingslashit(get_template_directory()) . 'functions/sc_generator/shortcodes-ultimate.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusCustomPostTypes.php');
load_template(trailingslashit(get_template_directory()) . 'functions/metaboxes/MorpheusMetaBoxes.php');


load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeBlog.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeButtons.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeClients.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeColumns.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeContact.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeFlexSlider.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeGoogleMap.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeLayerSlider.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodePortfolio.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodePricingTable.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeRow.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeMiddle.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeSkill.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeSmartPadding.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeSocialIcon.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeTeam.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeServices.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeTextTypes.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeVideo.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeIframe.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeTabs.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeTab.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeAccordion.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeToggle.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeTwitter.php');
load_template(trailingslashit(get_template_directory()) . 'functions/MorpheusShortcodeCountdown.php');




// POWER UP OPTIONS TREE
add_filter('ot_theme_mode', '__return_true');
add_filter('ot_show_pages', '__return_false');
add_filter('ot_show_new_layout', '__return_false');

load_template(trailingslashit(get_template_directory()) . 'option-tree/ot-loader.php');
load_template(trailingslashit(get_template_directory()) . 'functions/theme-options.php');


//demo install
load_template(trailingslashit(get_template_directory()) . 'demo/importer.php');