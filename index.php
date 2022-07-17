mo<!DOCTYPE html>
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
            <div class="row">
                <h1><strong>Personellerim Listesi   </strong><a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ekle</a></h1>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Isım</th>
                      <th>Görev</th>
                      <th>Maaş</th>
                  
                      <th>Yönet</th>
                    </tr>
                  </thead>

                  <tbody>
<?php

include "./database.php";

$connection = $conn->query('SELECT  items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN
                               categories ON items.category = categories.id ORDER BY items.id DESC');

while($elem = $connection->fetch()){

 echo "<tr>";
 echo "<td>".$elem['name']."</td>";
 echo "<td>".$elem['description']."</td>";
 echo "<td>".$elem['price']." TL</td>";

 echo " <td width='300px'>" ;
 echo ' <a href="view.php?id='.$elem['id'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span>Göz at</a> ';
 echo ' <a href="update.php?id='.$elem['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>Güncelle</a>';
 echo ' <a href="delete.php?id='.$elem['id'].' " class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>Sil</a>';


 echo "</td>";
  
 echo "</tr>";
}


?>






           
                   
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
