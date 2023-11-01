var bt_cc_653e328392635W416_init_finished = false;
			
			document.addEventListener('readystatechange', function() { 
				if ( ! bt_cc_653e328392635W416_init_finished && typeof(jQuery) !== 'undefined' && ( document.readyState === 'complete' ) ) {
					var img_height = '';
					if ( img_height != '' ) {
						jQuery( 'head' ).append( '<style>.ddImage img {height:' + img_height + 'px !important;}</style>' );
					}			
				
					var ddData = [{ text:'Select...', value:'' },{ text: 'Cat', value: '100', description: '', image: '' },{ text: 'Dog', value: '150', description: '', image: '' }];
					
					var oDropdown = jQuery( '#653e328392635W416' ).msDropDown({
						byJson:{ data:ddData },
						on:{change:function( data, ui ) {
							var val = data.value;
							ui.data( 'value', val );
							bt_cc_eval_conditions( val, jQuery( ui ).closest( '.btQuoteSelect' ).data( 'condition' ) );
							bt_quote_total( jQuery( ui ).closest( '.btQuoteBooking' ) );
							bt_paypal_items( jQuery( ui ).closest( '.btQuoteBooking' ) );
						}}
					}).data('dd');
					if ( oDropdown ) {
						bt_cc_init_dropdown( oDropdown, '#653e328392635W416', 0 );
					}					
					bt_cc_653e328392635W416_init_finished = true;
				}
			}, false);
		