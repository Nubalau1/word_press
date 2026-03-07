<?php get_header(); ?>

<main id="primary" class="site-main" role="main">
    <div class="content-area">

        <div id="main-content">
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'usm-hero', array( 'class' => 'post-featured-image', 'alt' => get_the_title() ) ); ?>
                    <?php endif; ?>

                    <div class="single-post-header">
                        <h1 class="entry-title" style="font-size:2.2rem; margin-bottom:14px;">
                            <?php the_title(); ?>
                        </h1>
                        <div class="entry-meta">
                            <span class="meta-item">
                                <?php
                                printf(
                                    esc_html__( 'Actualizat: %s', 'usm-theme' ),
                                    esc_html( get_the_modified_date() )
                                );
                                ?>
                            </span>
                        </div>
                    </div>

                    <div class="single-post-body">

                        <div class="entry-content">
                            <?php
                            the_content();
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pagini:', 'usm-theme' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div>

                        <footer class="entry-footer" style="margin-top:24px; padding-top:16px; border-top:1px solid var(--border-color);">
                            <?php
                            edit_post_link(
                                esc_html__( 'Editează pagina', 'usm-theme' ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>

                    </div><!-- .single-post-body -->

                </article>

                <!-- Subpagini (dacă există) -->
                <?php
                $child_pages = get_pages( array(
                    'parent'      => get_the_ID(),
                    'sort_column' => 'menu_order',
                ) );
                if ( $child_pages ) : ?>
                    <div style="background:var(--bg-white); border-radius:var(--radius); padding:28px; margin-top:24px; box-shadow:var(--shadow);">
                        <h3 style="color:var(--primary-color); margin-bottom:16px;"><?php esc_html_e( 'Subpagini', 'usm-theme' ); ?></h3>
                        <ul>
                            <?php foreach ( $child_pages as $child ) : ?>
                                <li style="padding:6px 0; border-bottom:1px solid var(--border-color);">
                                    <a href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>">
                                        <?php echo esc_html( $child->post_title ); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Comentarii -->
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div><!-- #main-content -->

        <?php get_sidebar(); ?>

    </div><!-- .content-area -->
</main><!-- #primary -->

<?php get_footer(); ?>
