<?php get_header(); ?>

<main id="primary" class="site-main" role="main">
    <div class="content-area">

        <div id="main-content">
            <?php if ( have_posts() ) : ?>

                <?php if ( is_home() && ! is_front_page() ) : ?>
                    <header class="page-header">
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <div class="posts-grid">
                    <?php
                    /* Bucla WordPress — afișează ultimele 5 postări */
                    $args = array(
                        'posts_per_page' => 5,
                        'post_status'    => 'publish',
                    );

                    if ( is_home() && ! is_front_page() ) {
                        // Dacă avem o pagină dedicată pentru blog, folosim bucla nativă
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', get_post_format() );
                        endwhile;
                    } else {
                        // Pe pagina principală: interogare personalizată pentru ultimele 5
                        $latest_posts = new WP_Query( $args );
                        if ( $latest_posts->have_posts() ) :
                            while ( $latest_posts->have_posts() ) :
                                $latest_posts->the_post();
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                            <?php the_post_thumbnail( 'large', array( 'class' => 'post-thumbnail', 'alt' => get_the_title() ) ); ?>
                                        </a>
                                    <?php endif; ?>

                                    <div class="post-content-wrap">

                                        <header class="post-header">
                                            <h2 class="entry-title">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                            </h2>
                                            <div class="entry-meta">
                                                <span class="meta-item posted-on">
                                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                                        <?php echo esc_html( get_the_date() ); ?>
                                                    </time>
                                                </span>
                                                <span class="meta-item byline">
                                                    <?php esc_html_e( 'de', 'usm-theme' ); ?> <?php the_author(); ?>
                                                </span>
                                                <?php if ( has_category() ) : ?>
                                                    <span class="meta-item cat-links">
                                                        <?php the_category( ', ' ); ?>
                                                    </span>
                                                <?php endif; ?>
                                                <span class="meta-item comments-link">
                                                    <?php comments_popup_link(
                                                        esc_html__( '0 comentarii', 'usm-theme' ),
                                                        esc_html__( '1 comentariu', 'usm-theme' ),
                                                        esc_html__( '% comentarii', 'usm-theme' )
                                                    ); ?>
                                                </span>
                                            </div>
                                        </header>

                                        <div class="entry-summary">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <footer class="entry-footer">
                                            <a href="<?php the_permalink(); ?>" class="read-more-btn" aria-label="<?php echo esc_attr( sprintf( __( 'Citește mai mult: %s', 'usm-theme' ), get_the_title() ) ); ?>">
                                                <?php esc_html_e( 'Citește mai mult →', 'usm-theme' ); ?>
                                            </a>
                                        </footer>

                                    </div><!-- .post-content-wrap -->
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <div class="no-results">
                                <h2><?php esc_html_e( 'Nu s-au găsit postări', 'usm-theme' ); ?></h2>
                                <p><?php esc_html_e( 'Se pare că nu există încă conținut. Reveniți în curând!', 'usm-theme' ); ?></p>
                            </div>
                            <?php
                        endif;
                    }
                    ?>
                </div><!-- .posts-grid -->

                <?php
                // Paginare
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; ' . esc_html__( 'Anterior', 'usm-theme' ),
                    'next_text' => esc_html__( 'Următor', 'usm-theme' ) . ' &raquo;',
                ) );
                ?>

            <?php else : ?>

                <div class="no-results">
                    <h2><?php esc_html_e( 'Nicio postare găsită', 'usm-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Nu există conținut momentan. Încercați o altă căutare sau reveniți mai târziu.', 'usm-theme' ); ?></p>
                </div>

            <?php endif; ?>
        </div><!-- #main-content -->

        <?php get_sidebar(); ?>

    </div><!-- .content-area -->
</main><!-- #primary -->

<?php get_footer(); ?>
