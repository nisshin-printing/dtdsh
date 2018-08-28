<?php


class NInc_TOC {
	
	private $exclude_post_types;
	private $collision_collector;
	private $container_class;
	private $heading_levels;
	
	function __construct() {
		$this->exclude_post_types = array( 'attachment', 'revision', 'nav_menu_item', 'safecss' );
		$this->collision_collector = array();
		$this->heading_levels = array( '1', '2', '3', '4', '5', '6' );

		add_filter( 'the_content', array( &$this, 'the_content' ), 100 );
	}
	
	
	function __destruct() {}
	
	
	private function url_anchor_target( $title ) {
		$return = false;
		
		if ( $title ) {
			$return = trim( strip_tags( $title ) );

			$return = str_replace(
				array( "\r", "\n", "\n\r", "\r\n" ),
				' ',
				$return
			);
			
			$return = str_replace(
				'&amp;',
				'',
				$return
			);
			
			$return = preg_replace(
				'/[^a-zA-Z0-9 \-_]*/',
				'',
				$return
			);
			
			$return = str_replace(
				array( '  ', ' ' ),
				'-',
				$return
			);
			
			$return = rtrim( $return, '_-' );
			
			$return = strtolower( $return );

			// if blank, then prepend with the fragment prefix
			// blank anchors normally appear on sites that don't use the latin charset
			if ( ! $return ) {
				$return = 'i';
			}
		}
		
		if ( array_key_exists( $return, $this->collision_collector ) ) {
			$this->collision_collector[$return]++;
			$return .= '-' . $this->collision_collector[$return];
		} else {
			$this->collision_collector[$return] = 1;
		}

		return apply_filters( 'toc_url_anchor_target', $return );
	}
	
	
	private function build_hierarchy( &$matches ) {
		$current_depth = 100;
		$html = '';
		$numbered_items = array();
		$numbered_items_min = null;
		
		// reset the internal collision collection
		$this->collision_collector = array();
		
		// find the minimum heading to establish our baseline
		for ( $i = 0; $i < count( $matches ); $i++ ) {
			if ( $current_depth > $matches[$i][2] ) {
				$current_depth = (int) $matches[$i][2];
			}
		}
		
		$numbered_items[$current_depth] = 0;
		$numbered_items_min = $current_depth;

		for ( $i = 0; $i < count( $matches ); $i++ ) {

			if ( $current_depth === (int) $matches[$i][2] ) {
				$html .= '<li>';
			}
				
		
			// start lists
			if ( $current_depth !== (int) $matches[$i][2] ) {
				for (
					$current_depth;
					$current_depth < (int) $matches[$i][2];
					$current_depth++
				) {
					$numbered_items[$current_depth + 1] = 0;
					$html .= '<ol><li>';
				}
			}
			
			// list item
			if ( in_array( $matches[$i][2], $this->heading_levels ) ) {
				$html .= '<a href="#' . $this->url_anchor_target( $matches[$i][0] ) . '">';
				$html .= strip_tags( $matches[$i][0] ) . '</a>';
			}
			
			
			// end lists
			if ( $i !== count( $matches ) - 1 ) {
				if ( $current_depth > (int) $matches[$i + 1][2] ) {
					for (
						$current_depth;
						$current_depth > (int) $matches[$i + 1][2];
						$current_depth--
					) {
						$html .= '</li></ol>';
						$numbered_items[$current_depth] = 0;
					}
				}
				
				if ( $current_depth === (int) @$matches[$i + 1][2] ) {
					$html .= '</li>';
				}
			} else {
				for (
					$current_depth;
					$current_depth >= $numbered_items_min;
					$current_depth--
				) {
					$html .= '</li>';
					if ( $current_depth !== $numbered_items_min ) {
						$html .= '</ol>';
					}
				}
			}
		}

		return $html;
	}
	

	private function mb_find_replace(
		&$find = false,
		&$replace = false,
		&$string = ''
	) {
		if ( is_array( $find ) && is_array( $replace ) && $string ) {
			if ( function_exists( 'mb_strpos' ) ) {
				for ( $i = 0; $i < count( $find ); $i++ ) {
					$string = mb_substr( $string, 0, mb_strpos( $string, $find[$i]) ) . $replace[$i] . mb_substr( $string, mb_strpos( $string, $find[$i]) + mb_strlen( $find[$i]) );
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
		
		$this->collision_collector = array();
		
		if ( is_array( $find ) && is_array( $replace ) && $content ) {
			if ( preg_match_all( '/(<h([1-6]{1})[^>]*>).*<\/h\2>/msuU', $content, $matches, PREG_SET_ORDER ) ) {

				$new_matches = array();
				for ( $i = 0; $i < count( $matches ); $i++) {
					if ( trim( strip_tags( $matches[$i][0] ) ) !== false ) {
						$new_matches[] = $matches[$i];
					}
				}
				if ( count( $matches ) !== count( $new_matches ) ) {
					$matches = $new_matches;
				}
					

				if ( count( $matches ) >= 4 ) {

					for ( $i = 0; $i < count( $matches ); $i++ ) {
						$anchor = $this->url_anchor_target( $matches[$i][0] );
						$find[] = $matches[$i][0];
						$replace[] = str_replace(
							array(
								$matches[$i][1],
								'</h' . $matches[$i][2] . '>'
							),
							array(
								$matches[$i][1] . "<span id=\"{$anchor}\">",
								'</span></h' . $matches[$i][2] . '>'
							),
							$matches[$i][0]
						);

						$items .= '<li><a href="#' . $anchor . '">';
						$items .= strip_tags( $matches[$i][0]) . '</a></li>';
					}

					$items = $this->build_hierarchy( $matches );
					
				}
			}
		}
		
		return $items;
	}
	
	

	public function is_eligible( $shortcode_used = false ) {
		global $post;

		if ( is_feed() ) return false;
		
		if ( $shortcode_used !== false ) {
			if ( is_front_page() ) return false;
			else return true;
		}
		else {
			if (
				( ! in_array( get_post_type( $post ), $this->exclude_post_types ) && ! is_search() && ! is_archive() && ! is_front_page() ) || 
				( is_front_page() )
			) {
				return true;
			} else return false;
		}
	}

	
	function the_content( $content ) {
		$items = '';
		$find = array();
		$custom_toc_position = strpos( $content, '<!--TOC-->' );
		$replace = array();
		if ( $this->is_eligible( $custom_toc_position ) ) {
			$items = $this->extract_headings( $find, $replace, $content );

			if ( $items ) {
				$html = <<< EOT
<ul id="js--toc" class="toc accordion" data-accordion>
	<li class="accordion-item" data-accordion-item>
		<a href="#" class="accordion-title">目次</a>
		<div class="accordion-content" data-tab-content><ol id="js--toc-list">$items</ol></div>
	</li>
</ul>
EOT;
				if ( $custom_toc_position !== false ) {
					$find[] = '<!--TOC-->';
					$replace[] = $html;
					$content = $this->mb_find_replace( $find, $replace, $content );
				} else {	
					if ( count( $find ) > 0 ) {
						$content = $html . $this->mb_find_replace( $find, $replace, $content );
					}
				}
			}
		} else {
			$content = str_replace( '<!--TOC-->', '', $content );
		}
	
		return $content;
	}
	
}
