
// wait for ready event
// jQuery( document ).ready(function() {
  
  // Select the node that will be observed for mutations
  const targetNode = document.documentElement;

  // Options for the observer (which mutations to observe)
  const config = { attributes: false, childList: true, subtree: false };
  
  var bold_timeline_item_button_done = false;
  var css_override_item_done = false;
  var css_override_group_done = false;
  var css_override_container_done = false;

  // Callback function to execute when mutations are observed
  const callback = function( mutationsList, observer ) {
    var i;
    //for ( i = 0; i < mutationsList.length; i++ ) {
      //if ( mutationsList[ i ].type === 'childList' ) {
        if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_item_button' ).length > 0 && ! bold_timeline_item_button_done ) {
          bold_timeline_item_button_done = true;
          jQuery( '.bold_timeline_item_button' ).each( function() {
            var css_override = jQuery( this ).data( 'css-override' );
            if ( css_override != '' ) {
              var id = jQuery( this ).attr( 'id' );
              css_override = css_override.replace( /(\.bold_timeline_item_button)([\.\{\s])/g, '.bold_timeline_item_button#' + id + '$2' );
              var head = document.getElementsByTagName( 'head' )[0];
              var style = document.createElement( 'style' );
              style.appendChild( document.createTextNode( css_override ) );
              head.appendChild( style );
            }
          });
        }
        if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_item' ).length > 0 && ! css_override_item_done ) {
          css_override_item_done = true;
          jQuery( '.bold_timeline_item' ).each( function() {
            var css_override = jQuery( this ).data( 'css-override' );
            if ( css_override != '' ) {
              var id = jQuery( this ).attr( 'id' );
              css_override = css_override.replace( /(\.bold_timeline_item)([\.\{\s])/g, '.bold_timeline_item#' + id + '$2' );
              var head = document.getElementsByTagName( 'head' )[0];
              var style = document.createElement( 'style' );
              style.appendChild( document.createTextNode( css_override ) );
              head.appendChild( style );
            }
          });
        }
        if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_group' ).length > 0 && ! css_override_group_done ) {
          css_override_group_done = true;
          jQuery( '.bold_timeline_group' ).each( function() {
            var css_override = jQuery( this ).data( 'css-override' );
            if ( css_override != '' ) {
              var id = jQuery( this ).attr( 'id' );
              css_override = css_override.replace( /(\.bold_timeline_group)([\.\{\s])/g, '.bold_timeline_group#' + id + '$2' );
              var head = document.getElementsByTagName( 'head' )[0];
              var style = document.createElement( 'style' );
              style.appendChild( document.createTextNode( css_override ) );
              head.appendChild( style );
            }
          });
        }
        if ( typeof jQuery !== 'undefined' && jQuery( '.bold_timeline_container' ).length > 0 && ! css_override_container_done ) {
          css_override_container_done = true;
          jQuery( '.bold_timeline_container' ).each( function() {
            var css_override = jQuery( this ).data( 'css-override' );
            if ( css_override != '' ) {
              var id = jQuery( this ).attr( 'id' );
              css_override = css_override.replace( /(\.bold_timeline_container)([\.\{\s])/g, '#' + id + '$2' );
              var head = document.getElementsByTagName( 'head' )[0];
              var style = document.createElement( 'style' );
              style.appendChild( document.createTextNode( css_override ) );
              head.appendChild( style );
            }
          });
        }
      //}
    //}
  };
//}); // ready event

// Create an observer instance linked to the callback function
const observer = new MutationObserver( callback );

// Start observing the target node for configured mutations
observer.observe(targetNode, config);

// Later, you can stop observing
document.addEventListener( 'DOMContentLoaded', function() { observer.disconnect(); }, false );