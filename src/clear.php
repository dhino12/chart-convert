<?php

use LDAP\Result;

include 'script/functions.php';

$result = clearData();
if ($result === 0) {
    header("Location: index.php");
}
?>