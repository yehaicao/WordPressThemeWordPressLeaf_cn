/**
 * skip-link-focus-fix.js
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
	    is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
	    is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

	if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();

/**
 * Initialise Menu Toggle
 */
( function() {

	jQuery('#nav-toggle').on( 'click' , function(event) {
		event.preventDefault();
		jQuery('body,html').animate({scrollTop:0},800);
		jQuery(this).toggleClass('nav-is-visible');
		jQuery('.mobile-navigation').toggleClass("mobile-nav-open");
	});

	jQuery('.mobile-navigation li.menu-item-has-children, .mobile-navigation li.page_item_has_children').each( function() {
		jQuery(this).prepend('<div class="nav-toggle-subarrow"><i class="fa fa-angle-down"></i></div>');
	});

	jQuery('.nav-toggle-subarrow, .nav-toggle-subarrow .nav-toggle-subarrow').click(
		function () {
			jQuery(this).parent().toggleClass("nav-toggle-dropdown");
		}
	);

} )();

/**
* Responsive Videos
*/
( function() {
    jQuery('body').fitVids();
})();
