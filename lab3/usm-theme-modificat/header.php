<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="screen-reader-text" href="#primary"><?php esc_html_e( 'Treci la conținut', 'usm-theme' ); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div class="header-inner">

            <div class="site-branding">
                <?php if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php
                $usm_description = get_bloginfo( 'description', 'display' );
                if ( $usm_description || is_customize_preview() ) : ?>
                    <p class="site-description"><?php echo esc_html( $usm_description ); ?></p>
                <?php endif; ?>
            </div>

            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Meniu principal', 'usm-theme' ); ?>">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'usm_fallback_menu',
                ) );
                ?>
            </nav>

            <span class="usm-badge">USM</span>

        </div>
    </header>

    <div id="content" class="site-content">
