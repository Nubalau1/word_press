<?php
/**
 * comments.php — Șablon pentru afișarea comentariilor și formularul de trimitere
 *
 * @package USM_Theme
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $usm_comment_count = get_comments_number();
            if ( '1' === $usm_comment_count ) {
                printf(
                    /* translators: %s: post title */
                    esc_html__( 'Un comentariu la „%s"', 'usm-theme' ),
                    '<em>' . get_the_title() . '</em>'
                );
            } else {
                printf(
                    /* translators: 1: comment count, 2: post title */
                    esc_html__( '%1$s comentarii la „%2$s"', 'usm-theme' ),
                    number_format_i18n( $usm_comment_count ),
                    '<em>' . get_the_title() . '</em>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => 'usm_comment_callback',
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments" style="color:var(--text-light); font-style:italic; text-align:center; padding:20px 0;">
                <?php esc_html_e( 'Comentariile sunt închise.', 'usm-theme' ); ?>
            </p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
    comment_form( array(
        'title_reply'          => esc_html__( 'Lasă un comentariu', 'usm-theme' ),
        'title_reply_to'       => esc_html__( 'Răspunde lui %s', 'usm-theme' ),
        'cancel_reply_link'    => esc_html__( 'Anulează răspunsul', 'usm-theme' ),
        'label_submit'         => esc_html__( 'Trimite comentariul', 'usm-theme' ),
        'comment_notes_before' => '<p class="comment-notes" style="font-size:0.85rem; color:var(--text-light); margin-bottom:16px;">' .
            esc_html__( 'Adresa ta de email nu va fi publicată. Câmpurile obligatorii sunt marcate cu *', 'usm-theme' ) .
            '</p>',
        'fields' => array(
            'author' => '<p class="comment-form-author"><label for="author">' .
                esc_html__( 'Nume', 'usm-theme' ) . ' <span class="required">*</span></label>' .
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" maxlength="245" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' .
                esc_html__( 'Email', 'usm-theme' ) . ' <span class="required">*</span></label>' .
                '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) .
                '" size="30" maxlength="100" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' .
                esc_html__( 'Website', 'usm-theme' ) . '</label>' .
                '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" maxlength="200" /></p>',
        ),
    ) );
    ?>

</div><!-- #comments -->

<?php
/**
 * Callback personalizat pentru afișarea unui comentariu.
 */
function usm_comment_callback( $comment, $args, $depth ) {
    ?>
    <li <?php comment_class( 'comment' ); ?> id="comment-<?php comment_ID(); ?>">
        <article class="comment-body">
            <div class="comment-meta">
                <?php echo get_avatar( $comment, 48 ); ?>
                <div>
                    <span class="comment-author fn"><?php comment_author_link(); ?></span>
                    <div class="comment-metadata">
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <time datetime="<?php comment_time( 'c' ); ?>">
                                <?php
                                printf(
                                    /* translators: 1: date, 2: time */
                                    esc_html__( '%1$s la %2$s', 'usm-theme' ),
                                    esc_html( get_comment_date() ),
                                    esc_html( get_comment_time() )
                                );
                                ?>
                            </time>
                        </a>
                        <?php edit_comment_link( esc_html__( 'Editează', 'usm-theme' ), '<span class="edit-link"> &mdash; ', '</span>' ); ?>
                    </div>
                </div>
            </div>

            <?php if ( '0' === $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation" style="color:var(--secondary-color); font-style:italic; font-size:0.85rem;">
                    <?php esc_html_e( 'Comentariul tău este în așteptarea moderării.', 'usm-theme' ); ?>
                </p>
            <?php endif; ?>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <div class="reply">
                <?php
                comment_reply_link( array_merge( $args, array(
                    'add_below' => 'comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '',
                    'after'     => '',
                ) ) );
                ?>
            </div>
        </article>
    <?php
}
?>
