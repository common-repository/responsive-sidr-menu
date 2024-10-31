jQuery(document).ready(function(){

    if( jQuery('.rsm-menu').length ) {
        rsm_check_width_and_init();
    }

    jQuery(window).on('resize', function(){
        rsm_check_width_and_init();
    });

});

function rsm_check_width_and_init() {

    var msw = parseInt( rsm.msw );

    if( msw != 100 ) {
        var screenWidth = jQuery(window).width();
        if( screenWidth <= msw ) {
            jQuery('.rsm-toggle-container').show();
            rsm_init();
        } else {
            jQuery('.rsm-toggle-container').hide();
            //console.log(rsm.ms);
            if( rsm.ms ) {
                jQuery('.rsm-menu[data-menu="' + rsm.ms + '"]').hide();
            }
        }
    } else {
        jQuery('.rsm-toggle-container').show();
        rsm_init();
    }

}

function rsm_init() {

    if( jQuery('.rsm-toggle-container.bar').length ) {
        jQuery('body').css({ 'position': 'relative', 'top': '32px'});
    }

    if( jQuery('.rsm-toggle-label').length ) {
        var iconLen = jQuery('.rsm-toggle').width();
        var labelLen = jQuery('.rsm-toggle-label').width();
        var contLen = parseInt( iconLen ) + parseInt( labelLen );
        contLen = ( 0.5 * contLen ) + contLen;
        jQuery('.rsm-toggle-container').css('min-width', contLen + 'px');
    }

    jQuery('.rsm-toggle-container').sidr({
        source: jQuery(this).attr('data-menu'),
        name: 'rsm-menu',
        side: rsm.md
    });

    if( rsm.ms ) {
        jQuery('.rsm-menu[data-menu="' + rsm.ms + '"]').show();
    }

    jQuery('.rsm-toggle-container').on('click', function(e){
        e.preventDefault();
        jQuery(this).toggleClass('activated');
        jQuery('.rsm-toggle-container .rsm-toggle').toggleClass('activated');
    });

    jQuery('.rsm-menu').each(function(index, menu){

        var list = jQuery(this).find('ul.menu li');
        if( list.children('ul').length ) {
            var listWithUl = list.children('ul');
            listWithUl.before('<span class="sidr-submenu-toggle" style="position:absolute; right:0; top:0; font-size:20px; cursor:pointer;">+</span>');
            list.children('ul').each(function(iul, submenu) {
                jQuery(this).css('padding-left', 10 * parseInt( iul ) + 'px').hide();
            });
        }

    });

    jQuery('body').on('click', '.sidr-submenu-toggle', function(){

        if( jQuery(this).text() == '+' ) {
            jQuery(this).text('-');
        } else {
            jQuery(this).text('+');
        }

        jQuery(this).parent('li').children('ul').toggleClass('active').toggle();

    });

    jQuery('.rsm-menu .current-menu-item.current_page_item').each(function(i, item){

        var parents = jQuery(this).parents('li.current-menu-ancestor').children('ul'),
            toggles = parents.children('li.current-menu-item').children('.sidr-submenu-toggle'),
            mainParentToggle = jQuery(this).parents('li.current-menu-ancestor').children('.sidr-submenu-toggle');

        //console.log(parents);
        //parents.remove();
        parents.show();
        parents.addClass('active');

        toggles.text('-');
        mainParentToggle.text('-');

    });

}
