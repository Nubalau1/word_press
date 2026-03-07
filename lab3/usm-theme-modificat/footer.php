    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="footer-widgets">

            <div class="footer-widget">
                <h3><?php bloginfo( 'name' ); ?></h3>
                <p><?php bloginfo( 'description' ); ?></p>
                <p style="margin-top:12px; font-size:0.85rem; color:rgba(255,255,255,0.5);">
                    <?php esc_html_e( 'Temă creată ca lucrare de laborator nr. 3 la Universitatea de Stat din Moldova.', 'usm-theme' ); ?>
                </p>
            </div>

            <div class="footer-widget">
                <h3><?php esc_html_e( 'Navigare', 'usm-theme' ); ?></h3>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_class'     => '',
                    'container'      => false,
                    'depth'          => 1,
                    'fallback_cb'    => false,
                ) );
                ?>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Pagina principală', 'usm-theme' ); ?></a></li>
                    <?php if ( get_option( 'show_on_front' ) === 'posts' ) : ?>
                        <li><a href="<?php echo esc_url( home_url( '/?page_id=' . get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Blog', 'usm-theme' ); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Politica de confidențialitate', 'usm-theme' ); ?></a></li>
                </ul>
            </div>

            <div class="footer-widget">
                <h3><?php esc_html_e( 'Postări recente', 'usm-theme' ); ?></h3>
                <?php
                $recent_posts = wp_get_recent_posts( array(
                    'numberposts' => 5,
                    'post_status' => 'publish',
                ) );
                if ( $recent_posts ) :
                ?>
                    <ul>
                        <?php foreach ( $recent_posts as $post ) : ?>
                            <li>
                                <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
                                    <?php echo esc_html( $post['post_title'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>

        </div><!-- .footer-widgets -->

        <div class="site-info">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                &mdash;
                <?php
                printf(
                    /* translators: %s: WordPress link */
                    esc_html__( 'Temă dezvoltată pe %s', 'usm-theme' ),
                    '<a href="https://wordpress.org" target="_blank" rel="noopener">WordPress</a>'
                );
                ?>
                &nbsp;|&nbsp;
                <?php esc_html_e( 'Lucrare de laborator nr. 3 &mdash; USM Theme', 'usm-theme' ); ?>
            </p>
        </div>

    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
