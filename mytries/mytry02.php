<html>
<head>
  <title>PHP ����01</title>
</head>
<body>

<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE) {
?>
<h3>strpos() �϶�û�з��ؼ� (FALSE)</h3>
<p>����ʹ�� Internet Explorer</p>
<?php
} else {
?>
<h3>strpos() �϶����ؼ� (FALSE)</h3>
<center><b>û��ʹ�� Internet Explorer</b></center>
<?php
}
?> 

</body>
</html> 