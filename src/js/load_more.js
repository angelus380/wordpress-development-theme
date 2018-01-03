jQuery(document).ready( function($){

// LOAD MORE
function loadMore() {
  var div         = $('#more'),
      page_count  = div.data('count'),
      count       = 0;

  if ( page_count <= 1 ) {
    div.removeClass( 'open' );
  }

  $( document ).on( 'click', '#more', function() {
    var that       = $( this ),
        page       = that.data( 'page' ),
        nextPage   = page + 1,
        pageType   = that.data( 'type' ),
        pageCount  = that.data( 'count' );

    count ++;

    if ( count == 1 ) {
      $.ajax({
        url:  loadmore.ajaxurl,
        type: 'post',
        data: {
          query_vars:  loadmore.query_vars,
          page:        nextPage,
          type:        pageType,
          action:      'load_more',
        },
        success:
        function( response ) {

          var target = $('#loop');

          that.data( 'page', nextPage );
          target.append( response );

          if ( pageCount == nextPage ) {
            that.removeClass( 'open' );
          }

          count = 0;

        },
        error:
        function( response ) {

          console.log( 'error' );

        }
      });
    }

  })

} loadMore();

});