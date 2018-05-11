<?php
/**
 * Plugin Name: MITlib CF7 Elements
 * Plugin URI: https://github.com/MITLibraries/mitlib-cf7-elements
 * Description: Adds custom form controls for CF7 needed by the MIT Libraries.
 * Version: 0.0.3
 * Author: Matt Bernhardt
 * Author URI: https://github.com/matt-bernhardt
 * License: GPL2
 *
 * @package MITlib CF7 Elements
 * @author Matt Bernhardt
 * @link https://github.com/MITLibraries/mitlib-cf7-elements
 */

/**
 * MITlib CF7 Elements is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * MITlib CF7 Elements is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MITlib CF7 Elements. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
 */

// Don't call the file directly!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers extended widget.
 */
function add_custom_elements() {
	wpcf7_add_form_tag( 'authenticate', 'authenticate_handler' );
	wpcf7_add_form_tag( array( 'select_dlc', 'select_dlc*' ), 'dlc_handler', array( 'name-attr' => true ) );
}
add_action( 'wpcf7_init', 'add_custom_elements' );

/**
 * Implements custom validation for DLC selection.
 *
 * @param object $result A WPCF7_Validation object.
 * @param object $tag    A WPCF7_FormTag object.
 * @link https://contactform7.com/2015/03/28/custom-validation/
 */
function identify_required( $result, $tag ) {
	// Check if the field is marked as required.
	if ( 'select_dlc*' == $tag->type ) {
		$result = validate_dlc_filter( $result, $tag );
	}
	return $result;
}
add_filter( 'wpcf7_validate_select_dlc*', 'identify_required', 20, 2 );


/**
 * Implements custom validation for DLC selection.
 *
 * @param object $result A WPCF7_Validation object.
 * @param object $tag    A WPCF7_FormTag object.
 * @link https://contactform7.com/2015/03/28/custom-validation/
 */
function validate_dlc_filter( $result, $tag ) {
	// Has the DLC name been set?
	if ( empty( $_POST['department'] ) || '' == sanitize_text_field( wp_unslash( $_POST['department'] ) ) ) {
		$result->invalidate( $tag, 'Please specify your department, lab, or center.' );
	}
	return $result;
}

/**
 * Authenticate button handler.
 *
 * @param object $tag A WPCF7_FormTag object.
 */
function authenticate_handler( $tag ) {
	// We don't need the WPCF7_FormTag object here.
	unset( $tag );
	return '<button name="authenticate" onClick="loginFunctions.doLoginAndRedirect(location.pathname);">Auto-fill form (MIT only)</button>';
}

/**
 * DLC selection handler.
 *
 * This returns a select element of MIT departments, labs, and centers.
 *
 * @param object $tag A WPCF7_FormTag object.
 */
function dlc_handler( $tag ) {
	$select = '<select name="department" class="wpcf7-form-control wpcf7-select">';
	if ( 'select_dlc*' == $tag->type ) {
		// Required fields need additional attributes.
		$select = '<select name="department" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">';
	}

	$field = '<span class="wpcf7-form-control-wrap department">';
	$field .= $select;
	$field .= file_get_contents( plugin_dir_path( __FILE__ ) . 'templates/select_dlc.html' );
	$field .= '</select>';
	$field .= '</span>';
	return $field;
}
