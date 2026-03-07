<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Bara laterală', 'usm-theme' ); ?>">

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

    <?php else : ?>

        <!-- Widget implicit: Căutare -->
        <section class="widget widget_search">
            <h3 class="widget-title"><?php esc_html_e( 'Căutare', 'usm-theme' ); ?></h3>
            <?php get_search_form(); ?>
        </section>

        <!-- Widget implicit: Categorii -->
        <section class="widget widget_categories">
            <h3 class="widget-title"><?php esc_html_e( 'Categorii', 'usm-theme' ); ?></h3>
            <ul>
                <?php
                wp_list_categories( array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'show_count' => true,
                    'title_li'   => '',
                    'number'     => 10,
                ) );
                ?>
            </ul>
        </section>

        <!-- Widget implicit: Postări recente -->
        <section class="widget widget_recent_entries">
            <h3 class="widget-title"><?php esc_html_e( 'Postări recente', 'usm-theme' ); ?></h3>
            <ul>
                <?php
                $recent = wp_get_recent_posts( array(
                    'numberposts' => 5,
                    'post_status' => 'publish',
                ) );
                foreach ( $recent as $r ) : ?>
                    <li>
                        <a href="<?php echo esc_url( get_permalink( $r['ID'] ) ); ?>">
                            <?php echo esc_html( $r['post_title'] ); ?>
                        </a>
                        <br>
                        <small style="color:var(--text-light); font-family:var(--font-ui);">
                            <?php echo esc_html( mysql2date( get_option( 'date_format' ), $r['post_date'] ) ); ?>
                        </small>
                    </li>
                <?php endforeach; wp_reset_postdata(); ?>
            </ul>
        </section>

        <!-- Widget implicit: Arhive -->
        <section class="widget widget_archive">
            <h3 class="widget-title"><?php esc_html_e( 'Arhive', 'usm-theme' ); ?></h3>
            <ul>
                <?php
                wp_get_archives( array(
                    'type'            => 'monthly',
                    'show_post_count' => true,
                    'limit'           => 12,
                ) );
                ?>
            </ul>
        </section>

        <!-- Widget implicit: Etichete -->
        <section class="widget widget_tag_cloud">
            <h3 class="widget-title"><?php esc_html_e( 'Etichete', 'usm-theme' ); ?></h3>
            <?php
            wp_tag_cloud( array(
                'smallest' => 12,
                'largest'  => 20,
                'unit'     => 'px',
                'number'   => 25,
                'orderby'  => 'count',
                'order'    => 'DESC',
            ) );
            ?>
        </section>

    <?php endif; ?>

</aside><!-- #secondary -->
