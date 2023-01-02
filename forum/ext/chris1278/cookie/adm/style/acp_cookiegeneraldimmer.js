/* cookiegeneraldimmer.js
------------------------------------*/

'use strict';

cookiegeneraldimmer.setConfig = function () {
	const enabled = "1.0";
	const disabled = "0.35";

	document.getElementById("dim_opt_klarostyleposition").style.opacity = ((document.getElementById("klarostylewidth_small").selected) ? enabled : disabled);
};

cookiegeneraldimmer.setstyleDefaults = function () {
	document.getElementById("cookie_icon_selection_1").checked = true;
	document.getElementById("dark").selected = true;
	document.getElementById("klarostylewidth_small").selected = true;
	document.getElementById("bottomright").selected = true;
	document.getElementById("window_fix_in_the_middle_0").checked = true;
	document.getElementById("window_position_1").checked = true;
	document.getElementById("klaro_hidden_windows_1").checked = true;
	cookiegeneraldimmer.setConfig();
};

cookiegeneraldimmer.setsettingsDefaults = function (){
	document.getElementById("name_of_cookie_default").value = 'klaro';
	document.getElementById("klaro_div_container_default").value = 'klaro';
	document.getElementById("storage_version_cookie").checked = true;
	document.getElementById("html_code_processing_1").checked = true;
	document.getElementById("group_formation_1").checked = true;
	document.getElementById("save_all_button_1").checked = true;
	document.getElementById("cookie_runtime_default").value = '120';
	document.getElementById("show_decline_button_1").checked = true;
	document.getElementById("to_the_cookie_settings_1").checked = true;
	document.getElementById("klaro_note_1").checked = true;
	cookiegeneraldimmer.setConfig();
}

window.onload = cookiegeneraldimmer.setConfig();
