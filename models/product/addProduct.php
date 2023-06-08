<?php
include_once ("../../config/connection.php");
if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['price']) && !empty($_POST['price']) && isset($_POST['onSale']) && isset($_FILES['image'])) {
    $src = $_FILES['image']['name'];
    $alt = explode(".", $_FILES['image']['name'])[0];
    $title = $_POST['title'];
    $price = (int)$_POST['price'];
    $onSale = (int)$_POST['onSale'];
    try{
        global $conn;
        $query=$conn->prepare("INSERT INTO products(title,src,alt,price,onSale) VALUES (?,?,?,?,?)");
        $query->execute([$title,$src,$alt,$price,$onSale]);
        $imageName= $_FILES["image"]['name'];
        $tmpImageName= $_FILES["image"]['tmp_name'];
        move_uploaded_file($tmpImageName,dirname(__DIR__,2)."/assets/img/".$imageName);
        $newHeight = 100;
        mime_content_type(dirname(__DIR__,2)."/assets/img/".$imageName);
        list($width,$height)=getimagesize(dirname(__DIR__,2)."/assets/img/".$imageName);
        $percentageOfChange = $newHeight/$height;
        $newWidth = $width*$percentageOfChange;
        $thumb = imagecreatetruecolor($newWidth,$newHeight);
        $source = imagecreatefromwebp(dirname(__DIR__,2)."/assets/img/".$imageName);
        imagecopyresized($thumb,$source,0,0,0,0,20,$newHeight,$width,$height);
        imagepng($thumb,dirname(__DIR__,2)."/assets/img/small-".$imageName);
        imagedestroy($thumb);
        $msg="Product successfully added!";
        header("Location: ../../index.php?page=adminPanel&adminPage=products&msg=".$msg);

    }
    catch (PDOException $ex){
        var_dump($ex);
    }
}
else{
    $error = "Fill all columns!";
    header("Location: ../../index.php?page=adminPanel&adminPage=products&error=".$error);
    die();
}



