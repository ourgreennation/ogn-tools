<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://davidlaietta.com
 * @since      1.0.0
 *
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Ogn_Tools
 * @subpackage Ogn_Tools/includes
 * @author     David Laietta <david@orangeblossommedia.com>
 */
class Ogn_Tools_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

	}

	/**
     * Remove role for OGN Contributors
     *
     */
    public static function remove_ogn_contributor_role() {

        remove_role( 'ogn_contributor' );

    }

}
