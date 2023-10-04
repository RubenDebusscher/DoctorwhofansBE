/* jb_acp.js
------------ */

jumpboxindex = {};

jumpboxindex.constants = Object.freeze({
	Disp_Jumpbox_Position_nb_top		: 1,
	Disp_Jumpbox_Position_nb_bottom		: 4,

	Opacity_Enabled						: '1',
	Opacity_Disabled					: '0.35',
});

jumpboxindex.setConfig = function () {
	'use strict';

	var jb = jumpboxindex.constants;

	$('#jumpbox_font_icon').css('opacity', (
			$('input[name="jumpbox_default"]').prop('checked') == true
			&& $('select[name="jumpbox_position"]').prop('value') != jb.Disp_Jumpbox_Position_nb_top
			&& $('select[name="jumpbox_position"]').prop('value') != jb.Disp_Jumpbox_Position_nb_bottom
		) ? jb.Opacity_Disabled : jb.Opacity_Enabled
	);

	$('#jumpbox_default').css('opacity', (
			$('select[name="jumpbox_position"]').prop('value') == jb.Disp_Jumpbox_Position_nb_top
			|| $('select[name="jumpbox_position"]').prop('value') == jb.Disp_Jumpbox_Position_nb_bottom
		) ? jb.Opacity_Disabled : jb.Opacity_Enabled
	);
};

jumpboxindex.customFormReset = function () {
	'use strict';

	$('#acp_jumpboxindex').trigger("reset");

	jumpboxindex.setConfig();
};

$(window).ready(function() {
	'use strict';

	jumpboxindex.setConfig();

	$('input[name="jumpbox_default"]'		).on('change',	jumpboxindex.setConfig);
	$('input[name="jumpbox_ucp"]'			).on('change',	jumpboxindex.setConfig);
	$('input[name="jumpbox_left"]'			).on('change',	jumpboxindex.setConfig);
	$('select[name="jumpbox_position"]'		).on('change',	jumpboxindex.setConfig);
	$('input[name="form_reset"]'			).on('click',	jumpboxindex.customFormReset);
});

$('#jb_font_icon').on('keyup blur', function() {
	var input = $(this).val();
	var $fa_icon = $(this).next('span');
	$fa_icon.attr('class', 'icon ' + input);
});
