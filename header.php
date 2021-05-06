<?php 
/**
 * The header for our theme.
 * 
 * Displays all of the <head> section and everything up till <div id="conten">
 * 
 * @package havana
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>
<?php 

$bodyClasses = '';

/**
 * Get the header image to display
 */
$headerImageUrl = '';
$headerImageGradientColor = '';
$stop1Opacity = 0.6;
$stop2Opactiy = 0.4;
if ( get_header_image() ) {
    $headerImageUrl = get_header_image();
    $headerImageGradientColor = '41,51,56';
}
?>
</head>

<body <?php body_class( $bodyClasses ) ?>>
</body>