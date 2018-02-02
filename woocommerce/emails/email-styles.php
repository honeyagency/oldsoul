<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg              = get_option( 'woocommerce_email_background_color' );
$body            = get_option( 'woocommerce_email_body_background_color' );
$base            = get_option( 'woocommerce_email_base_color' );
$base_text       = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text            = get_option( 'woocommerce_email_text_color' );

// Pick a contrasting color for links.
$link = wc_hex_is_light( $base ) ? $base : $base_text;
if ( wc_hex_is_light( $body ) ) {
	$link = wc_hex_is_light( $base ) ? $base_text : $base;
}

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
?>
#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	margin: 0;
	padding: 70px 0 70px 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;

	-webkit-font-smoothing:antialiased;
}

#template_container {
	box-shadow: 0 !important;
	background-color: <?php echo esc_attr( $body ); ?>;
	border: 0px !important;
	margin-top:0px;
	border-radius: 0 !important;
}
@media only screen and (max-width: 600px) {
    #template_container {
        display: block;
        width: 100%;
    }
    table, table>tbody, tr {
        display: block;
        width: 100%;
    }
    td {
        box-sizing: border-box;
    }
    #body_content>table>tbody>tr>td {
        padding: 28px 28px 0 !important;
    }
    #template_container>tbody>tr>td {
        display: block;
        width: 100%;
    }
    table>tbody>tr {
        display: block;
        width: 100%;
    }
    #wrapper>table {
        display: block;
        width: 100%;
    }
    #wrapper>table>tbody>tr>td {
        display: block;
        width: 100%;
    }
    #template_header>tbody>tr {
        display: block;
        width: 100%;
    }
    #template_header>tbody>tr>td {
        display: block;
        width: 100%;
    }
    #addresses > tr, #addresses > tr > td {
display:block !important;
width:100% !important;
}
}

#template_header {
	background-color: <?php echo esc_attr( $base ); ?>;
	border-radius: 0 0 0 0 !important;
	color: <?php echo esc_attr( $base_text ); ?>;
	border-bottom: 0;
	font-weight: bold;
	line-height: 100%;
	vertical-align: middle;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
}

#template_header h1,
#template_header h1 a {
	color: <?php echo esc_attr( $base_text ); ?>;
}

#template_footer td {
	padding: 0;
	-webkit-border-radius: 6px;
}
#template_header_image > p{
	margin-bottom: 0;	
}
#template_header_image > p > img{
	width:600px;
	max-width:100%;
	    margin: 0;
    display: block;
}


#template_footer #credit {
	border:0;
	color: <?php echo esc_attr( $base_lighter_40 ); ?>;
	font-family: Arial;
	font-size:12px;
	line-height:125%;
	text-align:center;
	padding: 0 48px 48px 48px;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
	padding: 48px 48px 0;
}

#body_content table td td {
	padding: 12px;
}

#body_content table td th {
	padding: 12px;
}

#body_content td ul.wc-item-meta {
	font-size: small;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#body_content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
	font-size: 17px;
	line-height: 1.7;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

.td {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
}

.address {
	padding:12px 12px 0;
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
}

.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
}

.link {
	color: <?php echo esc_attr( $base ); ?>;
}

#header_wrapper {
	padding: 36px 48px;
	display: block;
}

h1 {
	color: <?php echo esc_attr( $base ); ?>;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
	font-size: 30px;
	font-weight: 300;
	line-height: 1.6;
	margin: 0;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
	text-shadow: 0 1px 0 <?php echo esc_attr( $base_lighter_20 ); ?>;
}

h2 {
	color: #232111;
	display: block;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
	font-size: 18px;
	font-weight: bold;
	line-height: 1.3;
	margin: 0 0 18px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
	color: #232111;
	display: block;
	font-family: -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif;
	font-size: 16px;
	font-weight: bold;
	line-height: 1.3;
	margin: 16px 0 8px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
	color: <?php echo esc_attr( $link ); ?>;
	font-weight: normal;
	text-decoration: underline;
}

img {
	border: none;
	display: inline;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	line-height: 100%;
	max-width:100%;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
}
<?php
