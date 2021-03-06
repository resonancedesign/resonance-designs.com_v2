<?php
require_once ('core/init.php');
$user = new User();
$username = $user->data()->username;
function GetImageExtension($imagetype) {
	if(empty($imagetype)) return false;
	switch ($imagetype) {
		case 'image/bmp': return '.bmp';
		case 'image/gif': return '.gif';
		case 'image/jpeg': return '.jpg';
		case 'image/png': return '.png';
		default: return false;
	}
}
if (!empty($_FILES['img']['name'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$href = $_POST['href'];
	$external = $_POST['external'];
	$alignment = $_POST['alignment'];
	$data_src = $_POST['data_src'];
	$placement = $_POST['placement'];
	$category = $_POST['category'];
	$file_name = $_FILES['img']['name'];
	$temp_name = $_FILES['img']['tmp_name'];
	$imgtype = $_FILES['img']['type'];
	$ext = GetImageExtension($imgtype);
	$imagename = $_FILES['img']['name'];
	$target_path = '../../imgs/'.$category.'/'.$imagename;

	if(move_uploaded_file($temp_name, $target_path)) {
		$query_upload = mysqli_query($connectMe, "INSERT INTO portfolio (title, description, href, external, alignment, data_src, placement, category, img) VALUES('$title','$description','$href','$external','$alignment','$data_src','$placement','$category','$imagename')") or die (mysqli_error($connectMe));
		
		/* function createThumbs($pathToImages, $pathToThumbs, $thumbWidth) {
	        // open the directory
	        $dir = opendir($pathToImages);

	        // loop through it, looking for any/all JPG files:
	        while(false !== ($fname = readdir($dir))) {
	            // parse path for the extension
	            $info = pathinfo($pathToImages . $fname);
	            // continue only if this is a JPEG image
	            if(strtolower($info['extension']) == 'jpg') {
	                echo "Creating thumbnail for {$fname} <br />";
	                // load image and get image size
	                $img = imagecreatefromjpeg("{$pathToImages}{$fname}");
	                $width = imagesx($img);
	                $height = imagesy($img);

	                // calculate thumbnail size
	                $new_width = $thumbWidth;
	                $new_height = floor($height * ($thumbWidth / $width));

	                // create a new temporary image
	                $tmp_img = imagecreatetruecolor($new_width, $new_height);

	                // copy and resize old image into new image
	                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	                // save thumbnail into a file
	                imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
	            } elseif(strtolower($info['extension']) == 'gif') {
	                echo "Creating thumbnail for {$fname} <br />";

	                // load image and get image size
	                $img = imagecreatefromgif("{$pathToImages}{$fname}");
	                $width = imagesx($img);
	                $height = imagesy($img);

	                // calculate thumbnail size
	                $new_width = $thumbWidth;
	                $new_height = floor($height * ($thumbWidth / $width));

	                // create a new temporary image
	                $tmp_img = imagecreatetruecolor($new_width, $new_height);

	                // copy and resize old image into new image
	                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	                // save thumbnail into a file
	                imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
	            } elseif(strtolower($info['extension']) == 'png') {
	                echo "Creating thumbnail for {$fname} <br />";
	                // load image and get image size
	                $img = imagecreatefrompng("{$pathToImages}{$fname}");
	                $width = imagesx($img);
	                $height = imagesy($img);

	                // calculate thumbnail size
	                $new_width = $thumbWidth;
	                $new_height = floor($height * ($thumbWidth / $width));

	                // create a new temporary image
	                $tmp_img = imagecreatetruecolor($new_width, $new_height);

	                // copy and resize old image into new image
	                imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

	                // save thumbnail into a file
	                imagejpeg($tmp_img, "{$pathToThumbs}{$fname}");
	            }
	        }
	        // close the directory
	        closedir($dir);
	    }
	    // call createThumb function and pass to it as parameters the path
    	// to the directory that contains images, the path to the directory
    	// in which thumbnails will be placed and the thumbnail's width.
    	// We are assuming that the path will be a relative path working
    	// both in the filesystem, and through the web for links
    	createThumbs('../users/'.escape($user->data()->username).'/imgs/','../users/'.escape($user->data()->username).'/thmbs/',100); */
		Redirect::to('../pic_updated.php');
	} else {
		exit("Error while uploading image on the server."); 
	}
}
?>