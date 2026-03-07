<?php get_header(); ?>

<main id="primary" class="site-main" role="main">
    <div class="content-area no-sidebar">
        <div id="main-content">
            <div class="error-404 not-found">
                <h1>404</h1>
                <h2><?php esc_html_e( 'Pagina nu a fost găsită', 'usm-theme' ); ?></h2>
                <p><?php esc_html_e( 'Se pare că pagina pe care o cauți nu există sau a fost mutată. Verifică URL-ul sau întoarce-te la pagina principală.', 'usm-theme' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="read-more-btn">
                    <?php esc_html_e( '← Înapoi la pagina principală', 'usm-theme' ); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
