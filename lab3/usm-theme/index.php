<?php get_header(); ?>

    <main>
        <?php
        $args = array( 'posts_per_page' => 5 );
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();
        ?>
                <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <p>Nu exista postari.</p>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>