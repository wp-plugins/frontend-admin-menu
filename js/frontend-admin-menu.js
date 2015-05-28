function frontend_admin_menu_setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function frontend_admin_menu_getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

jQuery( "#frontend-admin-menu-icon" ).click(function() {
    jQuery( "#frontend-admin-menu-items" ).toggle();
    var cexpand = frontend_admin_menu_getCookie('frontend-admin-menu');
    if (cexpand === undefined || null){
        frontend_admin_menu_setCookie("frontend-admin-menu", 'expand-on', 365);
    } else if (cexpand === 'expand-on'){
        frontend_admin_menu_setCookie("frontend-admin-menu", 'expand-off', 365);
    } else if (cexpand === 'expand-off'){
        frontend_admin_menu_setCookie("frontend-admin-menu", 'expand-on', 365);
    }
});

jQuery( document ).ready( function() {
    jQuery( '#frontend-admin-menu-items .menu-item-has-children > .expand' ).addClass( "frontend-admin-menu-childen-icon-right" );
    jQuery( '#frontend-admin-menu-menu #frontend-admin-menu-items' ).css( {display:'none'} );
    jQuery( '#frontend-admin-menu-items ul ul' ).hide();
    var cexpand = frontend_admin_menu_getCookie('frontend-admin-menu');
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