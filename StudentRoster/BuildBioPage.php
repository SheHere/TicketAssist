<?php
/*
<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->
*/
function buildBioPage() {
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$output = "";


	$sql = "SELECT username, fname, lname, bio, img_path, role
					FROM users INNER JOIN login USING(username)
					ORDER BY lname ASC";
	$result = mysqli_query($con, $sql);

	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo 'ERROR';
		echo mysqli_error($con);
	}

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$cur_user = $row['username'];
			if ($row['role'] == 1) {
				$badges = "<!-- No Badges -->";
				//Second query that grabs the badges that the user has
				$sql2 = "SELECT *
						 FROM badges_held JOIN badges USING(id)
						 WHERE username LIKE '$cur_user'
						 ;";
				$result2 = mysqli_query($con,$sql2);
				if(mysqli_num_rows($result2) != 0) {
					$badges = '<p style="text-align: center;">';
					while($row2 = mysqli_fetch_assoc($result2)) {
						$badgeName = $row2['name'];
						$badgeIcon = $row2['icon'];
						$fixedBadge = str_replace('-5x', '-2x', $badgeIcon);
						$badges .= '
						<span data-toggle="tooltip" title="'.$badgeName.'">
							<i class="'.$fixedBadge.'" aria-hidden="true"> </i>
						</span>';
					}
					$badges .= "</p>";
				}

				$output .=
						'<tr>'
							. '<div class="table">'
								. '<img src="' . $row['img_path'] . '" class="image">'
								. '<div class="name">';
				if (empty($row['fname']) && empty($row['lname'])) {
					$output .= $cur_user;
				} else {
					$output .= $row['fname'] . ' ' . $row['lname'];
				}
				if(strcmp('',$row['bio']) == 0){
					$toPrint = "<p>This user hasn't added a bio yet, but they definitely love working at the Tech Desk!</p>";
				}else{
					$toPrint = html_entity_decode($row['bio']);
				}
				$output .=
									'</div>'
								. '<div class="about">'
									. $toPrint
								. '</div>'
								. '<div class="badges">'
									. $badges
								. '</div>'
							. '</div>';
			}
		}
	}
	echo $output;
}
