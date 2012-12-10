<?php

function _wpsc_db_upgrade_2() {
	_wpsc_fix_UK_country_code();
	_wpsc_fix_guernsey_country_code();
	_wpsc_new_country_serbia();
	_wpsc_new_country_montenegro();
	_wpsc_fix_timor_leste_name();
	_wpsc_new_country_aland_islands();
	_wpsc_new_country_saint_barthelemy();
	_wpsc_new_country_bonaire_et_al();
	_wpsc_new_country_curacao();
	_wpsc_new_country_saint_martin_french();
	_wpsc_new_country_palestinian_territories();
	_wpsc_update_israeli_new_shekel_symbol();
	_wpsc_new_country_sint_maarten_dutch();
	_wpsc_new_country_french_guiana();
	_wpsc_fix_netherlands_antille();
	_wpsc_fix_angola_kwanza();
	_wpsc_fix_aruban_florin();
	_wpsc_fix_azerbaijani_manat();
	_wpsc_fix_cyprus_currency();
	_wpsc_fix_republic_of_the_congo();
	_wpsc_fix_currency_el_salvador();
	_wpsc_fix_ghanaian_currency_code();
	_wpsc_fix_guatemala_currency();
	_wpsc_fix_guinea_bissau_currency();
	_wpsc_fix_madagascar_currency();
	_wpsc_fix_malta_currency();
	_wpsc_fix_mozambique_currency();
	_wpsc_fix_nicaragua_currency();
	_wpsc_fix_romania_currency();
	_wpsc_fix_san_marino_currency();
	_wpsc_fix_somalia_currency();
	_wpsc_fix_suriname_currency();
	_wpsc_fix_taiwan_currency();
	_wpsc_fix_tajikistan_currency();
	_wpsc_fix_tunisia_currency();
	_wpsc_fix_uganda_currency();
	_wpsc_fix_turkey_currency();
	_wpsc_fix_uruguay_currency();
	_wpsc_fix_venezuela_currency();
	_wpsc_fix_zimbabwe_currency();
}

function _wpsc_fix_UK_country_code() {
	$country = new WPSC_Country( 'GB', 'isocode' );
	$country->set( 'country', __( 'United Kingdom', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_guernsey_country_code() {
	$country = new WPSC_Country( 'GF', 'isocode' );
	$country->set( 'isocode', 'GG' );
	$country->save();
}

function _wpsc_new_country_serbia() {
	$country = new WPSC_Country( array(
		'id'        => 243,
		'country'   => __( 'Serbia', 'wpsc' ),
		'isocode'   => 'RS',
		'currency'  => __('Serbian Dinar', 'wpsc'),
		'code'      => __('RSD', 'wpsc'),
		'continent' => 'europe',
		'visible'   => '0',
	) );
	$country->save();
}

function _wpsc_new_country_montenegro() {
	$country = new WPSC_Country( array(
		'id'          => 244,
		'country'     => __( 'Montenegro', 'wpsc' ),
		'isocode'     => 'ME',
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
		'continent'   => 'europe',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_fix_timor_leste_name() {
	$country = new WPSC_Country( array(
		'id'          => 245,
		'country'     => __( 'Timor-Leste', 'wpsc' ),
		'isocode'     => 'TL',
		'currency'    => __( 'US Dollar', 'wpsc' ),
		'symbol'      => __( '$', 'wpsc' ),
		'symbol_html' => __( '&#036', 'wpsc' ),
		'code'        => 'USD',
		'continent'   => 'asiapacific',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_aland_islands() {
	$country = new WPSC_Country( array(
		'id'          => 246,
		'country'     => __( 'Aland Islands', 'wpsc' ),
		'isocode'     => 'AX',
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
		'continent'   => 'europe',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_saint_barthelemy() {
	$country = new WPSC_Country( array(
		'id'          => 247,
		'country'     => __( 'Saint Barthelemy', 'wpsc' ),
		'isocode'     => 'BL',
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
		'continent'   => 'europe',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_bonaire_et_al() {
	$country = new WPSC_Country( array(
		'id'          => 248,
		'country'     => __( 'Bonaire, Sint Eustatius and Saba', 'wpsc' ),
		'isocode'     => 'BQ',
		'currency'    => __( 'US Dollar', 'wpsc' ),
		'symbol'      => __( '$', 'wpsc' ),
		'symbol_html' => __( '&#036;', 'wpsc' ),
		'code'        => __( 'USD', 'wpsc' ),
		'continent'   => 'southamerica',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_curacao() {
	$country = new WPSC_Country( array(
		'id'          => 249,
		'country'     => __( 'Curacao', 'wpsc' ),
		'isocode'     => 'CW',
		'currency'    => __( 'Netherlands Antillean Guilder', 'wpsc' ),
		'symbol'      => __( 'ƒ', 'wpsc' ),
		'symbol_html' => __( '&#402;', 'wpsc' ),
		'code'        => __( 'ANG', 'wpsc' ),
		'continent'   => 'southamerica',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_saint_martin_french() {
	$country = new WPSC_Country( array(
		'id'          => 250,
		'country'     => __( 'Saint Martin (French Part)', 'wpsc' ),
		'isocode'     => 'MF',
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
		'continent'   => 'southamerica',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_palestinian_territories() {
	$country = new WPSC_Country( array(
		'id'          => 251,
		'country'     => __( 'Palestinian Territories', 'wpsc' ),
		'isocode'     => 'PS',
		'currency'    => __( 'Israeli New Sheqel', 'wpsc' ),
		'symbol'      => __( '₪', 'wpsc' ),
		'symbol_html' => __( '&#8362;', 'wpsc' ),
		'code'        => __( 'ILS', 'wpsc' ),
		'continent'   => 'asiapacific',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_update_israeli_new_shekel_symbol() {
	$country = new WPSC_Country( 'IL', 'isocode' );
	$country->set( array(
		'symbol'      => __( '₪', 'wpsc' ),
		'symbol_html' => __( '&#8362;', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_new_country_sint_maarten_dutch() {
	$country = new WPSC_Country( array(
		'id'          => 252,
		'country'     => __( 'Sint Maarten (Dutch Part)', 'wpsc' ),
		'isocode'     => 'SX',
		'currency'    => __( 'Netherlands Antillean Guilder', 'wpsc' ),
		'symbol'      => __( 'ƒ', 'wpsc' ),
		'symbol_html' => __( '&#402;', 'wpsc' ),
		'code'        => __( 'ANG', 'wpsc' ),
		'continent'   => 'southamerica',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_new_country_french_guiana() {
	$country = new WPSC_Country( array(
		'id'          => 253,
		'country'     => __( 'French Guiana', 'wpsc' ),
		'isocode'     => 'GF',
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
		'continent'   => 'southamerica',
		'visible'     => '0',
	) );
	$country->save();
}

function _wpsc_fix_netherlands_antille() {
	$country = new WPSC_Country( 'AN', 'isocode' );
	$country->set( array(
		'symbol'      => __( 'ƒ', 'wpsc' ),
		'symbol_html' => __( '&#402;', 'wpsc' ),
		'continent'   => 'southamerica',
	) );
	$country->save();
}

function _wpsc_fix_angola_kwanza() {
	$country = new WPSC_Country( 'AO', 'isocode' );
	$country->set( array(
		'code'        => 'AOA',
		'currency'    => __( 'Angolan Kwanza', 'wpsc' ),
		'symbol'      => __( 'Kz', 'wpsc' ),
		'symbol_html' => __( 'Kz', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_aruban_florin() {
	$country = new WPSC_Country( 'AW', 'isocode' );
	$country->set( array(
		'currency'    => __( 'Aruban Florin', 'wpsc' ),
		'symbol'      => __( 'Afl.', 'wpsc' ),
		'symbol_html' => __( 'Afl.', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_azerbaijani_manat() {
	$country = new WPSC_Country( 'AZ', 'isocode' );
	$country->set( array(
		'currency'    => __('Azerbaijani Manat', 'wpsc'),
		'code'        => 'AZN',
		'symbol'      => _x( 'm', 'azerbaijani manat symbol', 'wpsc' ),
		'symbol_html' => _x( 'm', 'azerbaijani manat symbol html', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_cyprus_currency() {
	$country = new WPSC_Country( 'CY', 'isocode' );
	$country->set( array(
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_republic_of_the_congo() {
	$country = new WPSC_Country( 'CG', 'isocode' );
	$country->set( array(
		'country' => __( 'Republic of the Congo', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_currency_el_salvador() {
	$country = new WPSC_Country( 'SV', 'isocode' );
	$country->set( array(
		'currency'    => __( 'US Dollar', 'wpsc' ),
		'symbol'      => __( '$', 'wpsc' ),
		'symbol_html' => __( '&#036', 'wpsc' ),
		'code'        => 'USD',
	) );
	$country->save();
}

function _wpsc_fix_ghanaian_currency_code() {
	$country = new WPSC_Country( 'GH', 'isocode' );
	$country->set( array(
		'code' => 'GHS',
	) );
	$country->save();
}

function _wpsc_fix_guatemala_currency() {
	$country = new WPSC_Country( 'GT', 'isocode' );
	$country->set( array(
		'code' => 'GTQ',
	) );
	$country->save();
}

function _wpsc_fix_guinea_bissau_currency() {
	$country = new WPSC_Country( 'GW', 'isocode' );
	$country->set( array(
		'currency' => __( 'CFA Franc BEAC', 'wpsc' ),
		'code'     => __('XAF', 'wpsc'),
	) );
	$country->save();
}

function _wpsc_fix_madagascar_currency() {
	$country = new WPSC_Country( 'MG', 'isocode' );
	$country->set( array(
		'currency' => __( 'Malagasy Ariary', 'wpsc' ),
		'code'     => __( 'MGA', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_malta_currency() {
	$country = new WPSC_Country( 'MT', 'isocode' );
	$country->set( array(
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_mozambique_currency() {
	$country = new WPSC_Country( 'MZ', 'isocode' );
	$country->set( 'code', __( 'MZN', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_nicaragua_currency() {
	$country = new WPSC_Country( 'NI', 'isocode' );
	$country->set( 'code', __( 'NIO', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_romania_currency() {
	$country = new WPSC_Country( 'RO', 'isocode' );
	$country->set( 'currency', __( 'Romanian New Leu', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_san_marino_currency() {
	$country = new WPSC_Country( 'SM', 'isocode' );
	$country->set( array(
		'currency'    => __( 'Euro', 'wpsc' ),
		'symbol'      => __( '€', 'wpsc' ),
		'symbol_html' => __( '&#8364;', 'wpsc' ),
		'code'        => __( 'EUR', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_somalia_currency() {
	$country = new WPSC_Country( 'SO', 'isocode' );
	$country->set( 'code', __( 'SOS', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_suriname_currency() {
	$country = new WPSC_Country( 'SR', 'isocode' );
	$country->set( array(
		'currency' => __( 'Surinamese Dollar', 'wpsc' ),
		'code' => __( 'SRD', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_taiwan_currency() {
	$country = new WPSC_Country( 'TW', 'isocode' );
	$country->set( 'currency', __( 'New Taiwanese Dollar', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_tajikistan_currency() {
	$country = new WPSC_Country( 'TJ', 'isocode' );
	$country->set( array(
		'currency' => __( 'Tajikistan Somoni', 'wpsc' ),
		'code'     => __( 'TJS', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_tunisia_currency() {
	$country = new WPSC_Country( 'TN', 'isocode' );
	$country->set( 'currency', __( 'Tunisian Dollar', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_turkey_currency() {
	$country = new WPSC_Country( 'TR', 'isocode' );
	$country->set( 'code', __( 'TRY', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_uganda_currency() {
	$country = new WPSC_Country( 'UG', 'isocode' );
	$country->set( 'code', __( 'UGX', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_uruguay_currency() {
	$country = new WPSC_Country( 'UY', 'isocode' );
	$country->set( 'code', __( 'UYU', 'wpsc' ) );
	$country->save();
}

function _wpsc_fix_venezuela_currency() {
	$country = new WPSC_Country( 'VE', 'isocode' );
	$country->set( array(
		'currency' => __( 'Venezuelan Bolivar Fuerte', 'wpsc' ),
		'code'     => __( 'VEF', 'wpsc' ),
	) );
	$country->save();
}

function _wpsc_fix_zimbabwe_currency() {
	$country = new WPSC_Country( 'ZW', 'isocode' );
	$country->set( array(
		'currency'    => __( 'US Dollar', 'wpsc' ),
		'symbol'      => __( '$', 'wpsc' ),
		'symbol_html' => __( '&#036', 'wpsc' ),
		'code'        => 'USD',
		'continent'   => 'asiapacific',
	) );
	$country->save();
}