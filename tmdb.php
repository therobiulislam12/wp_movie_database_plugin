<?php

/**
 * Plugin Name:       The Movie Database
 * Description:       Basic Plugin for movie database
 * Plugin URI:        #
 * Version:           1.0.0
 * Author:            Robiul Islam
 * Author URI:        https://robiul-islam.netlify.app
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:      tmdb
 */

// check if anyone try access direct file
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

final class The_Movie_Database {

    // create $instance
    public static $instance = null;

    private function __construct() {

        // create a custom post type
        add_action( 'init', [$this, 'tmdb_register_post_type'] );

        // Create custom taxonomy
        add_action( 'init', [$this, 'tmdb_register_taxonomy'] );

        // initialize plugin
        add_action( 'plugin_loaded', [$this, 'init_plugin'] );
    }

    /**
     *
     * Create function instance
     *
     * @return \The_Movie_Database
     */
    public static function getInstance() {

        if ( !self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;

    }

    /**
     * Initialize plugin
     * @return void
     */
    public function init_plugin() {

        if ( is_admin() ) {

        } else {
            new TMDB\Frontend();
        }

    }

    /**
     *
     * Custom Movie Post Type
     *
     * @return void
     */
    public function tmdb_register_post_type() {

        $moviePostType = new TMDB\Admin\Menu();

        $moviePostType->movie_post_type();

    }

    /**
     * Create genre taxonomy
     * @return void
     */
    public function tmdb_register_taxonomy() {

        $genreTaxonomy = new TMDB\Admin\Menu();

        $genreTaxonomy->genre_taxonomy();
        $genreTaxonomy->actor_taxonomy();
        $genreTaxonomy->director_taxonomy();
        $genreTaxonomy->year_taxonomy();

    }

}

/**
 * Create a function for call class
 */
function the_movie_db() {
    return The_Movie_Database::getInstance();
}

// Kick of the plugin
the_movie_db();