<?php
/*
UploadiFive
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
*/

// Set the uplaod directory
$uploadDir = '/uploads/';

// Set the allowed file extensions设置允许的文件扩展
$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
// 允许文件扩展名

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
	$targetFile = $uploadDir . $_FILES['Filedata']['name'];

	// 验证文件类型
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		//保存文件
		move_uploaded_file($tempFile, $targetFile);
		echo 1;

	} else {

		// 文件类型是不允许的
		echo '无效的文件类型';

	}
}
?>