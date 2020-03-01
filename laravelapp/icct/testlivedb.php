<?php
$link = mysql_connect('catscontestsorg1.ipagemysql.com', 'icats_786', '*password*');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_select_db(icct_db);
?>