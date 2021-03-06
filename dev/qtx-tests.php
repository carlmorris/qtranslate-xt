<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function qtranxf_tst_log( $msg, $var = 'novar', $bt = false, $exit = false ) {
	qtranxf_dbg_log( $msg, $var, $bt, $exit );
}

function qtranxf_check_test( $result, $expected, $test_name ) {
	//qtranxf_tst_log('qtranxf_check_test: $result='.$result. PHP_EOL .'                 $expected=',$expected);
	if ( $result == $expected ) {
		return true;
	}
	qtranxf_tst_log( $test_name . ': ' . $result . ' != ', $expected );

	return false;
}

//qtranxf_tst_log('qtx-tests: SERVER: ',$_SERVER);
//require_once(dirname(__FILE__).'/qtx-test-convertURL.php');
//require_once(dirname(__FILE__).'/qtx-test-date-time.php');

// *
function qtranxf_test_interface() {
	$t = apply_filters( 'wp_translator', null );
	qtranxf_tst_log( 'qtranxf_test_interface: $t: ', $t );

	$text = apply_filters( 'translate_text', '[:en](EN)text[:de](DE)text[:]' );
	qtranxf_tst_log( 'qtranxf_test_interface: $text: ', $text );

	$text = apply_filters( 'translate_text', '[:en](EN)text[:de](DE)text[:]', 'de' );
	qtranxf_check_test( $text, '(DE)text', 'qtranxf_test_interface: translate_text' );

	$url = apply_filters( 'translate_url', '' );
	qtranxf_tst_log( 'qtranxf_test_interface: $url: ', $url );

	$term = apply_filters( 'translate_term', '(EN) Cat1' );
	qtranxf_tst_log( 'qtranxf_test_interface: $term: ', $term );

	$mlterm = apply_filters( 'multilingual_term', '(EN) Cat1' );
	qtranxf_tst_log( 'qtranxf_test_interface: $mlterm: ', $mlterm );
}

//qtranxf_test_interface(); // */

// *
function qtranxf_test_next_posts_link() {
	//global $post;
	$npl = next_posts_link();
	qtranxf_tst_log( 'qtranxf_test_next_posts_link: ', $npl );
}

//qtranxf_test_next_posts_link();// */

//exit();

// *
function qtranxf_test_meta_cache() {
	global $post;
	if ( ! is_singular() || ! $post || 'post' != $post->post_type ) {
		qtranxf_tst_log( 'qtranxf_test_meta_cache: return' );

		return;
	}
	$views = get_post_meta( $post->ID, 'views', true );
	$views = $views ? $views : 0;
	$views ++;
	update_post_meta( $post->ID, 'views', $views );
	$views_fetched = get_post_meta( $post->ID, 'views', true );
	if ( qtranxf_check_test( $views_fetched, $views, 'qtranxf_test_meta_cache' ) ) {
		qtranxf_tst_log( 'qtranxf_test_meta_cache: ok' );
	}
	//qtranxf_tst_log('qtranxf_test_meta_cache: views_expected='.$views.'; $views_fetched=',$views_fetched);
}
//add_filter( 'wp_head', 'qtranxf_test_meta_cache', 1 );// */

/*
"customize":{
	"pages":{"customize.php":""},
	"anchors":{"customize-control-blogname":{"where":"first"}},
	"forms":{
		"customize-controls":{
			"fields":{
				"blogname":{"jquery":"#customize-control-blogname input", "name":"blogname"},
				"blogdescription":{"jquery":"#customize-control-blogdescription input", "name":"blogdescription"},
				"preview-notice":{"jquery":"#customize-info span.preview-notice", "encode":"display"}
			}
		}
	},
	"js-conf":{"customize-conf":{"src":"./admin/js/customize-conf.min.js"}},
	"js-exec":{"customize-exec":{"src":"./admin/js/customize-exec.min.js"}}
}
,
*/
