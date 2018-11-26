jQuery(document).ready(function($) {
    $('.woocommerce-tabs .panel').hide();
    $('.woocommerce-tabs ul.tabs li a').click(function() {
        var $tab = $(this),
            $tabs_wrapper = $tab.closest('.woocommerce-tabs');
        $('ul.tabs li', $tabs_wrapper).removeClass('active');
        $('div.panel', $tabs_wrapper).hide();
        $('div' + $tab.attr('href'), $tabs_wrapper).show();
        $tab.parent().addClass('active');
        return false;
    });
    if ($('table.variations').length > 0) {
        $table = $('table.variations');
        $table.addClass('var-' + $table.find('tr').length);
        $labels = $table.find('.label');
        $.each($labels, function(index, val) {
            $title = $(this).find('label').text().toLowerCase();
            $value = $(this).siblings('.value');
            $value.addClass($title);
        });
    }
});