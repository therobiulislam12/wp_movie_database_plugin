<?php

namespace TMDB\Admin;

/**
 * Menu class for creating menu
 */
class Menu {

    public function movie_post_type() {
        $labels = [
            "name"          => _x( 'Movies', 'tmdb' ),
            'singular_name' => _x( 'Movie', 'tmdb' ),
            'menu_name'     => _x( 'Movies', 'tmdb' ),
            'add_new'       => _x( 'Add New Movie', 'tmdb' ),
            'add_new_item'  => _x( 'Add New Movie', 'tmdb' ),
        ];

        $options = [
            'label'              => _x( 'Movie', 'tmdb' ),
            'labels'             => $labels,
            'publicly_queryable' => true,
            'public'             => true,
            'hierarchal'         => true,
            'show_in_menu'       => true,
            'menu_position'      => 5,
            // 'show_in_rest'       => true,
            'has_archive'        => true,
            'rewrite'            => array( 'slug' => 'movie' ),
            'supports'           => array( 'title', 'thumbnail', 'editor' ),
            'menu_icon'          => 'dashicons-database',
            'taxonomies'         => array( 'genre', 'author' ),
        ];

        register_post_type( 'movie', $options );
    }

    public function genre_taxonomy() {

        $labels = [
            'name'          => _x( 'Genre', 'tmdb' ),
            'singular_name' => _x( 'Genre', 'tmdb' ),
            'add_new'       => _x( 'Add New Genre', 'tmdb' ),
            'add_new_item'       => _x( 'Add New Genre', 'tmdb' ),
        ];

        $args = [
            'label'             => _x( 'Genre', 'tmdb' ),
            'labels'            => $labels,
            'show_ui'           => true,
            'hierarchical'      => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'genre' ),
        ];

        register_taxonomy( 'genre', 'movie', $args );

    }

    public function actor_taxonomy() {

        $labels = [
            'name'          => _x( 'Actor', 'tmdb' ),
            'singular_name' => _x( 'Actor', 'tmdb' ),
            'add_new'       => _x( 'Add New Actor', 'tmdb' ),
            'add_new_item'       => _x( 'Add New Actor', 'tmdb' ),
        ];

        $args = [
            'label'             => _x( 'Actor', 'tmdb' ),
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'actor' ),
        ];

        register_taxonomy( 'actor', 'movie', $args );

    }

    public function year_taxonomy() {

        $labels = [
            'name'          => _x( 'Year', 'tmdb' ),
            'singular_name' => _x( 'Year', 'tmdb' ),
            'add_new'       => _x( 'Add New Year', 'tmdb' ),
            'add_new_item'       => _x( 'Add New Year', 'tmdb' ),
        ];

        $args = [
            'label'             => _x( 'Year', 'tmdb' ),
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'movie-year' ),
        ];

        register_taxonomy( 'movie-year', 'movie', $args );

    }

    public function director_taxonomy() {

        $labels = [
            'name'          => _x( 'Director', 'tmdb' ),
            'singular_name' => _x( 'Director', 'tmdb' ),
            'add_new'       => _x( 'Add New Director', 'tmdb' ),
            'add_new_item'       => _x( 'Add New Director', 'tmdb' ),
        ];

        $args = [
            'label'             => _x( 'Director', 'tmdb' ),
            'labels'            => $labels,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'director' ),
        ];

        register_taxonomy( 'director', 'movie', $args );

    }

}