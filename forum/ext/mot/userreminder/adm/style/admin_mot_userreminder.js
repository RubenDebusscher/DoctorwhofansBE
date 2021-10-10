/*
* Define the search patterns
*/
var numeralMatch = /[0-9]/;
var emailMatch = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;

/*
*
*
* @params:	inputName:	string, name of the DOM element we want to check
*		matchString: string with the regular expression we want to use
*		defaultValue: value to use in case the provided value isn't valid
*		deleteChars: boolean,
*
*/
function checkInput(inputName, matchString, defaultValue, deleteChars = false)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		if (deleteChars) {
			elementValue = elementValue.replace(/[^\d]/g, "");
		}
		var result = elementValue.match(matchString);
		if (result == null) {
			domElement.value = defaultValue;
		} else {
			domElement.value = elementValue;
		}
	}
}

function cleanIds(inputName)
{
	var domElement = document.getElementById(inputName);
	var elementValue = domElement.value;
	if (elementValue != '') {
		elementValue = elementValue.replace(/[;:\._-]/g, ",");		// replace some characters with a comma (in case someone fooled while typing)
		elementValue = elementValue.replace(/[^,\d]/g, "");			// erase all characters which are not a digit or a comma
		elementValue = elementValue.replace(/,{2,10}/g, ",");		// erase multiple commas
		elementValue = elementValue.replace(/^,*/, "");				// erase all leading commas
		elementValue = elementValue.replace(/,*$/, "");				// erase all trailing commas
		domElement.value = elementValue;
	}
}
