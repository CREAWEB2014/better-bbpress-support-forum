jQuery( function($) {

    $('a#bbsf-import-bbps').on( 'click', function(e){
        
        e.preventDefault();

        var  $this = $(this),
        data = {
            action: 'bbsf_import_bbps',
            n: $this.data('nonce'),
        };

        $.post( ajaxurl, data, function( resp ) {
            if ( true === resp.success ) {
                alert('Done!');
            }
        });

    });
    
});
