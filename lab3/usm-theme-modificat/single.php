<?php get_header(); ?>

<main id="primary" class="site-main" role="main">
    <div class="content-area">

        <div id="main-content">
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'post single-post' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'usm-hero', array( 'class' => 'post-featured-image', 'alt' => get_the_title() ) ); ?>
                    <?php endif; ?>

                    <div class="single-post-header">

                        <?php if ( has_category() ) : ?>
                            <div class="cat-links" style="margin-bottom: 12px;">
                                <?php the_category( ' ' ); ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="entry-title" style="font-size:2rem; margin-bottom:14px; line-height:1.25;">
                            <?php the_title(); ?>
                        </h1>

                        <div class="entry-meta" style="margin-bottom:20px;">
                            <span class="meta-item posted-on">
                                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </time>
                            </span>
                            <span class="meta-item byline">
                                <?php esc_html_e( 'de', 'usm-theme' ); ?>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>
                            <span class="meta-item">
                                <?php
                                printf(
                                    esc_html__( '%d minute citire', 'usm-theme' ),
                                    max( 1, (int) ceil( str_word_count( strip_tags( get_the_content() ) ) / 200 ) )
                                );
                                ?>
                            </span>
                        </div>

                    </div><!-- .single-post-header -->

                    <div class="single-post-body">

                        <div class="entry-content">
                            <?php
                            the_content( sprintf(
                                wp_kses(
                                    __( 'Continuă lectul %s <span class="meta-nav">&rarr;</span>', 'usm-theme' ),
                                    array( 'span' => array( 'class' => array() ) )
                                ),
                                the_title( '<em>', '</em>', false )
                            ) );
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Pagini:', 'usm-theme' ),
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div><!-- .entry-content -->

                        <?php if ( has_tag() ) : ?>
                            <div class="tags-links">
                                <strong><?php esc_html_e( 'Etichete:', 'usm-theme' ); ?></strong>
                                <?php the_tags( ' ', ', ', '' ); ?>
                            </div>
                        <?php endif; ?>

                        <footer class="entry-footer" style="margin-top:24px; padding-top:16px; border-top:1px solid var(--border-color);">
                            <?php
                            edit_post_link(
                                esc_html__( 'Editează postarea', 'usm-theme' ),
                                '<span class="edit-link">',
                                '</span>'
                            );
                            ?>
                        </footer>

                    </div><!-- .single-post-body -->

                </article>

                <!-- Navigare între postări -->
                <nav class="post-navigation" aria-label="<?php esc_attr_e( 'Navigare postări', 'usm-theme' ); ?>">
                    <div class="nav-previous">
                        <?php
                        $prev_post = get_previous_post();
                        if ( $prev_post ) : ?>
                            <span class="nav-label"><?php esc_html_e( '← Postare anterioară', 'usm-theme' ); ?></span>
                            <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
                                <?php echo esc_html( $prev_post->post_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="nav-next">
                        <?php
                        $next_post = get_next_post();
                        if ( $next_post ) : ?>
                            <span class="nav-label"><?php esc_html_e( 'Postare următoare →', 'usm-theme' ); ?></span>
                            <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
                                <?php echo esc_html( $next_post->post_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>

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
