<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Overwrite parent theme background defaults and registers support for WordPress features.
add_action( 'after_setup_theme', 'lalita_background_setup' );
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => 'ffd64a',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'auto',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		)
	);
}

// Overwrite theme URL
function lalita_theme_uri_link() {
	return 'https://wpkoi.com/manas-wpkoi-wordpress-theme/';
}

// Overwrite parent theme's blog header function
add_action( 'lalita_after_header', 'lalita_blog_header_image', 11 );
function lalita_blog_header_image() {

	if ( ( is_front_page() && is_home() ) || ( is_home() ) ) { 
		$blog_header_image 			=  lalita_get_setting( 'blog_header_image' ); 
		$blog_header_title 			=  lalita_get_setting( 'blog_header_title' ); 
		$blog_header_text 			=  lalita_get_setting( 'blog_header_text' ); 
		$blog_header_button_text 	=  lalita_get_setting( 'blog_header_button_text' ); 
		$blog_header_button_url 	=  lalita_get_setting( 'blog_header_button_url' ); 
		if ( $blog_header_image != '' ) { ?>
		<div class="page-header-image grid-parent page-header-blog" style="background-image: url('<?php echo esc_url($blog_header_image); ?>') !important;">
        	<div class="page-header-noiseoverlay"></div>
        	<div class="page-header-blog-inner">
                <div class="page-header-blog-content-h grid-container">
                    <div class="page-header-blog-content">
                    <?php if ( $blog_header_title != '' ) { ?>
                        <div class="page-header-blog-text">
                            <?php if ( $blog_header_title != '' ) { ?>
                            <h2><?php echo wp_kses_post( $blog_header_title ); ?></h2>
                            <div class="clearfix"></div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="page-header-blog-content page-header-blog-content-b">
                	<?php if ( $blog_header_text != '' ) { ?>
                	<div class="page-header-blog-text">
						<?php if ( $blog_header_title != '' ) { ?>
                        <p><?php echo wp_kses_post( $blog_header_text ); ?></p>
                        <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="page-header-blog-button">
                        <?php if ( $blog_header_button_text != '' ) { ?>
                        <a class="read-more button" href="<?php echo esc_url( $blog_header_button_url ); ?>"><?php echo esc_html( $blog_header_button_text ); ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
		</div>
		<?php
		}
	}
}

// Extra cutomizer functions
if ( ! function_exists( 'manas_customize_register' ) ) {
	add_action( 'customize_register', 'manas_customize_register' );
	function manas_customize_register( $wp_customize ) {
				
		// Add Manas customizer section
		$wp_customize->add_section(
			'manas_layout_effects',
			array(
				'title' => __( 'Manas Effects', 'manas' ),
				'priority' => 24,
			)
		);
		
		
		// Extra borders
		$wp_customize->add_setting(
			'manas_settings[extra_borders]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'manas_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'manas_settings[extra_borders]',
			array(
				'type' => 'select',
				'label' => __( 'Extra borders', 'manas' ),
				'choices' => array(
					'enable' => __( 'Enable', 'manas' ),
					'disable' => __( 'Disable', 'manas' )
				),
				'settings' => 'manas_settings[extra_borders]',
				'section' => 'manas_layout_effects',
				'priority' => 1
			)
		);
		
		// Manas border color
		$wp_customize->add_setting(
			'manas_settings[manas_color_1]', array(
				'default' => '#202020',
				'type' => 'option',
				'sanitize_callback' => 'manas_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'manas_settings[manas_color_1]',
				array(
					'label' => __( 'Border color', 'manas' ),
					'section' => 'manas_layout_effects',
					'settings' => 'manas_settings[manas_color_1]',
					'priority' => 5
				)
			)
		);
		
		// Corner radius
		$wp_customize->add_setting(
			'manas_settings[corner_radius]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'manas_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'manas_settings[corner_radius]',
			array(
				'type' => 'select',
				'label' => __( 'Corner radius', 'manas' ),
				'choices' => array(
					'enable' => __( 'Enable', 'manas' ),
					'disable' => __( 'Disable', 'manas' )
				),
				'settings' => 'manas_settings[corner_radius]',
				'section' => 'manas_layout_effects',
				'priority' => 10
			)
		);
		
		// Blog borders
		$wp_customize->add_setting(
			'manas_settings[blog_borders]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'manas_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'manas_settings[blog_borders]',
			array(
				'type' => 'select',
				'label' => __( 'Blog borders', 'manas' ),
				'choices' => array(
					'enable' => __( 'Enable', 'manas' ),
					'disable' => __( 'Disable', 'manas' )
				),
				'settings' => 'manas_settings[blog_borders]',
				'section' => 'manas_layout_effects',
				'priority' => 30
			)
		);
		
		// Navigation effect
		$wp_customize->add_setting(
			'manas_settings[manas_naveffect]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'manas_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'manas_settings[manas_naveffect]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation effect', 'manas' ),
				'choices' => array(
					'enable' => __( 'Enable', 'manas' ),
					'disable' => __( 'Disable', 'manas' )
				),
				'settings' => 'manas_settings[manas_naveffect]',
				'section' => 'manas_layout_effects',
				'priority' => 40
			)
		);
		
		
		
	}
}

//Sanitize choices.
if ( ! function_exists( 'manas_sanitize_choices' ) ) {
	function manas_sanitize_choices( $input, $setting ) {
		// Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control
		// associated with the setting
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it;
		// otherwise, return the default
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
}

// Sanitize colors. Allow blank value.
if ( ! function_exists( 'manas_sanitize_hex_color' ) ) {
	function manas_sanitize_hex_color( $color ) {
	    if ( '' === $color ) {
	        return '';
		}

	    // 3 or 6 hex digits, or the empty string.
	    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
	        return $color;
		}

	    return '';
	}
}

// Manas effects colors css
if ( ! function_exists( 'manas_effect_colors_css' ) ) {
	function manas_effect_colors_css() {
		// Get Customizer settings
		$manas_settings = get_option( 'manas_settings' );
		
		$manas_color_1  	 = '#202020';
		if ( isset( $manas_settings['manas_color_1'] ) ) {
			$manas_color_1 = $manas_settings['manas_color_1'];
		}
		
		$lalita_settings = wp_parse_args(
			get_option( 'lalita_settings', array() ),
			lalita_get_color_defaults()
		);
		
		$manas_extracolors = '.manas-extra-borders .lalita-side-padding-inside, .manas-extra-borders .site-header, .manas-extra-borders #footer-widgets, .manas-blog-borders .post-image img, .manas-blog-borders .inside-right-sidebar, .manas-blog-borders .inside-left-sidebar { border-color: ' . esc_attr( $manas_color_1 ) . ';}.manas-naveffect #site-navigation .main-nav ul li.menu-item a::after,.manas-naveffect #site-navigation .main-nav ul li.menu-item a::before {background-color: ' . esc_attr( $lalita_settings[ 'navigation_text_hover_color' ] ) . '}';
		
		return $manas_extracolors;
	}
}

// Add radius to header if top bar is empty
if ( ! function_exists( 'manas_border_radius_css' ) ) {
	function manas_border_radius_css() {
		
		$manas_radius = '';
		
		$top_bar_sidebar = is_active_sidebar( 'top-bar' ) ? true : false;
		$top_bar_socials = lalita_get_setting( 'socials_display_top' );
		if ( ( $top_bar_sidebar == true ) || ( $top_bar_socials == true ) ) {
			return;
		}
		
		$manas_radius .= '.manas-corner-radius .site-header {border-radius: 20px 20px 0 0;}';
		
		return $manas_radius;
	}
}

// The dynamic styles of the parent theme added inline to the parent stylesheet.
// For the customizer functions it is better to enqueue after the child theme stylesheet.
if ( ! function_exists( 'manas_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'manas_remove_parent_dynamic_css' );
	function manas_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

// Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
if ( ! function_exists( 'manas_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'manas_enqueue_parent_dynamic_css', 50 );
	function manas_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css() .manas_effect_colors_css() . manas_border_radius_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

//Adds custom classes to the array of body classes.
if ( ! function_exists( 'manas_body_classes' ) ) {
	add_filter( 'body_class', 'manas_body_classes' );
	function manas_body_classes( $classes ) {
		// Get Customizer settings
		$manas_settings = get_option( 'manas_settings' );
		
		$extra_borders 	  = 'enable';
		$manas_naveffect  = 'enable';
		$blog_borders  	  = 'enable';
		$corner_radius    = 'enable';
		
		if ( isset( $manas_settings['extra_borders'] ) ) {
			$extra_borders = $manas_settings['extra_borders'];
		}
		
		if ( isset( $manas_settings['manas_naveffect'] ) ) {
			$manas_naveffect = $manas_settings['manas_naveffect'];
		}
		
		if ( isset( $manas_settings['blog_borders'] ) ) {
			$blog_borders = $manas_settings['blog_borders'];
		}
		
		if ( isset( $manas_settings['corner_radius'] ) ) {
			$corner_radius = $manas_settings['corner_radius'];
		}
		
		// Extra borders
		if ( $extra_borders != 'disable' ) {
			$classes[] = 'manas-extra-borders';
		}
		
		// Navigation effect
		if ( $manas_naveffect != 'disable' ) {
			$classes[] = 'manas-naveffect';
		}
		
		// Blog borders
		if ( $blog_borders != 'disable' ) {
			$classes[] = 'manas-blog-borders';
		}
		
		// Corner radius
		if ( $corner_radius != 'disable' ) {
			$classes[] = 'manas-corner-radius';
		}
		
		return $classes;
	}
}
