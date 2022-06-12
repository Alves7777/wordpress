<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Overwrite parent theme background defaults and registers support for WordPress features.
add_action( 'after_setup_theme', 'lalita_background_setup' );
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => 'b2ceff',
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
	return 'https://wpkoi.com/samana-wpkoi-wordpress-theme/';
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
if ( ! function_exists( 'samana_customize_register' ) ) {
	add_action( 'customize_register', 'samana_customize_register' );
	function samana_customize_register( $wp_customize ) {
				
		// Add Samana customizer section
		$wp_customize->add_section(
			'samana_layout_effects',
			array(
				'title' => __( 'Samana Effects', 'samana' ),
				'priority' => 24,
			)
		);
		
		
		// Title effect
		$wp_customize->add_setting(
			'samana_settings[title_effect]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'samana_settings[title_effect]',
			array(
				'type' => 'select',
				'label' => __( 'Title effect', 'samana' ),
				'choices' => array(
					'enable' => __( 'Enable', 'samana' ),
					'disable' => __( 'Disable', 'samana' )
				),
				'settings' => 'samana_settings[title_effect]',
				'section' => 'samana_layout_effects',
				'priority' => 1
			)
		);
		
		// Top bar icons
		$wp_customize->add_setting(
			'samana_settings[top_bar_icons]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'samana_settings[top_bar_icons]',
			array(
				'type' => 'select',
				'label' => __( 'Top bar icons', 'samana' ),
				'choices' => array(
					'enable' => __( 'Enable', 'samana' ),
					'disable' => __( 'Disable', 'samana' )
				),
				'settings' => 'samana_settings[top_bar_icons]',
				'section' => 'samana_layout_effects',
				'priority' => 2
			)
		);
		
		// Blog image shadow
		$wp_customize->add_setting(
			'samana_settings[blog_image_shadow]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'samana_settings[blog_image_shadow]',
			array(
				'type' => 'select',
				'label' => __( 'Blog image shadow', 'samana' ),
				'choices' => array(
					'enable' => __( 'Enable', 'samana' ),
					'disable' => __( 'Disable', 'samana' )
				),
				'settings' => 'samana_settings[blog_image_shadow]',
				'section' => 'samana_layout_effects',
				'priority' => 3
			)
		);
		
		// Add navigation extra button text
		$wp_customize->add_setting(
			'samana_settings[nav_btn_text]',
			array(
				'default' => '',
				'type' => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'samana_settings[nav_btn_text]',
			array(
				'type' => 'text',
				'label' => __( 'Extra button text', 'samana' ),
				'section' => 'samana_layout_effects',
				'settings' => 'samana_settings[nav_btn_text]',
				'priority' => 25
			)
		);
		
		// Add navigation extra button url
		$wp_customize->add_setting(
			'samana_settings[nav_btn_url]',
			array(
				'default' => '',
				'type' => 'option',
				'sanitize_callback' => 'esc_url'
			)
		);

		$wp_customize->add_control(
			'samana_settings[nav_btn_url]',
			array(
				'type' => 'text',
				'label' => __( 'Extra button URL', 'samana' ),
				'section' => 'samana_layout_effects',
				'settings' => 'samana_settings[nav_btn_url]',
				'priority' => 25
			)
		);
		
		// Samana effect colors
		$wp_customize->add_setting(
			'samana_settings[samana_color_1]', array(
				'default' => '#FFD507',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'samana_settings[samana_color_1]',
				array(
					'label' => __( 'Color 1 for Saman effects', 'samana' ),
					'section' => 'colors',
					'settings' => 'samana_settings[samana_color_1]',
					'priority' => 31
				)
			)
		);
		
		$wp_customize->add_setting(
			'samana_settings[samana_color_2]', array(
				'default' => '#F1757B',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'samana_settings[samana_color_2]',
				array(
					'label' => __( 'Color 2 for Saman effects', 'samana' ),
					'section' => 'colors',
					'settings' => 'samana_settings[samana_color_2]',
					'priority' => 32
				)
			)
		);
		
		$wp_customize->add_setting(
			'samana_settings[samana_color_3]', array(
				'default' => '#8ADD45',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'samana_settings[samana_color_3]',
				array(
					'label' => __( 'Color 3 for Saman effects', 'samana' ),
					'section' => 'colors',
					'settings' => 'samana_settings[samana_color_3]',
					'priority' => 33
				)
			)
		);
		
		$wp_customize->add_setting(
			'samana_settings[samana_color_4]', array(
				'default' => '#DB242B',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'samana_settings[samana_color_4]',
				array(
					'label' => __( 'Color 4 for Saman effects', 'samana' ),
					'section' => 'colors',
					'settings' => 'samana_settings[samana_color_4]',
					'priority' => 34
				)
			)
		);
		
		$wp_customize->add_setting(
			'samana_settings[samana_color_5]', array(
				'default' => '#6775C3',
				'type' => 'option',
				'sanitize_callback' => 'samana_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'samana_settings[samana_color_5]',
				array(
					'label' => __( 'Color 5 for Saman effects', 'samana' ),
					'section' => 'colors',
					'settings' => 'samana_settings[samana_color_5]',
					'priority' => 35
				)
			)
		);
		
	}
}

//Sanitize choices.
if ( ! function_exists( 'samana_sanitize_choices' ) ) {
	function samana_sanitize_choices( $input, $setting ) {
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
if ( ! function_exists( 'samana_sanitize_hex_color' ) ) {
	function samana_sanitize_hex_color( $color ) {
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

// Samana extra colors
if ( ! function_exists( 'samana_extra_colors_css' ) ) {
	function samana_extra_colors_css() {
		// Get Customizer settings
		$samana_settings = get_option( 'samana_settings' );
		
		$samana_color_1  	 = '#FFD507';
		$samana_color_2  	 = '#F1757B';
		$samana_color_3  	 = '#8ADD45';
		$samana_color_4  	 = '#DB242B';
		$samana_color_5  	 = '#6775C3';
		if ( isset( $samana_settings['samana_color_1'] ) ) {
			$samana_color_1 = $samana_settings['samana_color_1'];
		}
		if ( isset( $samana_settings['samana_color_2'] ) ) {
			$samana_color_2 = $samana_settings['samana_color_2'];
		}
		if ( isset( $samana_settings['samana_color_3'] ) ) {
			$samana_color_3 = $samana_settings['samana_color_3'];
		}
		if ( isset( $samana_settings['samana_color_4'] ) ) {
			$samana_color_4 = $samana_settings['samana_color_4'];
		}
		if ( isset( $samana_settings['samana_color_5'] ) ) {
			$samana_color_5 = $samana_settings['samana_color_5'];
		}
		
		$samana_extracolors = '.samana-title-effect .site-branding { box-shadow: 7px 7px 0px 0px ' . esc_attr( $samana_color_1 ) . ';}.samana-title-effect .main-title {background: ' . esc_attr( $samana_color_1 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(6) {box-shadow: 2px 2px 0px 0px ' . esc_attr( $samana_color_1 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li a, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(6) a {background: ' . esc_attr( $samana_color_1 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(2), .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(7) {box-shadow: 2px 2px 0px 0px ' . esc_attr( $samana_color_2 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(2) a, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(7) a {background: ' . esc_attr( $samana_color_2 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(3), .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(8) {box-shadow: 2px 2px 0px 0px ' . esc_attr( $samana_color_3 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(3) a, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(8) a {background: ' . esc_attr( $samana_color_3 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(4), .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(9) {box-shadow: 2px 2px 0px 0px ' . esc_attr( $samana_color_4 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(4) a, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(9) a {background: ' . esc_attr( $samana_color_4 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(5), .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(10) {box-shadow: 2px 2px 0px 0px ' . esc_attr( $samana_color_5 ) . ';}.samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(5) a, .samana-top-bar-icons .top-bar .lalita-socials-list li:nth-child(10) a {background: ' . esc_attr( $samana_color_5 ) . ';}header .main-navigation .nav-btn-border { box-shadow: 5px 5px 0px 0px ' . esc_attr( $samana_color_3 ) . ';}header .main-navigation .main-nav ul li a.wpkoi-nav-btn, .main-navigation.toggled .main-nav li.wpkoi-nav-btn-h .wpkoi-nav-btn {background-color: ' . esc_attr( $samana_color_3 ) . ' !important;}.samana-blog-image-shadow.blog article .post-image img, .samana-blog-image-shadow.blog article:nth-child(6) .post-image img, .samana-blog-image-shadow.blog article:nth-child(11) .post-image img {box-shadow: 8px 8px 0px 0px ' . esc_attr( $samana_color_1 ) . ';}.samana-blog-image-shadow.blog article:nth-child(2) .post-image img, .samana-blog-image-shadow.blog article:nth-child(7) .post-image img, .samana-blog-image-shadow.blog article:nth-child(12) .post-image img {box-shadow: 8px 8px 0px 0px ' . esc_attr( $samana_color_2 ) . ';}.samana-blog-image-shadow.blog article:nth-child(3) .post-image img, .samana-blog-image-shadow.blog article:nth-child(8) .post-image img, .samana-blog-image-shadow.blog article:nth-child(13) .post-image img {box-shadow: 8px 8px 0px 0px ' . esc_attr( $samana_color_3 ) . ';}.samana-blog-image-shadow.blog article:nth-child(4) .post-image img, .samana-blog-image-shadow.blog article:nth-child(9) .post-image img, .samana-blog-image-shadow.blog article:nth-child(14) .post-image img {box-shadow: 8px 8px 0px 0px ' . esc_attr( $samana_color_4 ) . ';}.samana-blog-image-shadow.blog article:nth-child(5) .post-image img, .samana-blog-image-shadow.blog article:nth-child(10) .post-image img, .samana-blog-image-shadow.blog article:nth-child(15) .post-image img {box-shadow: 8px 8px 0px 0px ' . esc_attr( $samana_color_5 ) . ';}';

		return $samana_extracolors;
	}
}


// The dynamic styles of the parent theme added inline to the parent stylesheet.
// For the customizer functions it is better to enqueue after the child theme stylesheet.
if ( ! function_exists( 'samana_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'samana_remove_parent_dynamic_css' );
	function samana_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

// Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
if ( ! function_exists( 'samana_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'samana_enqueue_parent_dynamic_css', 50 );
	function samana_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css() .samana_extra_colors_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

//Adds custom classes to the array of body classes.
if ( ! function_exists( 'samana_body_classes' ) ) {
	add_filter( 'body_class', 'samana_body_classes' );
	function samana_body_classes( $classes ) {
		// Get Customizer settings
		$samana_settings = get_option( 'samana_settings' );
		
		$title_effect 	    = 'enable';
		$top_bar_icons		= 'enable';
		$blog_image_shadow  = 'enable';
		
		if ( isset( $samana_settings['title_effect'] ) ) {
			$title_effect = $samana_settings['title_effect'];
		}
		
		if ( isset( $samana_settings['top_bar_icons'] ) ) {
			$top_bar_icons = $samana_settings['top_bar_icons'];
		}
		
		// Title effect
		if ( $title_effect != 'disable' ) {
			$classes[] = 'samana-title-effect';
		}
		
		// Top bar icons
		if ( $top_bar_icons != 'disable' ) {
			$classes[] = 'samana-top-bar-icons';
		}
		
		// Blog image shadow
		if ( $blog_image_shadow != 'disable' ) {
			$classes[] = 'samana-blog-image-shadow';
		}
		
		return $classes;
	}
}

if ( ! function_exists( 'samana_navigation_button' ) ) {
	add_filter( 'wp_nav_menu_items', 'samana_navigation_button', 11, 2 );
	/**
	 * Add the extra button to the navigation.
	 *
	 */
	function samana_navigation_button( $nav, $args ) {
		// Get Customizer settings
		$samana_settings = get_option( 'samana_settings' );
		
		// If our primary menu is set, add the extra button.
		if ( ( isset( $samana_settings['nav_btn_url'] ) ) && ( isset( $samana_settings['nav_btn_text'] ) ) && ( isset( $args->theme_location ) ) ) {
			if ( ( $args->theme_location == 'primary' ) && ( $samana_settings['nav_btn_url'] != '' ) ) {
				return $nav . '<li class="wpkoi-nav-btn-h"><div class="nav-btn-border"><a class="wpkoi-nav-btn button" href="' . esc_url( $samana_settings['nav_btn_url'] ) . '">' . esc_html( $samana_settings['nav_btn_text'] ) . '</a></div></li>';
			}
		}
		
	    return $nav;
	}
}