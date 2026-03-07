<?php get_header(); ?>

<main id="primary" class="site-main" role="main">

    <header class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                printf(
                    esc_html__( 'Rezultate pentru: %s', 'usm-theme' ),
                    '<em>' . esc_html( get_search_query() ) . '</em>'
                );
                ?>
            </h1>
        </div>
    </header>

    <div class="content-area">
        <div id="main-content">

            <?php if ( have_posts() ) : ?>
                <div class="posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
                            <div class="post-content-wrap">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="entry-meta">
                                    <span class="meta-item"><?php echo esc_html( get_the_date() ); ?></span>
                                    <span class="meta-item"><?php the_author(); ?></span>
                                </div>
                                <div class="entry-summary"><?php the_excerpt(); ?></div>
                                <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                    <?php esc_html_e( 'Citește mai mult →', 'usm-theme' ); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(); ?>
            <?php else : ?>
                <div class="no-results">
                    <h2><?php esc_html_e( 'Niciun rezultat găsit', 'usm-theme' ); ?></h2>
                    <p><?php esc_html_e( 'Încearcă alte cuvinte cheie.', 'usm-theme' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>

        </div>
        <?php get_sidebar(); ?>
    </div>

</main>

<?php get_footer(); ?>
