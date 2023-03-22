<footer class="footer-wrap">
	<div class="container">
        <div class="footer">
            <!-- Вывод виджетов -->
            <?php
            $rows    = intval( apply_filters( 'footer_widget_rows', 1 ) );
            $regions = intval( apply_filters( 'footer_widget_columns', 5 ) );
            for ( $row = 1; $row <= $rows; $row++ ) :
                for ( $region = $regions; 0 < $region; $region-- ) {
                    if ( is_active_sidebar( 'footer-' . esc_attr( $region + $regions * ( $row - 1 ) ) ) ) {
                        $columns = $region;
                        break;
                    }
                }
                if ( isset( $columns ) ) : ?>
                    <?php for ( $column = 1; $column <= $columns; $column++ ) :
                        $footer_n = $column + $regions * ( $row - 1 );
                        if ( is_active_sidebar( 'footer-' . esc_attr( $footer_n ) ) ) : ?>

                            <div class=<?php echo '"footer-column"'; ?>>
                                <div class="footer-nav">
                                    <?php dynamic_sidebar( 'footer-' . esc_attr( $footer_n ) ); ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php unset( $columns ); ?>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</footer>

<?php include('template-parts/parts/modals.php'); ?>
<?php wp_footer(); ?>

</body>
</html>