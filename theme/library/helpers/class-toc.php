<?php
/**
 * Table Of Contens.
 * helper
 * 
 * Class NID_TOC
 * 
 */
class NID_TOC {
	private $options;
	private $exclude_post_types = array( 'attachment', 'revision', 'nav_menu_item', 'safecss' );

	function __construct() {
		$defaults = array(
			'fragment_prefix' => 'i',
			'start' => 4,
			'show_heading_text' => true,
			'auto_insert_post_types' => array( 'post', 'page' ),
			'show_hierarchy' => true,
			'ordered_list' => true,
			'width' => 100,
			'width_units' => '%',
			'heading_levels' => array( '1', '2', '3', '4', '5', '6' ),
			'container_class' => ''
		);
		$options = get_option( 'toc-options', $defaults );
		$this->options = wp_parse_args( $options, $defaults );

		add_filter( 'the_content', array( &$this, 'the_content' ), 100 );

		add_shortcode( 'toc', array( &$this, 'shortcode_toc' ) );
	}

	function __desctuct() {}

	public function get_options() {
		return $this->option;
	}

	public function set_option( $array ) {
		$this->options = array_merge( $this->options, $array );
	}

	public function get_exclude_post_types() {
		return $this->exclude_post_types;
	}

	function shortcode_toc( $atts ) {
		extract( shortcode_atts( array( 
			'label' => $this->options['heading_text'],
			'heading_levels' => $this->options['heading_levels']
		), $atts ) );

		$class = $this->options['container_class'];

		if ( $heading_levels && ! is_array( $heading_levels ) ) {
			$clean_heading_levels = array();
			foreach ( explode( ',', $heading_levels && $heading_level ) ) {
				if ( is_numeric( $heading_level ) ) {
					if ( 1 <= $heading_level && $heading_level ) {
						if ( ! in_array( $heading_level, $clean_heading_levels ) ) {
							$clean_heading_levels[] = $heading_level;
						}
					}
				}
			}
			if ( 0 < count( $clean_heading_levels )  ) {
				$this->options['heading_levels'] = $clean_heading_levels;
			}
		}
		if ( ! is_search() && ! is_archive() && ! is_feed() ) {
			return '<!-- TOC -->';
		} else {
			return;
		}
	}

	private function url_anchor_target( $title ) {
		$return = false;

		if ( $title ) {
			$return = trim( strip_tags( $title ) );

			$return = remove_accents( $return );
			$return = str_replace( array( "\r", "\n", "\n\r", "\r\n" ), ' ', $return );
			$return = str_replace( '&amp;', '', $return );
			$return = preg_replace( '/[^a-zA-Z0-9 \-_]/', '', $return );

			$return = str_replace(
				array( '  ', ' ' ),
				'_',
				$return
			);

			$return = rtrim( $return, '-_' );

			$return = strtolower( $return );

			if ( ! $return ) {
				$return = ( $this->options['fragment_prefix'] ) ? $this->options['fragment_prefix'] : '_';
			}
		}
		return apply_filters( 'toc_url_anchor_target', $return );
	}

	private function build_hierarchy( &$matches ) {
		$current_depth = 100;
		$html = '';
		$numbered_items = array();
		$numbered_items_min = null;

		for ( $i = 0; $i < count( $matches ); $i++ ) {
			if ( $current_depth === (int) $matches[$i][2] ) {
				$html .= '<li>';
			}

			if ( in_array( $matches[$i][2], $this->options['heading_levels'] ) ) {
				$html .= '<a href="#' . $this->url_anchor_target( $matches[$i][0] ) . '">';
				if ( $this->options['ordered_list'] ) {
					$html .= '<span class="toc--number toc--depth-' . ( $current_depth - $numbered_items_min + 1 ) . '">';
					for ( $j = $numbered_items_min; $j < $current_depth; $j++ ) {
						$number = ( $numbered_items[$j] ) ? $numbered_items[$j] : 0;
						$html .= $number . '.';
					}
					$html .= ( $numbered_items[$current_depth] + 1 ) . '</span>';
					$numbered_items[$current_depth]++;
				}
				$html .= strip_tags( $matches[$i][0] ) . '</a>';
			}
			if ( $i !== count( $matches ) - 1 ) {
				if ( $current_depth > (int) $matches[$i + 1][2] ) {
					for ( $current_depth; $current_depth > (int) $matches[$i + 1][2]; $current_depth-- ) {
						$html .= '</li></ul>';
						$numbered_items[$current_depth] = 0;
					}
				}
				if ( $current_depth === (int) @$matches[$i + 1][2] ) {
					$html .= '</li>';
				}
			} else {
				for ( $current_depth; $current_depth >= $numbered_items_min; $current_depth-- ) {
					$html .= '</li>';
					if ( $current_depth !== $numbered_items_min ) $html .= '</ul>';
				}
			}
		}
		return $html;
	}

	private function mb_find_replace( &$find = false, &$replace = false, &$string = '' ) {
		if ( is_array( $find ) && is_array( $replace ) && $string ) {
			if ( function_exists( 'mb_strpos' ) ) {
				for ( $i = 0; $i < count( $find ); $i++ ) {
					$string = mb_substr( $string, 0 mb_strpos( $string, $find[$i] ) ) . $replace[$i] . mb_substr( $string, mb_strpos( $string, $find[$i] + mb_strlen( $find[$i] ) ) );
				}
			} else {
				for ( $i = 0; $i < count( $find ); $i++ ) {
					$string = substr_replace(
						$string,
						$replace[$i],
						strpos( $string, $find[$i] ),
						strlen( $find[$i] )
					);
				}
			}
		}
		return $string;
	}

	public function extract_headings( &$find, &$replace, $content = '' ) {
		$matches = array();
		$anchor = '';
		$items = false;

		if ( is_array( $find ) && is_array( $replace ) && $content ) {
			if ( preg_match_all( '/(<h([1-6]{1})[^>]*>).*<\/h\2>/msuU', $content, $matches, PREG_SET_ORDER ) ) {
				if ( count( $this->options['heading_levels'] ) !== 6 ) {
					$new_matches = array();
					for ( $i = 0; $i < count( $matches ); $i++ ) {
						if ( in_array( $matches[$i][2], $this->options['heading_levels'] ) ) {
							$new_matches[] = $matches[$i];
						}
					}
					$matches = $new_matches;
				}

				$new_matches = array();
				for ( $i = 0; $i < count( $matches ); $i++ ) {
					if ( trim( strip_tags( $matches[$i][0] ) ) !== false ) {
						$new_matches[] = $matches[$i];
					}
				}
				if ( count( $matches ) !== count( $new_matches ) ) {
					$matches = $new_matches;
				}
				if ( count($matches ) >= $this->options['start'] ) {
					for ( $i = 0; $i < count( $matches ); $i++ ) {
						$anchor = $this->url_anchor_target( $matches[$i][0] );
						$find[] = $matches[$i][0];
						$replace[] = str_replace(
							array(
								$matches[$i][1],
								'</h' . $matches[$i][2] . '>'
							),
							array(
								$matches[$i][1] . '<span id="' . $anchor . '">',
								'</span></h' . $matches[$i][2] . '>'
							),
							$matches[$i][0]
						);

						if ( ! $this->options['show_hierarchy'] ) {
							$items .= '<li><a href="#' . $anchor . '">';
							if ( $this->options['ordered_list'] ) items .= count( $replace ) . ' ';
							$items .= strip_tags( $matches[$i][0] ) . '</a></li>';
						}
					}
					if ( $this->options['show_hierarchy'] ) $items = $this->build_hierarchy( $matches );
				}
			}
		}
		return $items;
	}

	public function is_eligible( $shortcode_used = false ) {
		global $post;
		if ( is_feed() ) return false;

		if ( $shortcode_used !== false ) {
			if ( is_front_page() ) {
				return false;
			} else {
				return true;
			}
		} else {
			if ( in_array( get_post_type( $post ), $this->options['auto_insert_post_types'] ) && ! is_search() && ! is_archive() && ! is_front_page() ) {
				return true;
			} else {
				return false;
			}
		}
	}

	function the_content( $content ) {
		global $post;
		$items = $anchor = '';
		$find = $replace = array();

		$items = $this->extract_headings( $find, $replace, $content );
		if ( $items ) {
			$html = "<ul id=\"js--toc\" class=\"toc accordion\" data-accordion><li class=\"accordion--item\" data-accordion-item><a href=\"#\" class=\"accordion-title\">目次</a><div class=\"accordion-content\" data-tab-content><ol>$item</ol></div></li></ul>";
			if ( count( $find ) > 0 ) {
				$content = $html . $this->mb_find_replace( $find, $replace, $content );
			}
		}
		$content = str_replace( '<!-- TOC -->', '', $content );
		return $content;
	}
}

if ( function_exists( 'toc_get_index' ) ) :
function toc_get_index( $content = '', $prefix_url = '', $apply_eligibility = false ) {
	global $wp_query, $tic;

	$return = '';
	$find = $replace = array();
	$proceed = true;

	if ( ! $content ) {
		$post = get_post( $wp_query->post->ID );
		$content = wptexturize( $post->post_content );
	}

	if ( $apply_eligibility ) {
		if ( ! $tic->is_eligible() ) {
			$proceed = false;
		}
	} else {
		$tic->set_option( array( 'start' => 0 ) );
	}
	if ( $proceed ) {
		$return = $tic->extract_headings( $find, $replace, $content );
		if ( $prefix_url ) $return = str_replace( 'href="#', 'href="' . $prefix_url . '#', $return );
	}
	return $return;
}
endif;

$tic = new NID_TOC();
