<?php
$msg = "";
$timestart = microtime(TRUE);
$directory = "../../appinstaller";
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}
$url = @$_POST["appurl"]."?user=".@$_POST["user"]."&access=".@$_POST["access"];
$hj =  @fopen("$url", 'r');
if(FALSE === $hj){
$msg = "Cannot install the application, make sure you have internet connection and that the app information is correct";
$cc = json_encode(array("status" => "FAILs", "info" => $msg));
echo $cc;
exit;
}
$f = file_put_contents("my-zip.zip", $hj, LOCK_EX);
$zip = new ZipArchive;
$res = $zip->open('my-zip.zip');
if ($res === TRUE) {
  $zip->extractTo($directory);
  $zip->close();
  $timeend = microtime(TRUE);
$time = $timeend - $timestart;
$msg = "Application Installed, Took ".$time." seconds Click lunch app button to lunch the app.";
$cc = json_encode(array("status" => "OK","info" => $msg));
echo $cc;
  @unlink('my-zip.zip');
} else {
  $msg = "Couldn't install the application, make sure you have internet connection";
$cc = json_encode(array("status" => "FAIL","info" => $msg));
echo $cc;
exit;
}	
?>
