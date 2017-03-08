<?php
function checkDateDood() {
  $localtime = localtime(time(), true);

  // Hardy har it's April fools day
  if ($localtime['tm_mon'] == 3 && $localtime['tm_mday'] == 1) {
    echo '<link rel="stylesheet" href="'.$_SERVER["SERVER_ROOT"].'/styles/meme.css">';
      return true;
  } else {
    return false;
  }
}

function randomMemesDood() {
  $random = rand(400,499);

  // 1/100 chance to blaze it
  if ($random == 420) {
    echo '<link rel="stylesheet" href="'.$_SERVER["SERVER_ROOT"].'/styles/meme.css">';
    return true;
  } else {
    return false;
  }
}
?>
