<?php
/*
 * Guide Image Uploader
 * --------------------
 * Author: Nick Scheel
 * Input: image file, integer id#
 * Note: the echo statements throughout are for bug testing only.
 *
 * 1. Sets input values to static variables
 * 2. Check if folder for the guide already exists.
 *    2a. If the folder does not exist, create it.
 * 3. Generate a random 10 character string.
 * 4. Produce file name
 * 		4a. Generate random 10 character string
 *		4b. Detach extension
 * 		4c. Attach random string to name and hash with crc32b
 * 		4d. Reattach extension
 * 4. Check if extension is valid.
 * 		4a. If not valid, throw error alert and do not continue
 * 5. Upload image
 * 6. Return image path to TinyMCE dialogue box
 *
 */
echo "begin page; <br>";
// If no file received, do not do anything
if(isset($_FILES)) {
	// 400kb limit
	if($_FILES['file']['size'] < 400000){
		echo "image found; <br>";
		$id = $_REQUEST['guideID'];
		$image = $_FILES['image'];
		$tmpName = $image['tmp_name'];
		$path = $_SERVER['DOCUMENT_ROOT'] . '/guides/images/guide' . $id . '/';
		// Check if folder for the guide exists. If not, create one.
		if (!file_exists($path)) {
			echo "creating folder: ";
			if (mkdir($path, 0777, true)) {
				echo "success; <br>";
			}
		}

		//Generate random string for uniqueness
		echo "Generating random string; <br>";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randstring = '';
		for ($i = 0; $i < 10; $i++) {
			$randstring = $characters[rand(0, strlen($characters))];
		}
		$toHash = $randstring . str_replace(' ', '-', $image['name']);


		// Seperate on ".", pop off last element of exploded array, set to lower case
		$ext = strtolower(array_pop(explode('.', $image['name'])));

		// Check if extension is valid. If not, do not upload and throw alert
		$allowedExts = array('gif', 'jpg', 'jpeg');
		if (in_array($ext, $allowedExts)) {
			$name = hash("crc32b", $toHash);
			echo "File name: " . $name . "; <br>";
			move_uploaded_file($tmpName, $path . '/' . $name . '.' . $ext);
			echo "File uploaded; <br>";
			$weburl = '/guides/images/guide' . $id . '/' . $name . '.' . $ext;
			echo "<script>top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('" . $weburl . "').closest('.mce-window');</script>";
		} else {
			echo "
		<script> 
		parent.alert('Invalid file type. Allowed: .gif, .jpeg, .jpg');
		</script>";
		}
	}
	else{
		echo "
		<script> 
		parent.alert('File size too large. Max size: 400KB');
		</script>";
	}
}
