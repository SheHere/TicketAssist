<?php
/**
 * Created by PhpStorm.
 * User: sche0210
 * Date: 3/3/2017
 * Time: 12:35 PM
 */
$str1 = "class=\"panel-collapse collapse in\"";
$str2 = str_replace("class=\"panel-collapse collapse in\"", "class=\"panel-collapse collapse\"", $str1);
echo $str2;


?>