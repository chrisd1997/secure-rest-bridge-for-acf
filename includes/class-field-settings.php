<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ACF_REST_Bridge_Field_Settings' ) ) {
	class ACF_REST_Bridge_Field_Settings {
		private function __construct() {}

		public static function hooks() {
			if ( function_exists( 'acf_render_field_setting' ) ) {
				add_action( 'acf/render_field_settings', array( __CLASS__, 'render_field_settings' ) );
			} else {
				add_action( 'acf/create_field_options', array( __CLASS__, 'render_field_settings' ) );
			}
		}

		public static function render_field_settings( $field ) {
			self::show_in_rest( $field );
			self::edit_in_rest( $field );
		}

		private static function show_in_rest( $field ) {
			if ( function_exists( 'acf_render_field_setting' ) ) {
				acf_render_field_setting( $field, array(
					'label'         => __( 'Show in REST API?', 'acf-rest-bridge' ),
					'instructions'  => __( 'Allow this field to be read via the REST API.', 'acf-rest-bridge' ),
					'type'          => 'true_false',
					'name'          => 'show_in_rest',
					'ui'            => 1,
					'class'         => 'field-show_in_rest',
					'default_value' => 0,
				), true );
			}
		}

		private static function edit_in_rest( $field ) {
			if ( function_exists( 'acf_render_field_setting' ) ) {
				acf_render_field_setting( $field, array(
					'label'         => __( 'Edit in REST API?', 'acf-rest-bridge' ),
					'instructions'  => __( 'Allow this field to be updated via the REST API.', 'acf-rest-bridge' ),
					'type'          => 'true_false',
					'name'          => 'edit_in_rest',
					'ui'            => 1,
					'class'         => 'field-edit_in_rest',
					'default_value' => 0,
				), true );
			}
		}
	}
}
