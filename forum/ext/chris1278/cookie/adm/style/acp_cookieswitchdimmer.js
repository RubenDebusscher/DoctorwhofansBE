/* acp_cookieswitchdimmer.js
------------------------------------*/

'use strict';

cookieswitchdimmer.setConfig = function () {
	const enabled = "1.0";
	const disabled = "0.35";
	const displayon = "block";
	const displayoff = "none";

	document.getElementById("dim_data_name_googletranslate").style.opacity = ((document.getElementById("google_translator_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_google_analytics_id").style.opacity = ((document.getElementById("google_analytics_no_tm_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_google_analytics_os").style.opacity = ((document.getElementById("google_analytics_no_tm_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_data_name_googleanalytics").style.opacity = ((document.getElementById("google_analytics_no_tm_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_google_analytics_id").style.display = ((document.getElementById("ganalytics_own_script_0").checked) ? displayon : displayoff);
	document.getElementById("dim_matomo_url").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_data_name_matomo").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_own_script").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_side_id").style.display = ((document.getElementById("matomo_own_script_0").checked) ? displayon : displayoff);
	document.getElementById("dim_matomo_url").style.display = ((document.getElementById("matomo_own_script_0").checked) ? displayon : displayoff);
	document.getElementById("dim_matomo_side_id").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_in_out").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_cookie_impressum_link_extern").style.opacity = ((document.getElementById("cookie_imp_link").selected) ? enabled : disabled);
	document.getElementById("dim_cookie_impressum_link_extern").style.display = ((document.getElementById("cookie_no_imp").selected) ? displayoff : displayon);
	document.getElementById("dim_data_name_googlewebfont").style.opacity = ((document.getElementById("google_webfont_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_data_name_googleadsense").style.opacity = ((document.getElementById("google_adsense_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_data_name_googlemaps").style.opacity = ((document.getElementById("google_maps_switch_0").checked) ? disabled : enabled);
};

window.onload = cookieswitchdimmer.setConfig();
