<?php get_header(); ?>

<main id="primary" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <div class="container">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </div>
        </header>

        <div class="content-area">
            <div id="main-content">
                <div class="posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                                    <?php the_post_thumbnail( 'usm-card', array( 'class' => 'post-thumbnail', 'alt' => get_the_title() ) ); ?>
                                </a>
                            <?php endif; ?>

                            <div class="post-content-wrap">
                                <header class="post-header">
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="entry-meta">
                                        <span class="meta-item">
                                            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                                <?php echo esc_html( get_the_date() ); ?>
                                            </time>
                                        </span>
                                        <span class="meta-item"><?php the_author(); ?></span>
                                        <?php if ( has_category() ) : ?>
                                            <span class="meta-item cat-links"><?php the_category( ', ' ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        <?php esc_html_e( 'Citește mai mult →', 'usm-theme' ); ?>
                                    </a>
                                </footer>
                            </div>

                        </article>

                    <?php endwhile; ?>
                </div><!-- .posts-grid -->

                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '&laquo; ' . esc_html__( 'Anterior', 'usm-theme' ),
                    'next_text' => esc_html__( 'Următor', 'usm-theme' ) . ' &raquo;',
                ) );
                ?>

            </div><!-- #main-content -->

            <?php get_sidebar(); ?>

        </div><!-- .content-area -->

    <?php else : ?>

        <div class="content-area">
            <div class="no-results">
                <h2><?php esc_html_e( 'Nimic de afișat', 'usm-theme' ); ?></h2>
                <p><?php esc_html_e( 'Nu există postări pentru această arhivă.', 'usm-theme' ); ?></p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="read-more-btn">
                    <?php esc_html_e( '← Înapoi la pagina principală', 'usm-theme' ); ?>
                </a>
            </div>
        </div>

    <?php endif; ?>

</main><!-- #primary -->

<?php get_footer(); ?>
