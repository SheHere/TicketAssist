/*
 * This function is hosted in the navbar, and is called when Generate Passwords is clicked
 */
function generatePassword() {
    var length = 8,
        charset = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ012345678901234567890123456789",
        retVal = 'Be sure to select one of the following that includes an uppercase, lower case, and a number.<br>Note: lowercase L and uppercase O have been removed, due to confusion with numbers 1 and 0.<br><br><span style="font-family: Times New Roman, Times, serif;">',
        numPasswords = 1,
        nato = "",
        currPassword = "";

    // Generates 3 potential passwords, because they are not guaranteed to be valid
    for(var j = 0, m = numPasswords; j < m; ++j){
        for (var i = 0, n = charset.length; i < length; ++i) {
            currPassword += charset.charAt(Math.floor(Math.random() * n));
        }
        nato = stringToNato(currPassword);
        retVal += "<b>" + currPassword + "</b><br>" + nato + "<br>";
        currPassword = "";
    }
    retVal = retVal + "</span>";
    // SweetAlert popup that displays the passwords
    swal({
        title: "Generated Passwords",
		text: retVal,
		html: true
	});
}

function stringToNato(input) {
    var
        natoArr = ["Alpha", "Bravo", "Charlie", "Delta", "Echo",
            "Foxtrot", "Golf", "Hotel", "India", "Juliet",
            "Kilo", "Lima", "Mike", "November", "Oscar",
            "Papa", "Quebec", "Romeo", "Sierra", "Tango",
            "Uniform", "Victor", "Whiskey", "X-ray", "Yankee",
            "Zulu"
        ],
        alphabet = "abcdefghijklmnopqrstuvwxyz".split('');
        ret = "",
        input = input.toLowerCase(),
        foundLetter = false
    ;

    for (var i=0; i < input.length; ++i) {
        for (var j=0; j < alphabet.length; j++) {
            if (input[i] == alphabet[j]) {
                ret += natoArr[j] + " ";
                foundLetter = true;
            }
        }

        if (!foundLetter) {
            ret += input[i] + " ";
        }

        foundLetter = false;
    }

    return ret;
}