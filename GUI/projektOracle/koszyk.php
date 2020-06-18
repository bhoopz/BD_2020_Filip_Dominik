<!DOCTYPE html>
<?php
include('functions.php');
session_start();
?>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/9a538e0042.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Koszyk</title>
</head>

<body>
    <?php
    include('navbar2.php');
    ?>
    <div class="jumbotron" style="padding: 100px 25px;background-color:#000000;color:white;min-height: 86vh; ">


        <?php
        if (isset($_SESSION['loggedin'])) {
            if (!empty($_SESSION['cart'])) {
                echo "
                <table class='table' style='color:white'>
                <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col' style='text-align:center'>Tytuł</th>
                        <th scope='col' style='text-align:center'>Wykonawca</th>
                        <th scope='col' style='text-align:center'>Cena</th>
                        <th scope='col' style='text-align:center;'>Usuń</th>
                        
                    </tr>
                </thead>
                ";
                $cenaRazem = 0;
                foreach ($_SESSION['cart'] as $key => $product) {
                    $cenaRazem = $cenaRazem + $product[2];
                    
                    echo "
                    <div class='table-responsive-sm'>




                        <tbody>
                            <tr>
                                <td scope='row'><img src='img/$product[3]' style='width:70px;'></td>
                                <td><p style='font-size:2.5vw;text-align:center'>$product[0]</p></td>
                                <td><p style='font-size:2.5vw;text-align:center'>$product[1]</p></td>
                                <td><p style='font-size:2.5vw;text-align:center;'>$product[2]</p></td>
                                <td><p style='font-size:2.5vw;text-align:center;'><a href='koszyk.php?delete_cart=$key'><i class='far fa-trash-alt' id='kosz'></i></a></p></td>
                                
                            </tr>
                        </tbody>
                
                ";
                }
                echo "
                <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><p style='font-size:2.5vw;text-align:right'>Razem:</p></td>
                                <td><p style='font-size:2.5vw;text-align:center'>$cenaRazem zł</p></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>  
                    <input type='hidden' name='cmd' value='_ext-enter'>
                    <form action='https://www.paypal.com/us/cgi-bin/webscr' method='post'>
                    <button class='btn btn-lg w-25' style='background-color:pink;margin-left: 66%' type='submit'>Kup teraz</button> 
                    <input type='hidden' name='cmd' value='_xclick'>
                    <input type='hidden' name='All items cost' value='Item Name'>
                    
                    <input type='hidden' name='amount' value='$cenaRazem'>
                    <input type='hidden' name='currency_code' value='PLN'>
                    
   <input type='hidden' name='business' value='filu4444@gmail.com'>


   </form>
                </div>                     
                ";
        ?>

        <?php
                if (isset($_GET['delete_cart'])) {

                    foreach ($_SESSION['cart'] as $key => $value) {
                        if ($key == $_GET['delete_cart']) {
                            unset($_SESSION["cart"][$key]);
                            echo '<script language="JavaScript">
				
				window.location.href = "koszyk.php";
			</script>';
                        }
                    }
                    
                }
            } else echo "
        <div class='dwa text-center' style='background-color:#000000;min-height: 65vh;'>
        <h6 style='color:white; font-size:4vw;'>Koszyk pusty :( </h6>
        </div>

        ";
        } else header('Location: index.php');

        ?>





    </div>
    <?php include('footer.php'); ?>

    <script>
    
    </script>
</body>

</html>