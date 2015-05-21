jQuery( "#frontend-admin-menu-icon" ).click(function() {
  jQuery( "#frontend-admin-menu-items" ).toggle();
});

jQuery( document ).ready( function() {
    jQuery( '#frontend-admin-menu-items .menu-item-has-children > .expand' ).addClass( "frontend-admin-menu-childen-icon-right" );
    jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'none'} );
    jQuery( '#frontend-admin-menu-items ul ul' ).hide();
    jQuery( '#frontend-admin-menu-items .menu-item-has-children .expand' ).click(function() {
        jQuery(this).next().next().slideToggle('fast');
        jQuery(this).toggleClass( "frontend-admin-menu-childen-icon-right" );
        jQuery(this).toggleClass( "frontend-admin-menu-childen-icon-down" );
        return false;
    });			
});