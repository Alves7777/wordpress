<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Overwrite parent theme background defaults and registers support for WordPress features.
add_action( 'after_setup_theme', 'lalita_background_setup' );
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => 'eeeeee',
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
	return 'https://wpkoi.com/sakti-wpkoi-wordpress-theme/';
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
if ( ! function_exists( 'sakti_customize_register' ) ) {
	add_action( 'customize_register', 'sakti_customize_register' );
	function sakti_customize_register( $wp_customize ) {
				
		// Add Sakti customizer section
		$wp_customize->add_section(
			'sakti_layout_effects',
			array(
				'title' => __( 'Sakti Effects', 'sakti' ),
				'priority' => 24,
			)
		);
		
		// Navigation style
		$wp_customize->add_setting(
			'sakti_settings[nav_style]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'sakti_settings[nav_style]',
			array(
				'type' => 'select',
				'label' => __( 'Sakti navigation style', 'sakti' ),
				'choices' => array(
					'enable' => __( 'Enable', 'sakti' ),
					'disable' => __( 'Disable', 'sakti' )
				),
				'settings' => 'sakti_settings[nav_style]',
				'section' => 'sakti_layout_effects',
				'priority' => 3
			)
		);
		
		// Blog image border
		$wp_customize->add_setting(
			'sakti_settings[blog_img_border]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'sakti_settings[blog_img_border]',
			array(
				'type' => 'select',
				'label' => __( 'Blog image border', 'sakti' ),
				'choices' => array(
					'enable' => __( 'Enable', 'sakti' ),
					'disable' => __( 'Disable', 'sakti' )
				),
				'settings' => 'sakti_settings[blog_img_border]',
				'section' => 'sakti_layout_effects',
				'priority' => 2
			)
		);
		
		// Nicescroll
		$wp_customize->add_setting(
			'sakti_settings[nicescroll]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'sakti_settings[nicescroll]',
			array(
				'type' => 'select',
				'label' => __( 'Sakti scrollbar style', 'sakti' ),
				'choices' => array(
					'enable' => __( 'Enable', 'sakti' ),
					'disable' => __( 'Disable', 'sakti' )
				),
				'settings' => 'sakti_settings[nicescroll]',
				'section' => 'sakti_layout_effects',
				'priority' => 8
			)
		);
		
		// Cursor image
		$wp_customize->add_setting(
			'sakti_settings[cursor_image]',
			array(
				'default' => 'enable',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_choices'
			)
		);

		$wp_customize->add_control(
			'sakti_settings[cursor_image]',
			array(
				'type' => 'select',
				'label' => __( 'Cursor image', 'sakti' ),
				'choices' => array(
					'enable' => __( 'Enable', 'sakti' ),
					'disable' => __( 'Disable', 'sakti' )
				),
				'settings' => 'sakti_settings[cursor_image]',
				'section' => 'sakti_layout_effects',
				'priority' => 9
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[def_cursor_image]',
			array(
				'default' => '',
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'sakti_settings[def_cursor_image]',
				array(
					'label' => __( 'Default cursor image', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'priority' => 10,
					'settings' => 'sakti_settings[def_cursor_image]',
					'description' => __( 'Recommended size: 32*32px. Big image won`t work.', 'sakti' )
				)
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[pointer_cursor_image]',
			array(
				'default' => '',
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'sakti_settings[pointer_cursor_image]',
				array(
					'label' => __( 'Pointer cursor image', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'priority' => 11,
					'settings' => 'sakti_settings[pointer_cursor_image]',
					'description' => __( 'Recommended size: 32*32px. Big image won`t work.', 'sakti' )
				)
			)
		);
		
		// Navigation effect colors
		$wp_customize->add_setting(
			'sakti_settings[sakti_color_1]', array(
				'default' => '#FC440F',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sakti_settings[sakti_color_1]',
				array(
					'label' => __( 'Color 1 for Sakti effects', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'settings' => 'sakti_settings[sakti_color_1]',
					'priority' => 31
				)
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[sakti_color_2]', array(
				'default' => '#F9CB40',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sakti_settings[sakti_color_2]',
				array(
					'label' => __( 'Color 2 for Sakti effects', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'settings' => 'sakti_settings[sakti_color_2]',
					'priority' => 32
				)
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[sakti_color_3]', array(
				'default' => '#3590F3',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sakti_settings[sakti_color_3]',
				array(
					'label' => __( 'Color 3 for Sakti effects', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'settings' => 'sakti_settings[sakti_color_3]',
					'priority' => 33
				)
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[sakti_color_4]', array(
				'default' => '#222222',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sakti_settings[sakti_color_4]',
				array(
					'label' => __( 'Color 4 for Sakti effects', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'settings' => 'sakti_settings[sakti_color_4]',
					'priority' => 34
				)
			)
		);
		
		$wp_customize->add_setting(
			'sakti_settings[sakti_color_5]', array(
				'default' => '#eeeeee',
				'type' => 'option',
				'sanitize_callback' => 'sakti_sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sakti_settings[sakti_color_5]',
				array(
					'label' => __( 'Color 5 for Sakti effects', 'sakti' ),
					'section' => 'sakti_layout_effects',
					'settings' => 'sakti_settings[sakti_color_5]',
					'priority' => 35
				)
			)
		);
	}
}

//Sanitize choices.
if ( ! function_exists( 'sakti_sanitize_choices' ) ) {
	function sakti_sanitize_choices( $input, $setting ) {
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
if ( ! function_exists( 'sakti_sanitize_hex_color' ) ) {
	function sakti_sanitize_hex_color( $color ) {
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

// Sakti effects colors css
if ( ! function_exists( 'sakti_effect_colors_css' ) ) {
	function sakti_effect_colors_css() {
		// Get Customizer settings
		$sakti_settings = get_option( 'sakti_settings' );
		
		$sakti_color_1  	  = '#FC440F';
		$sakti_color_2  	  = '#F9CB40';
		$sakti_color_3  	  = '#3590F3';
		$sakti_color_4  	  = '#222222';
		$sakti_color_5  	  = '#eeeeee';
		$def_cursor_image  	  = '';
		$pointer_cursor_image = '';
		if ( isset( $sakti_settings['sakti_color_1'] ) ) {
			$sakti_color_1 = $sakti_settings['sakti_color_1'];
		}
		if ( isset( $sakti_settings['sakti_color_2'] ) ) {
			$sakti_color_2 = $sakti_settings['sakti_color_2'];
		}
		if ( isset( $sakti_settings['sakti_color_3'] ) ) {
			$sakti_color_3 = $sakti_settings['sakti_color_3'];
		}
		if ( isset( $sakti_settings['sakti_color_4'] ) ) {
			$sakti_color_4 = $sakti_settings['sakti_color_4'];
		}
		if ( isset( $sakti_settings['sakti_color_5'] ) ) {
			$sakti_color_5 = $sakti_settings['sakti_color_5'];
		}
		if ( isset( $sakti_settings['def_cursor_image'] ) ) {
			$def_cursor_image = $sakti_settings['def_cursor_image'];
		}
		if ( isset( $sakti_settings['pointer_cursor_image'] ) ) {
			$pointer_cursor_image = $sakti_settings['pointer_cursor_image'];
		}
		
		$sakti_navcolors = '.sakti-nav-style .main-navigation .main-nav ul li:before {background: ' . esc_attr( $sakti_color_1 ) . '}.sakti-nav-style .main-navigation .main-nav ul li:nth-child(2):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(5):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(8):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(11):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(14):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(17):before {background: ' . esc_attr( $sakti_color_2 ) . ';}.sakti-nav-style .main-navigation .main-nav ul li:nth-child(3):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(6):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(9):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(12):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(15):before, .sakti-nav-style .main-navigation .main-nav ul li:nth-child(18):before {background: ' . esc_attr( $sakti_color_3 ) . ';}.sakti-nav-style .main-navigation .main-nav ul li a, .sakti-nav-style .menu-toggle {color: ' . esc_attr( $sakti_color_4 ) . ';}.sakti-nav-style .main-navigation .main-nav ul li[class*="current-menu-"] > a:hover, .sakti-nav-style .main-navigation .main-nav ul li[class*="current-menu-"].sfHover > a, .sakti-nav-style .main-navigation .main-nav ul li[class*="current-menu-"] > a, .sakti-nav-style .main-navigation .main-nav ul li:hover > a, .sakti-nav-style .main-navigation .main-nav ul li:focus > a, .sakti-nav-style .main-navigation .main-nav ul li.sfHover > a, .sakti-nav-style .menu-toggle {color: ' . esc_attr( $sakti_color_5 ) . ';}.sakti-scrollbar-style::-webkit-scrollbar-track {background: ' . esc_attr( $sakti_color_4 ) . ';}.sakti-scrollbar-style::-webkit-scrollbar-thumb {background: ' . esc_attr( $sakti_color_2 ) . ';border: 1px solid ' . esc_attr( $sakti_color_4 ) . ';}.sakti-scrollbar-style::-webkit-scrollbar-thumb:hover {background: ' . esc_attr( $sakti_color_1 ) . ';}.sakti-blog-img-border .post-image img {border-color: ' . esc_attr( $sakti_color_1 ) . '}.sakti-blog-img-border article:nth-child(2) .post-image img, .sakti-blog-img-border article:nth-child(5) .post-image img, .sakti-blog-img-border article:nth-child(8) .post-image img, .sakti-blog-img-border article:nth-child(11) .post-image img, .sakti-blog-img-border article:nth-child(14) .post-image img, .sakti-blog-img-border article:nth-child(17) .post-image img, .sakti-blog-img-border article:nth-child(20) .post-image img{border-color: ' . esc_attr( $sakti_color_2 ) . '}.sakti-blog-img-border article:nth-child(3) .post-image img, .sakti-blog-img-border article:nth-child(6) .post-image img, .sakti-blog-img-border article:nth-child(9) .post-image img, .sakti-blog-img-border article:nth-child(12) .post-image img, .sakti-blog-img-border article:nth-child(15) .post-image img, .sakti-blog-img-border article:nth-child(18) .post-image img, .sakti-blog-img-border article:nth-child(21) .post-image img{border-color: ' . esc_attr( $sakti_color_3 ) . '} ';
		
		if ( $def_cursor_image != '' ) {
			$sakti_navcolors .= 'body.sakti-cursor-image{cursor: url(' . esc_url( $def_cursor_image ) . '), auto; }';
		}
		if ( $pointer_cursor_image != '' ) {
			$sakti_navcolors .= '.sakti-cursor-image a, .sakti-cursor-image input[type="submit"]:hover {cursor: url(' . esc_url( $pointer_cursor_image ) . '), auto; }';
		}
		
		return $sakti_navcolors;
	}
}


// The dynamic styles of the parent theme added inline to the parent stylesheet.
// For the customizer functions it is better to enqueue after the child theme stylesheet.
if ( ! function_exists( 'sakti_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'sakti_remove_parent_dynamic_css' );
	function sakti_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

// Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
if ( ! function_exists( 'sakti_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'sakti_enqueue_parent_dynamic_css', 50 );
	function sakti_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css() .sakti_effect_colors_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

//Adds custom classes to the array of body classes.
if ( ! function_exists( 'sakti_body_classes' ) ) {
	add_filter( 'body_class', 'sakti_body_classes' );
	function sakti_body_classes( $classes ) {
		// Get Customizer settings
		$sakti_settings = get_option( 'sakti_settings' );
		
		$blog_img_border = 'enable';
		$nav_style  	 = 'enable';
		$nicescroll  	 = 'enable';
		$cursor_image	 = 'enable';
		
		if ( isset( $sakti_settings['blog_img_border'] ) ) {
			$blog_img_border = $sakti_settings['blog_img_border'];
		}
		
		if ( isset( $sakti_settings['nav_style'] ) ) {
			$nav_style = $sakti_settings['nav_style'];
		}
		
		if ( isset( $sakti_settings['nicescroll'] ) ) {
			$nicescroll = $sakti_settings['nicescroll'];
		}
		
		if ( isset( $sakti_settings['cursor_image'] ) ) {
			$cursor_image = $sakti_settings['cursor_image'];
		}
		
		// Blog image border
		if ( $blog_img_border != 'disable' ) {
			$classes[] = 'sakti-blog-img-border';
		}
		
		// Navigation style
		if ( $nav_style != 'disable' ) {
			$classes[] = 'sakti-nav-style';
		}
		
		// Scrollbar style function
		if ( $nicescroll != 'disable' ) {
			$classes[] = 'sakti-scrollbar-style';
		}
		
		// Cursor Image
		if ( $cursor_image != 'disable' ) {
			$classes[] = 'sakti-cursor-image';
		}
		
		return $classes;
	}
}