
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
    <h1 class="text-logo">PERSONEL YÖNETİM SİSTEMİ</h1>
         <div class="container admin">



<?php

include "database.php";

if(!empty($_GET['id'])){

     $elemid = htmlspecialchars($_GET['id']);
    
     $recuper =  $conn->prepare('SELECT  items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN
     categories ON items.category = categories.id WHERE items.id = ?');
     $recuper->execute(array($elemid));

     $line = $recuper->fetch();

     while( $line > 0 ){

      echo  ' <div class="row"> ';
      echo  ' <div class="col-sm-6"> ';
      echo  '    <h1><strong>Personeli Profili</strong></h1>';
      echo  '     <br>';
      echo  '      <form>';
      echo  '      <div class="form-group">';
      echo  '        <label>Isım:</label> '.$line["name"];
      echo  '      </div>';
      echo  '      <div class="form-group">';
      echo  '       <label>Görev:</label>'.$line["description"];
      echo  '      </div>';
      echo  '      <div class="form-group">';
      echo  '        <label>Maaş:</label>'.' $'.$line["price"];
      echo  '       </div>';

      echo  '    </form>';
      echo  '    <br>';
      echo  '    <div class="form-actions">';
      echo  '     <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Geri</a>';
      echo  '    </div>';
      echo  ' </div> ';
      echo  ' <div class="col-sm-6 site">';
      echo  '     <div class="thumbnail">';
      echo  '     <img src="./images/'.$line["image"].'" alt="...">';
      echo  '      <div class="price">'.' $'.$line["price"].  '</div>';
      echo  '        <div class="caption">';
      echo  '          <h4>'.$line["name"]. '</h4>';

      echo  '           <a href="#" class="btn btn-order" role="button" style="font-size:18px">  '.$line["description"]. '</span>    </a>';
      echo  '         </div>';
      echo  '   </div>';
      echo  '  </div>';
      echo  '</div>';

     return  $line = 1;
     }




}else{

    echo "Ürün Bulunmadı";
}



?>










</div>   
    </body>
</html>


