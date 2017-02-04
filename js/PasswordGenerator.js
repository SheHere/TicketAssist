function generatePassword() {
  var length = 8,
  charset = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ012345678901234567890123456789",
  retVal = 'Be sure to select one of the following that includes an uppercase, lower case, and a number.<br>Note: lowercase L and uppercase O have been removed, due to confusion with numbers 1 and 0.<br><br><span style="font-family: Times New Roman, Times, serif;">';
  for(var j = 0, m = 3; j < m; ++j){
    for (var i = 0, n = charset.length; i < length; ++i) {
      retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    retVal += "<br>";
  }
  retVal = retVal + "</span>";
  swal({
    title: "Generated Passwords", 
		text: retVal,
		html: true
	});
}
