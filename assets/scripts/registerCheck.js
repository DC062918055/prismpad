function checkForm() {
	var FN = fNameCorrect();
	var SN = sNameCorrect();
	var EA = eAddrCorrect();
	var UN = uNameCorrect();
	var PW = pWordCorrect();
	if(FN == false) {
		return false;
	}
	else if(SN == false) {
		return false;
	}
	else if(EA == false) {
		return false;
	}
	else if(UN == false) {
		return false;
	}
	else if(PW == false) {
		return false;
	}
	return true;
}

function fNameCorrect() {
	var fName = document.getElementById('firstName').value;
	var fNameError = document.getElementById('firstNameError');
	var length = fName.length;
	if(length == 0) {
		fNameError.innerHTML = "Please enter your first name to create an account.";
		return false;
	}
	else if(length > 255) {
		fNameError.innerHTML = "Your name is too long to process. Try using a nickname.";
		return false;
	}
	else {
		fNameError.innerHTML = "";
		return true;
	}
}
function sNameCorrect() {
	var sName = document.getElementById('surName').value;
	var sNameError = document.getElementById('surNameError');
	var length = sName.length;
	if(length == 0) {
		sNameError.innerHTML = "Please enter your surname to create an account.";
		return false;
	}
	else if(length > 255) {
		sNameError.innerHTML = "Your name is too long to process. Try using a shorter name.";
		return false;
	}
	else {
		sNameError.innerHTML = "";
		return true;
	}
}
function eAddrCorrect() {
	var eAddr = document.getElementById('emailAddress').value;
	var eAddrError = document.getElementById('emailAddressError');
	var length = eAddr.length;
	if(length == 0) {
		eAddrError.innerHTML = "Please enter your email to create an account.";
		return false;
	}
	else if(length > 254) {
		eAddrError.innerHTML = "This is an invalid email address. Please try again.";
	}
	else {
		var exp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var correct = exp.test(eAddr);
		if(correct == true) {
			eAddrError.innerHTML = "";
			return true;
		}
		else {
			eAddrError.innerHTML = "This is an invalid email address. Please try again.";
			return false;
		}
	}
}
function uNameCorrect() {
	var uName = document.getElementById('userName').value;
	var uNameError = document.getElementById('userNameError');
	var length = uName.length;
	if(length == 0) {
		uNameError.innerHTML = "Please enter a username.";
		return false;
	}
	else if(length < 4 || length > 16) {
		uNameError.innerHTML = "Incorrect number of characters.";
		return false;
	}
	else {
		var exp = /^[0-9a-zA-Z]+$/;
		var valid = exp.test(uName);
		if(valid == true) {
			uNameError.innerHTML = "";
			return true;
		}
		else {
			uNameError.innerHTML = "Field contains illegal characters.";
			return false;
		}
	}
}
function pWordCorrect() {
	var pWord = document.getElementById('passWord').value;
	var pWordError = document.getElementById('passWordError');
	var length = pWord.length;
	if(length == 0) {
		pWordError.innerHTML = "Please enter a password.";
		return false;
	}
	else if(length < 6 || length > 24) {
		pWordError.innerHTML = "Incorrect number of characters.";
		return false;
	}
	else {
		var conPWord = document.getElementById('confirmPassWord').value;
		var conPWordError = document.getElementById('confirmPassWordError');
		pWordError.innerHTML = "";
		if(pWord == conPWord) {
			conPWordError.innerHTML = "";
			return true;
		}
		else {
			conPWordError.innerHTML = "Passwords do not match.";
			return false;
		}
	}
}
