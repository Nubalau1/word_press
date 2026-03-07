<section id="comments">
    <h3>Comentarii (<?php comments_number( '0', '1', '%' ); ?>)</h3>

    <?php if ( have_comments() ) : ?>
        <ul>
            <?php wp_list_comments( array( 'style' => 'li' ) ); ?>
        </ul>
    <?php endif; ?>

    <?php comment_form(); ?>
</section>