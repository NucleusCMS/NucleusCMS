jQuery(function() {
	var qmenu_manage = jQuery.cookie('qmenu_manage');
	var qmenu_own = jQuery.cookie('qmenu_own');
	var qmenu_layuot = jQuery.cookie('qmenu_layuot');
	var qmenu_plugins = jQuery.cookie('qmenu_plugins');
	var qmenu_qhome = jQuery.cookie('qmenu_qhome');
	if (qmenu_manage == 'block' || !qmenu_manage) jQuery('#qmenu_manage').show();
	if (qmenu_own == 'block' || !qmenu_own) jQuery('#qmenu_own').show();
	if (qmenu_layuot == 'block' || !qmenu_layuot) jQuery('#qmenu_layuot').show();
	if (qmenu_plugins == 'block' || !qmenu_plugins) jQuery('#qmenu_plugins').show();
	if (qmenu_qhome == 'block' || !qmenu_qhome) jQuery('#qmenu_qhome').show();

	jQuery('.accordion').click(function() {
		var child = jQuery(this).next('ul');
		jQuery(child).slideToggle('fast', function() {
			jQuery.cookie(jQuery(child).attr('id'), jQuery(child).css('display'), {
				expires: 10
			});
		});
	});
});