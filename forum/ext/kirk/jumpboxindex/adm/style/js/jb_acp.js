/* jb_acp.js
------------ */

'use strict';

var jumpboxindex= {};

jumpboxindex.constants = Object.freeze({
	DispJumpboxPosition_nb_top		: 1,
	DispJumpboxPosition_nb_bottom	: 4,

	OpacityEnabled					: '1',
	OpacityDisabled					: '0.35',
});

jumpboxindex.setConfig = function () {

	var jb = jumpboxindex.constants;

	$('#jumpbox_font_icon').css('opacity', (
			$('input[name="jumpbox_default"]').prop('checked') == true
			&& $('select[name="jumpbox_position"]').prop('value') != jb.DispJumpboxPosition_nb_top
			&& $('select[name="jumpbox_position"]').prop('value') != jb.DispJumpboxPosition_nb_bottom
		) ? jb.OpacityDisabled : jb.OpacityEnabled
	);

	$('#jumpbox_default').css('opacity', (
			$('select[name="jumpbox_position"]').prop('value') == jb.DispJumpboxPosition_nb_top
			|| $('select[name="jumpbox_position"]').prop('value') == jb.DispJumpboxPosition_nb_bottom
		) ? jb.OpacityDisabled : jb.OpacityEnabled
	);
};

jumpboxindex.customFormReset = function () {

	$('#acp_jumpboxindex').trigger("reset");

	jumpboxindex.setConfig();
};

$(window).ready(function() {

	jumpboxindex.setConfig();

	$('input[name="jumpbox_default"]'		).on('change',	jumpboxindex.setConfig);
	$('input[name="jumpbox_ucp"]'			).on('change',	jumpboxindex.setConfig);
	$('select[name="jumpbox_position"]'		).on('change',	jumpboxindex.setConfig);
	$('input[name="form_reset"]'			).on('click',	jumpboxindex.customFormReset);
});

$('#jb_font_icon').on('keyup blur', function() {
	var input = $(this).val();
	var $fa_icon = $(this).next('span');
	$fa_icon.attr('class', 'icon ' + input);
});
