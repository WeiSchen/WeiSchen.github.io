<?php
$SYSN["title"] = "This is Magic!";
$SYSN["HEADLINE"] = "Ez magyarul van"; // This is hungarian
$SYSN["FEAR"] = "Bell in my heart";
?>

index.php:
<?php
include("variables.php");
include("template.html");
?>

The template:
template.html

<html>
<head><title><?=$SYSN["title"]?></title></head>
<body>
<H1><?=$SYSN["HEADLINE"]?></H1>
<p><?=$SYSN["FEAR"]?></p>
</body>
</html>
