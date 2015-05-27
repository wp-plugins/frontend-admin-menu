jQuery( "#frontend-admin-menu-icon" ).click(function() {
    jQuery( "#frontend-admin-menu-items" ).toggle();
    var cexpand = jQuery.cookie('frontend-admin-menu');
    if (cexpand === undefined || null){
        jQuery.cookie('frontend-admin-menu', 'expand-on', jQuery.extend({}, { path: '/' }, { expires: 91 }));
    } else if (cexpand === 'expand-on'){
        jQuery.cookie('frontend-admin-menu', 'expand-off', jQuery.extend({}, { path: '/' }, { expires: 91 }));
    } else if (cexpand === 'expand-off'){
        jQuery.cookie('frontend-admin-menu', 'expand-on', jQuery.extend({}, { path: '/' }, { expires: 91 }));
    }
});

jQuery( document ).ready( function() {
    jQuery( '#frontend-admin-menu-items .menu-item-has-children > .expand' ).addClass( "frontend-admin-menu-childen-icon-right" );
    jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'none'} );
    jQuery( '#frontend-admin-menu-items ul ul' ).hide();
    var cexpand = jQuery.cookie('frontend-admin-menu');
    if (cexpand === undefined || null){
        jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'none'} );
    } else if (cexpand === 'expand-on'){
        jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'block'} );
    } else if (cexpand === 'expand-off'){
        jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'none'} );
    }
    jQuery( '#frontend-admin-menu-items .menu-item-has-children .expand' ).click(function() {
        jQuery(this).next().next().slideToggle('fast');
        jQuery(this).toggleClass( "frontend-admin-menu-childen-icon-right" );
        jQuery(this).toggleClass( "frontend-admin-menu-childen-icon-down" );
        return false;
    });			
});