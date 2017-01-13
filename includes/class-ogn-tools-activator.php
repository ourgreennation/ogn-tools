<?php

/**
 * Fired during plugin activation
 *
 * @link       http://davidlaietta.com
 * @since      1.0.0
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 * @author     David Laietta <david@orangeblossommedia.com>
 */
class Ogn_Tools_Activator {

	/**
	 * Flush rewrite rules on activation.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();
	}

	/**
     * Add role for OGN Contributors
     *
     */
    public static function add_ogn_contributor_role() {

        add_role(
            'ogn_contributor',
            'Our Green Nation Contributor',
            array(
                'read' => true,
            )
        );

    }

}
