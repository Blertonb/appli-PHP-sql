<?php
    session_start();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>
    <ul class="menu">
        <li class= menu-items><a class="menu-links" href="admin.php">HOME</a></li>
        <li class= menu-items><a class="menu-links"href='index.php'>PRODUCT</a></li>
        <li class= menu-items ><a  class="menu-links" href="recap.php">SUMMARY</a></li>
    </ul>
    <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p>Aucun produit en session...</p>";
    }
    else{
        echo "<table>",
                "<thead>",
                    "<tr>",
                        "<th></th>",
                        "<th class='text-success text-center'>Nom</th>",
                        "<th class='text-success text-center'>Prix</th>",
                        "<th class='text-success text-center'>Quantité</th>",
                        "<th class='text-success text-center'>Total</th>",
                    "</tr>",
                "</thead>",
                "<tboody>" ;
        $totalGeneral = 0;
        foreach($_SESSION['products'] as $index => $product){
            $total=$product['price']*$product['qtt'];//calcul concernant la condition mise en place,cela concerne l'augamentation du prix a chaque ajout sur un produit en rajoutant $total.
            //on a egalement calculer le product du price * le production quantité.
            
            echo "<tr>" ,
                    "<td class='text-center'>".$index."</td>",
                    "<td class='text-center'>".$product['name']."</td>",
                    "<td class='text-center'>".number_format($product['price'], 2, ", ", "&nbsp;"). "&nbsp;€</td>",
                    "<td class='text-center'>".$product['qtt']."</td>",//ajouter "qtt" ! 
                    "<td class='text-center'>".number_format($total, 2, ", ", "&nbsp;"). "&nbsp;€</td>",
                    "<td><a href='traitement.php?action=supprimer&id=".$index."' class='btn btn-dark btn-sm'><i class='bi-trash'>Supprimer</i></a></td>", //creer un nv <td> qui est relier a traitement.php,à l'utilisateur de supprimer un produit en session.
                    "<td><a href='traitement.php?action=plus&id=".$index."' class='btn btn-success btn-sm'><i class='bi-trash'>+</i></a></td>",//déclarer les boutons dans recap,afin de pouvoir les afficher sur le navigateur.
                    "<td><a href='traitement.php?action=moins&id=".$index."' class='btn btn-danger btn-sm'><i class='bi-trash'>-</i></a></td>",//déclarer les boutons dans recap,afin de pouvoir les afficher sur le navigateur.
                 "</tr>";
            $totalGeneral+= $total;//ajouter au totalGeneral,la variable $total creer tout au debut au niveau du calcul.
        }
        echo "<tr>",
                "<td  colspan=4>Total général : </td>",
                "<td  class='text-danger'><strong>".number_format($totalGeneral, 2, ", ","&nbsp;"). "&nbsp;€</strong></td>",
                "<td><a href='traitement.php?action=vider' class='btn btn-warning btn-sm'><i class='bi-trash'>Vider panier</i></a></td>",//toujours déclarer ce qu'on veut afficher dans la page du panier.
            "</tr>",
        "</tbody>";

    }
    

?>
</body>
</html>