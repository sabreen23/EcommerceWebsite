<div class="updated" id="dokan-rank-math-installer-notice" style="position: relative;">
    <h2><?php esc_html_e( 'Dokan Rank Math SEO module is almost ready!', 'dokan' ); ?></h2>

    <?php if ( $is_rank_math_installed ) : ?>
        <p>
            <?php
            /* translators: %s: Rank Math SEO */
            echo sprintf( __( 'You just need to activate the %s plugin to make it functional.', 'dokan' ), '<strong>Rank Math SEO</strong>' );
            ?>
        </p>
        <p>
            <a class="button button-primary" href="<?php echo wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $rank_math_plugin_file . '&amp;plugin_status=all&amp;paged=1&amp;s=', 'activate-plugin_' . $rank_math_plugin_file ); ?>"  title="<?php esc_attr_e( 'Activate this plugin', 'dokan' ); ?>"><?php esc_html_e( 'Activate', 'dokan' ); ?></a>
        </p>
    <?php else : ?>
        <p>
            <?php
            /* translators: %s: Rank Math SEO */
            echo sprintf( __( 'You just need to install the %s plugin to make it functional.', 'dokan' ), '<a target="_blank" href="https://wordpress.org/plugins/seo-by-rank-math/">Rank Math SEO</a>' );
            ?>
        </p>
        <p><button id="rank-math-installer" class="button"><?php esc_html_e( 'Install Now', 'dokan' ); ?></button></p>
    <?php endif; ?>
</div>

<script type="text/javascript">
    ( function ( $ ) {
        $( '#dokan-rank-math-installer-notice #rank-math-installer' ).on( 'click', function ( e ) {
            e.preventDefault();
            $( this ).addClass( 'install-now updating-message' );
            $( this ).text( '<?php echo esc_js( 'Installing...', 'dokan' ); ?>' );

            var data = {
                action: 'dokan_install_rank_math_seo',
                _wpnonce: '<?php echo wp_create_nonce( 'dokan-rank-math-installer-nonce' ); ?>'
            };

            $.post( ajaxurl, data, function ( response ) {
                if ( response.success ) {
                    $( '#dokan-rank-math-installer-notice #dokan-rank-math-installer' ).attr( 'disabled', 'disabled' );
                    $( '#dokan-rank-math-installer-notice #dokan-rank-math-installer' ).removeClass( 'install-now updating-message' );
                    $( '#dokan-rank-math-installer-notice #dokan-rank-math-installer' ).text( '<?php echo esc_js( 'Installed', 'dokan' ); ?>' );
                    window.location.reload();
                }
            } );
        } );
    } )( jQuery );
</script>
