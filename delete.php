<?php 
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    
}


if(isset($_POST['sbmt'])){ 
    
    require("database.php");
    $conn  = new PDO("mysql:host=$servername;dbname=staf", $username, $password);
    $getElem = $conn->prepare('DELETE  FROM items WHERE id = ?');
    $getElem->execute(array($id));

        header("Location: index.php");
          echo "<script>window.location.href='index.php';</script>";

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="./styles.css">
    <title>Personel Çıkar</title>
</head>
<body>
<br><br><br><br><br><br><br>


<form role="form" method="post" action="<?php echo 'delete.php?id='. $id; ?>" style="width:500px;height:100px;background-color:white;margin:0 auto;padding:20px">

 <div> Bu personeli çıkarmak istediğinize emin misinz?</div>

 <button type="submit" name="sbmt"  class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>Sil</button>

 <button><a href="index.php">Geri</a></button>
</form>
    
</body>
</html>