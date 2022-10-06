/* acp_cookiedimmer.js
------------------------------------*/

'use strict';

cookiedimmer.setConfig = function () {
	const enabled = "1.0";
	const disabled = "0.35";

	document.getElementById("dim_google_analytics_id").style.opacity = ((document.getElementById("google_analytics_no_tm_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_url").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_side_id").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
	document.getElementById("dim_matomo_in_out").style.opacity = ((document.getElementById("matomo_switch_0").checked) ? disabled : enabled);
};

cookiedimmer.customFormReset = function () {
	document.getElementById("acp_cookie").reset();
	cookiedimmer.setConfig();
};

window.onload = cookiedimmer.setConfig();
