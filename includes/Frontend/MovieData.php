<?php

namespace TMDB\Frontend;

class MovieData {
    public function __construct() {

        add_filter( 'the_title', [$this, 'tmdb_movie_title'], 10, 2 );

        add_filter( 'the_content', [$this, 'tmdb_add_movie_details'] );

        add_filter( 'the_content', [$this, 'tmdb_show_related_posts'] );

    }

    public function tmdb_movie_title( $title, $id ) {

        $post = get_post( $id );

        $year = get_the_terms( $post->ID, 'movie-year' );

        // dump( $post );

        if ( $post->post_type !== 'movie' ) {
            return $title;
        }

        if ( $year && !is_wp_error( $year ) ) {
            $title .= ' ( ' . $year[0]->name . ' )';
        }

        return $title;

    }

    public function tmdb_add_movie_details( $content ) {

        $post = get_post( get_the_ID() );

        if ( $post->post_type !== 'movie' ) {
            return $content;
        }

        $genre = get_the_term_list( get_the_ID(), 'genre', '', ', ' );
        $actor = get_the_term_list( get_the_ID(), 'actor', '', ', ' );
        $director = get_the_term_list( get_the_ID(), 'director', '', ', ' );
        $year = get_the_term_list( get_the_ID(), 'movie-year', '', ', ' );

        $info = '<ul>';

        if ( $genre ) {
            $info .= '<li>';
            $info .= '<strong>Genre:</strong> ';
            $info .= $genre;
            $info .= '</li>';
        }

        if ( $actor ) {
            $info .= '<li>';
            $info .= '<strong>Actors:</strong> ';
            $info .= $actor;
            $info .= '</li>';
        }

        if ( $director ) {
            $info .= '<li>';
            $info .= '<strong>Director:</strong> ';
            $info .= $director;
            $info .= '</li>';
        }

        if ( !is_wp_error( $year ) && $year ) {
            $info .= '<li>';
            $info .= '<strong>Year:</strong> ';
            $info .= $year;
            $info .= '</li>';
        }

        $info .= '</ul>';

        return $content . $info;
    }

    public function tmdb_show_related_posts( $content ) {

        $genre = get_the_terms( get_the_ID(), 'genre' );

        if ( !$genre ) {
            return $content;
        }

        $posts = get_posts( array(
            'post_type'    => 'movie',
            'post__not_in' => [get_the_ID()],
            'tax_query'    => [
                'relation' => 'OR',
                [
                    'taxonomy' => 'genre',
                    'terms'    => wp_list_pluck( $genre, 'term_id' ),
                ],
            ],
        ) );

        if ( !$posts ) {
            return $content;
        }

        $related = '<h3>Related Movies</h3>';
        $related .= '<ul>';

        foreach ( $posts as $movie ) {
            $related .= sprintf(
                '<li><a href="%s">%s</a></li>',
                get_permalink( $movie ),
                get_the_title( $movie )
            );
        }

        $related .= '</ul>';

        return $content . $related;
    }
}