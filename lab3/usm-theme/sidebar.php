<aside>
    <h3>Bara laterala</h3>
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php else : ?>
        <p>Nu exista widget-uri adaugate.</p>
    <?php endif; ?>
</aside>