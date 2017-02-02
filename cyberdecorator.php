<?

$target_dir = "uploads/user_file.jpg";
$uploadOk = 1;
$imageFileType = pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);
$image_info = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
$image_width = $image_info[0];
$image_height = $image_info[1];
$image_size = $_FILES["fileToUpload"]["size"];

if($image_width < $image_height) {
  $height = "auto";
  $width = "100%";
} else {
  $height = "100%";
  $width = "auto";
}

// Check file format
if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
    $error = "Sorry, only JPG files are allowed";
    $uploadOk = 0;
}

 // Check file size
if ($image_size > 500000 || $image_size == 0) {
    $error = "Sorry, your file is too large";
    $uploadOk = 0;
}


if($uploadOk == 1) {
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir);
}

$python = `/home/ezchecks/python27/Python-2.7.12/python cyberdecorator.py`;
$result = json_decode($python, true);

$clr_1 = dechex(round($result[0][0])) . dechex(round($result[0][1])) . dechex(round($result[0][2]));
$clr_2 = dechex(round($result[1][0])) . dechex(round($result[1][1])) . dechex(round($result[1][2]));
$clr_3 = dechex(round($result[2][0])) . dechex(round($result[2][1])) . dechex(round($result[2][2]));

$rnd = rand();

?>

<html>
  <head>
    <title>CyberDecorator</title>
  
    <style type="text/css">
    
      form {
        padding-top: 10px;
        padding-bottom: 30px;
      }
      
      #instructions {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 100%;
        padding-bottom: 15px;      
      }
      
      #error {
        font-family: Arial, Helvetica, sans-serif;
        color: #FF0000;
        font-size: 100%;
      }
      
      #color_box {
        border: 1px solid lightgray;
        height: 75px;
        width: 75px;
      }
      
    </style>
  
  </head>
  
    <body align="center">
    
      <h1><font face="verdana">CyberDecorator</font></h1>
      
      <div id="error"><? echo $error; ?>&nbsp;</div>
      
      <form action="cyberdecorator.php" method="post" enctype="multipart/form-data" padding-top="20px">
        <div id="instructions">Upload image - JPG only</div>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload" name="submit">
      </form>
      
      <table align="center">
      
        <tr>
          <td rowspan="3" width="225px" height="225px" background="uploads/user_file.jpg?rnd=<? echo $rnd; ?>" style="background-size: <? echo $height . " " . $width; ?>; background-repeat: no-repeat;"></td>
          <td id="color_box" bgcolor="#<? echo $clr_1; ?>">&nbsp;</td>
        </tr>
        <tr>
          <td id="color_box" bgcolor="#<? echo $clr_2; ?>">&nbsp;</td>
        </tr>
        <tr>
          <td id="color_box" bgcolor="#<? echo $clr_3; ?>">&nbsp;</td>
        </tr>
        
      </table>

    </body>

</html>
