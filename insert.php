<?php 

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "";
if(!empty($_POST)) 
{
    $name               = checkInput($_POST['name']);
    $description        = checkInput($_POST['description']);
    $price              = checkInput($_POST['price']);
    $category           = checkInput($_POST['category']); 
    $image             =    checkInput($_FILES['image']['name']);
    $imagePath          =   '../images/'.basename($image);
    $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);

    $isSuccess          = true;
    $isUploadSuccess    = false;

    if(empty($name)) 
        {
            $nameError = 'Bu alan boş kalamaz';
            $isSuccess = false;
        }
        if(empty($description)) 
        {
            $descriptionError = 'Bu alan boş kalamaz';
            $isSuccess = false;
        } 
        if(empty($price)) 
        {
            $priceError = 'Bu alan boş kalamaz';
            $isSuccess = false;
        } 
        if(empty($category)) 
        {
            $categoryError = 'Bu alan boş kalamaz';
            $isSuccess = false;
        }
        if(empty($image)) 
        {
            $imageError = 'Bu alan boş kalamaz';
            $isSuccess = false;
        }else{
               $isUploadSuccess = true;
            
               
               if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ){
                $isUploadSuccess = false;
                   $imageError = "Lutfen Resım formatı png,jpeg,jpg ya gif olmalı...";
               }  
               
               if($_FILES["image"]["size"] > 500000) 
               {
                   $imageError = "Resim bu boyutu geçmemelı 500KB";
                   $isUploadSuccess = false;
               }

               if($isUploadSuccess){
                   if(!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){
                    $imageError = "Oh bilinmeyen bır hata olmuştur";
                    $isUploadSuccess = false;
                   } 

               }
         }

         if($isSuccess && $isUploadSuccess){

            require "database.php";
                           $db = new PDO("mysql:host=$servername;dbname=staf", $username, $password);
                          
            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values(?, ?, ?, ?, ?)");
            $statement->execute(array($name,$description,$price,$category,$image));
     
            header("Location: index.php");


         } 
   
}


function checkInput($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;


}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Personel Yönetimi</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="./styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"> Personel Yönetimi</h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Bir Personel ekle</strong></h1>
                <br>
                <form class="form"   action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Isım:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Isım" value="<?php echo $name;?>">
                        <span class="help-inline"><?php echo $nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="description">Açıklama:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Açıklama" value="<?php echo $description;?>">
                        <span class="help-inline"><?php echo $descriptionError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="price">Fıyat: (€)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Fiyat" value="<?php echo $price;?>">
                        <span class="help-inline"><?php echo $priceError;?></span>
                    </div>
                
                    <div class="form-group">
                        <label for="image">Bir resim seç:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit"  class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ekle</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Geri</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>