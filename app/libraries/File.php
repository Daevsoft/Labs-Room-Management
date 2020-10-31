<?php
/**
* File class
* Author by Muhamad Deva Arofi
*/
class File
{
	public $dir;
	public $file;
	function __construct()
	{
		$this->dir = 'assets/files';
	}

	function __destruct()
	{

	}

	public function file($filename,$overwrite = TRUE)
	{
		$newdir = $this->dir.Key::CHAR_SLASH.dirname($filename);
		if (!is_dir($newdir)) mkdir($newdir);
		$this->file = fopen($this->dir.Key::CHAR_SLASH.$filename, ($overwrite ? 'w' : 'a'));
		return $this;
	}
	public function close()
	{
		fclose($this->file);
	}
	public function read($filename)
	{
		return readfile($this->dir.Key::CHAR_SLASH.$filename);
	}
	public function insert($value)
	{
		fwrite($this->file, $value);
		return $this;
	}
	public function form($_urlaction)
	{
		echo "<form action=\"$_urlaction\" method=\"post\" enctype=\"multipart/form-data\">";
		return $this;
	}
	public function upload($_postName)
	{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		  if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		  } else {
			echo "File is not an image.";
			$uploadOk = 0;
		  }
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.";
		  $uploadOk = 0;
		}
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		  echo "Sorry, your file is too large.";
		  $uploadOk = 0;
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  $uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return false;
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			  return true;
		  } else {
			  return false;
		  }
		}
	}
	public function end_form()
	{
		echo "</form>";
	}
	public function form_submit()
	{
		echo "<input type=\"submit\">";
	}
	public function form_input($key)
	{
		echo "<input type=\"file\" name=\"$key\" id=\"$key\">";
	}
	public function download($filename = STRING_EMPTY)
	{
		force_download(Key::D_STORAGE.Key::CHAR_SLASH.$filename, basename($filename));
	}
}
