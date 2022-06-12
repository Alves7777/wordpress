<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Overwrite parent theme background defaults and registers support for WordPress features.
add_action( 'after_setup_theme', 'lalita_background_setup' );
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => 'ffffff',
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
	return 'https://wpkoi.com/madhura-wpkoi-wordpress-theme/';
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
if ( ! function_exists( 'madhura_customize_register' ) ) {
	add_action( 'customize_register', 'madhura_customize_register' );
	function madhura_customize_register( $wp_customize ) {
				
		// Add Madhura customizer section
		$wp_customize->add_section(
			'madhura_layout_effects',
			array(
				'title' => __( 'Madhura Effects', 'madhura' ),
				'priority' => 1,
				'panel' => 'lalita_layout_panel'
			)
		);
		
		// Top and bottom background
		$wp_customize->add_setting(
			'madhura_settings[top_bottom_bg]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'madhura_settings[top_bottom_bg]',
			array(
				'type' => 'select',
				'label' => __( 'Background for top and bottom', 'madhura' ),
				'choices' => array(
					'enable' => __( 'Enable', 'madhura' ),
					'disable' => __( 'Disable', 'madhura' )
				),
				'settings' => 'madhura_settings[top_bottom_bg]',
				'section' => 'madhura_layout_effects',
				'priority' => 1
			)
		);
		
		// Stroke to site title
		$wp_customize->add_setting(
			'madhura_settings[title_stroke]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'madhura_settings[title_stroke]',
			array(
				'type' => 'select',
				'label' => __( 'Title stroke', 'madhura' ),
				'choices' => array(
					'enable' => __( 'Enable', 'madhura' ),
					'disable' => __( 'Disable', 'madhura' )
				),
				'settings' => 'madhura_settings[title_stroke]',
				'section' => 'madhura_layout_effects',
				'priority' => 2
			)
		);
		
		// Navigation style
		$wp_customize->add_setting(
			'madhura_settings[nav_style]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'madhura_settings[nav_style]',
			array(
				'type' => 'select',
				'label' => __( 'Madhura navigation style', 'madhura' ),
				'choices' => array(
					'enable' => __( 'Enable', 'madhura' ),
					'disable' => __( 'Disable', 'madhura' )
				),
				'settings' => 'madhura_settings[nav_style]',
				'section' => 'madhura_layout_effects',
				'priority' => 3
			)
		);
		
		// Navigation effect colors
		$wp_customize->add_setting(
			'madhura_settings[madhura_color_1]', array(
				'default' => '#FF8BB8',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'madhura_settings[madhura_color_1]',
				array(
					'label' => __( 'Color 1 for navigation buttons', 'madhura' ),
					'section' => 'colors',
					'settings' => 'madhura_settings[madhura_color_1]',
					'priority' => 31
				)
			)
		);
		
		$wp_customize->add_setting(
			'madhura_settings[madhura_color_2]', array(
				'default' => '#5B8BEE',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'madhura_settings[madhura_color_2]',
				array(
					'label' => __( 'Color 2 for navigation buttons', 'madhura' ),
					'section' => 'colors',
					'settings' => 'madhura_settings[madhura_color_2]',
					'priority' => 32
				)
			)
		);
		
		$wp_customize->add_setting(
			'madhura_settings[madhura_color_3]', array(
				'default' => '#02F585',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'madhura_settings[madhura_color_3]',
				array(
					'label' => __( 'Color 3 for navigation buttons', 'madhura' ),
					'section' => 'colors',
					'settings' => 'madhura_settings[madhura_color_3]',
					'priority' => 33
				)
			)
		);
		
		// Nicescroll
		$wp_customize->add_setting(
			'madhura_settings[nicescroll]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'madhura_settings[nicescroll]',
			array(
				'type' => 'select',
				'label' => __( 'Madhura scrollbar style', 'madhura' ),
				'choices' => array(
					'enable' => __( 'Enable', 'madhura' ),
					'disable' => __( 'Disable', 'madhura' )
				),
				'settings' => 'madhura_settings[nicescroll]',
				'section' => 'madhura_layout_effects',
				'priority' => 8
			)
		);
		
		// Top bar scrolling text
		$wp_customize->add_setting(
			'madhura_settings[top_bar_scroll]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'madhura_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'madhura_settings[top_bar_scroll]',
			array(
				'type' => 'select',
				'label' => __( 'Top bar content scroll', 'madhura' ),
				'choices' => array(
					'enable' => __( 'Enable', 'madhura' ),
					'disable' => __( 'Disable', 'madhura' )
				),
				'settings' => 'madhura_settings[top_bar_scroll]',
				'section' => 'madhura_layout_effects',
				'priority' => 9
			)
		);
	}
}

//Sanitize choices.
if ( ! function_exists( 'madhura_sanitize_choices' ) ) {
	function madhura_sanitize_choices( $input, $setting ) {
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
if ( ! function_exists( 'madhura_sanitize_hex_color' ) ) {
	function madhura_sanitize_hex_color( $color ) {
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

// Navigation button colors css
if ( ! function_exists( 'madhura_nav_style_css' ) ) {
	function madhura_nav_style_css() {
		// Get Customizer settings
		$madhura_settings = get_option( 'madhura_settings' );
		
		$madhura_color_1  	 = '#FF8BB8';
		$madhura_color_2  	 = '#5B8BEE';
		$madhura_color_3  	 = '#02F585';
		if ( isset( $madhura_settings['madhura_color_1'] ) ) {
			$madhura_color_1 = $madhura_settings['madhura_color_1'];
		}
		if ( isset( $madhura_settings['madhura_color_2'] ) ) {
			$madhura_color_2 = $madhura_settings['madhura_color_2'];
		}
		if ( isset( $madhura_settings['madhura_color_3'] ) ) {
			$madhura_color_3 = $madhura_settings['madhura_color_3'];
		}
		
		$madhura_navcolors = '.madhura-nav-style .main-navigation .main-nav ul li:before {background: ' . esc_attr( $madhura_color_1 ) . ';box-shadow: 3px 5px 0px 0px ' . esc_attr( $madhura_color_2 ) . ';}.madhura-nav-style .main-navigation .main-nav ul li:hover:before{background: ' . esc_attr( $madhura_color_3 ) . '}.madhura-scrollbar-style::-webkit-scrollbar-thumb {background: ' . esc_attr( $madhura_color_1 ) . ';}.madhura-scrollbar-style::-webkit-scrollbar-thumb:hover {background: ' . esc_attr( $madhura_color_3 ) . ';}';
		
		return $madhura_navcolors;
	}
}


// The dynamic styles of the parent theme added inline to the parent stylesheet.
// For the customizer functions it is better to enqueue after the child theme stylesheet.
if ( ! function_exists( 'madhura_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'madhura_remove_parent_dynamic_css' );
	function madhura_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

// Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
if ( ! function_exists( 'madhura_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'madhura_enqueue_parent_dynamic_css', 50 );
	function madhura_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css() .madhura_nav_style_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

//Adds custom classes to the array of body classes.
if ( ! function_exists( 'madhura_body_classes' ) ) {
	add_filter( 'body_class', 'madhura_body_classes' );
	function madhura_body_classes( $classes ) {
		// Get Customizer settings
		$madhura_settings = get_option( 'madhura_settings' );
		
		$title_stroke  	 = 'enable';
		$nav_style  	 = 'enable';
		$nicescroll  	 = 'enable';
		$top_bar_scroll	 = 'enable';
		$top_bottom_bg	 = 'enable';
		
		if ( isset( $madhura_settings['title_stroke'] ) ) {
			$title_stroke = $madhura_settings['title_stroke'];
		}
		
		if ( isset( $madhura_settings['nav_style'] ) ) {
			$nav_style = $madhura_settings['nav_style'];
		}
		
		if ( isset( $madhura_settings['nicescroll'] ) ) {
			$nicescroll = $madhura_settings['nicescroll'];
		}
		
		if ( isset( $madhura_settings['top_bar_scroll'] ) ) {
			$top_bar_scroll = $madhura_settings['top_bar_scroll'];
		}
		
		if ( isset( $madhura_settings['top_bottom_bg'] ) ) {
			$top_bottom_bg = $madhura_settings['top_bottom_bg'];
		}
		
		// Title stroke
		if ( $title_stroke != 'disable' ) {
			$classes[] = 'madhura-title-stroke';
		}
		
		// Navigation style
		if ( $nav_style != 'disable' ) {
			$classes[] = 'madhura-nav-style';
		}
		
		// Scrollbar style function
		if ( $nicescroll != 'disable' ) {
			$classes[] = 'madhura-scrollbar-style';
		}
		
		// Top bar scroll function
		if ( $top_bar_scroll != 'disable' ) {
			$classes[] = 'madhura-top-bar-scroll';
		}
		
		// Top and bottom background
		if ( $top_bottom_bg != 'disable' ) {
			$classes[] = 'madhura-top-bottom-bg';
		}
		
		return $classes;
	}
}

// Enqueue scripts
if ( ! function_exists( 'madhura_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'madhura_scripts' );
	function madhura_scripts() {
		
		$madhura_settings = get_option( 'madhura_settings' );
		$top_bar_scroll		 = 'enable';
		if ( isset( $madhura_settings['top_bar_scroll'] ) ) {
			$top_bar_scroll = $madhura_settings['top_bar_scroll'];
		}
		
		if ( $top_bar_scroll != 'disable' ) {
			wp_enqueue_script( 'madhura-marquee', esc_url( get_stylesheet_directory_uri() ) . "/js/jquery.marquee.min.js", array( 'jquery'), LALITA_VERSION, true );
		}
			
	}
}
