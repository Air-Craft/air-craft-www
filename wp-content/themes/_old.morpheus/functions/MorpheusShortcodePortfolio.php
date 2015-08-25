<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 9/16/13
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */

include_once( 'MorpheusShortCodeScriptLoader.php' );

class MorpheusShortcodePortfolio extends MorpheusShortCodeScriptLoader {

	static $addedAlready = false;

	public function handleShortcode( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'filter'             => 'yes',
			'categories'         => '',
			'width'              => 4,
			'medium_width'       => 6,
			'font_size'          => '16px',
			'number'             => - 1,
			'filter_color'       => '#000',
			'filter_color_hover' => '#333',
			'class'              => ''
		), $atts ) );

		$filter = ( $filter == 'yes' ) ? true : false;

		// get all categories if none was provided
		if ( empty( $categories ) ) {
			$cats = array();
			foreach ( (array) get_terms( 'coll-portfolio-category', array( 'hide_empty' => false ) ) as $cat ) {
				$cats[] = $cat->slug;
			}
			$categories = implode( $cats, ', ' );
		} else {

		}
		$Qargs = array(
			'post_type'               => 'coll-portfolio',
			'coll-portfolio-category' => $categories,
			'posts_per_page'          => $number
		);


		$output = '';

		// portfolio
		$output .= '<div class="coll-shortcode-portfolio ' . $class . '">';

		// filter
		if ( $filter ) {
			// start filter
			$categories = explode( ",", $categories );
			$tax_terms  = array();
			foreach ( $categories as $slug ) {
				$tax_terms[] = get_term_by( 'slug', $slug, 'coll-portfolio-category' );
			}

			$output .= '<ul class="filter">';
			// first item (all)
			$output .= '<li>';
			$output .= '<a  href="#"
                            class="coll-button one item js-coll-portfolio-filter"
                            style="color:' . $filter_color . ';border-color:' . $filter_color . '"
                            data-coll-color="' . $filter_color . '"
                            data-coll-color-hover="' . $filter_color_hover . '"
                            data-filter="*"
                            >' . __( 'All', 'framework' ) . '</a>';
			$output .= '</li>';
			// the rest of the filter items
			foreach ( $tax_terms as $tax_term ) {
				$output .= '<li>';
				$output .= '<a  href="#"
                                class="coll-button one item js-coll-portfolio-filter"
                                style="color:' . $filter_color . ';border-color:' . $filter_color . '"
                                data-coll-color="' . $filter_color . '"
                                data-coll-color-hover="' . $filter_color_hover . '"
                                data-filter=".' . $tax_term->slug . '"
                               >' . $tax_term->name . '</a>';
				$output .= '</li>';
			}
			$output .= '</ul>';
			// end filter
		}

		// items containse
		$output .= '<div class="items js-coll-portfolio">';

		// items
		$loop = new WP_Query( $Qargs );
		while ( $loop->have_posts() ) : $loop->the_post();
			global $post;

			// get info
			//$columns = 12 / $columns;
			$class = join( " ", get_post_class() );
			$class .= ' large-' . $width . ' medium-' . $medium_width . ' columns';

			$tmb               = get_post_meta( get_the_ID(), 'thumb', true );
			$tmb               = wp_get_attachment_image_src( $tmb, 'full' );
			$tmb_hover_opacity = get_post_meta( get_the_ID(), 'coll_thumb_hover_opacity', true );
			$tmb_hover_opacity = $tmb_hover_opacity ? $tmb_hover_opacity : 1;
			$tmbColor          = get_post_meta( get_the_ID(), 'coll_thumb_color', true );
			$tmbColor          = ( $tmbColor ) ? 'background-color: ' . $tmbColor . ';' : '';
			$title             = get_the_title( get_the_ID() );
			$url               = get_permalink( get_the_ID() );

			$open     = get_post_meta( get_the_ID(), 'coll_open', true );
			$target   = '';
			$lightbox = 'thumb';
			if ( $open == 2 ) {
				$url    = get_post_meta( get_the_ID(), 'coll_proj_url', true );
				$target = ' target="_blank"';
			}
			if ( $open == 3 ) {
				$lightbox .= ' js-coll-port-lightbox';
			}
			// build
			$output .= '<article id="' . $post->post_name . '"
                                 class="' . $class . '"
                                 data-coll-hover-opacity="' . $tmb_hover_opacity . '">';
			$output .= '<div class="wrapper">';
			$output .= '<div class="holder">';
			$output .= '<img class="hidden"
                                    width="' . $tmb[1] . '"
                                    height="' . $tmb[2] . '"
                                    alt="' . $title . '"
                                    src="' . $tmb[0] . '"
                                    />';

			$output .= '<div class="inner">';
			$output .= '<a class="' . $lightbox . '" href="' . $url . '"' . $target . ' >';
			$output .= '<div class="color under" style="' . $tmbColor . '"></div>';
			$output .= '<img class="visible"
                                    width="' . $tmb[1] . '"
                                    height="' . $tmb[2] . '"
                                    alt="' . $title . '"
                                    src="' . $tmb[0] . '"
                                    />';
			$output .= '<div class="color above"></div>';
			$output .= '<div class="info">';
			$output .= '<div class="vcenter">';
			$output .= '<h3 class="title" style="font-size:'.$font_size.'" >_' . $title . '</h3>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</a>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</article>';





		endwhile; //end items
		$output .= '</div>'; // end items container ;
		$output .= '</div>'; // end portfolio ;

		wp_reset_postdata();

		return $output;
	}

	public function addScript() {
		if ( ! self::$addedAlready ) {
			self::$addedAlready = true;
		}
	}
}

$sc = new MorpheusShortcodePortfolio();
$sc->register( 'coll_portfolio' );