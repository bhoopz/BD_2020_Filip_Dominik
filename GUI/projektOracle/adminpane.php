<!DOCTYPE html>
<?php
include('functions.php');
session_start();
?>
<html lang="pl">

<head>
    <title>Your Music Store</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/9a538e0042.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container text-center" style="background-color:#000000; min-height:100vh; min-width:100%;color:white;">
        <h1 style="color:white; font-size:4vw;padding:20px">Witaj w panelu administratora Your Music Store </h1><a href="index.php"><img src="img/logo2.png" alt="LOGO" width="100px"></a>

        <div class="btn-group-vertical" style="width:100%;margin-top:50px;">

            <a style='margin: 0 auto; width:25%' href='adminpane.php?wykonawca'><button class='btn btn-lg w-100 mb-4' style='background-color:pink;margin: 0 auto;' type='submit'>Dodaj wykonawce</button></a>
            <a style='margin: 0 auto; width:25%' href='adminpane.php?gatunek'><button class='btn btn-lg w-100 mb-4' style='background-color:pink;margin: 0 auto;' type='submit'>Dodaj gatunek muzyczny</button></a>
            <a style='margin: 0 auto; width:25%' href='adminpane.php?addAlbum'><button class='btn btn-lg w-100 mb-4' style='background-color:pink;margin: 0 auto;' type='submit'>Dodaj album</button></a>
            <a style='margin: 0 auto; width:25%' href='adminpane.php?deleteAlbum'><button class='btn btn-lg w-100 mb-4' style='background-color:pink;margin: 0 auto;' type='submit'>Usuń album</button></a>
            <a style='margin: 0 auto; width:25%' href='adminpane.php?policz'><button class='btn btn-lg w-100 mb-4' style='background-color:pink;margin: 0 auto;' type='submit'>Ilość albumów</button></a>
            <div class="form-group " style="width:25%; margin: 0 auto;">


                <?php
                if (isset($_SESSION['admin']) && isset($_SESSION['loggedin'])) {
                    if (isset($_GET['wykonawca'])) {
                        echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Nazwa wykonawcy' name='nazwa' required>
            <button class='btn btn-lg w-100' style='background-color:pink;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                global $conn;
                $nazwa = $_POST['nazwa'];
                $stid = oci_parse($conn, "begin dodajwykonawce(:nazwa); end;");
                oci_bind_by_name($stid, ":nazwa", $nazwa);
                
                if (oci_execute($stid) === TRUE) {
                    echo "Dodano nowy rekord";
                  } else {
                    echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
                  }
            }
                    }
                    if (isset($_GET['gatunek'])) {
                        echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Nazwa gatunku' name='gatunek' required>
            <button class='btn btn-lg w-100' style='background-color:pink;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                global $conn;
                $gatunek = $_POST['gatunek'];
                $stid = oci_parse($conn, "begin dodajgatunek(:nazwaGatunku); end;");
                oci_bind_by_name($stid, ":nazwaGatunku", $gatunek);
                if (oci_execute($stid) === TRUE) {
                    echo "Dodano nowy rekord";
                  } else {
                    echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
                  }
            }
                        




                    }
                    if (isset($_GET['addAlbum'])) {
                        echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Tytuł albumu' name='tytul' required>
            <input class='form-control' type='text' placeholder='Id wykonawcy' name='id_wykonawcy' required>
            <input class='form-control' type='text' placeholder='Id gatunku' name='id_gatunku' required>
            <input class='form-control' type='text' placeholder='Rok wydania albumu' name='rok' required>
            <input class='form-control' type='text' placeholder='Cena' name='cena' required>
            <input class='form-control' type='text' placeholder='Nazwa zdjęcia' name='img' required>
            <small class='text-muted'>*zdjęcia powinny znajdować się w folderze ../img</small>
            <button class='btn btn-lg w-100' style='background-color:pink;' type='submit'>Dodaj</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                global $conn;
                $tytul = $_POST['tytul'];
                $id_wykonawcy = $_POST['id_wykonawcy'];
                $id_gatunku = $_POST['id_gatunku'];
                $rok = $_POST['rok'];
                $cena = $_POST['cena'];
                $img = $_POST['img'];
                $stid = oci_parse($conn, "begin dodajalbum(:tytul, :id_wykonawcy, :id_gatunku, :rok, :cena, :img); end;");
                oci_bind_by_name($stid, ":tytul", $tytul);
                oci_bind_by_name($stid, ":id_wykonawcy", $id_wykonawcy);
                oci_bind_by_name($stid, ":id_gatunku", $id_gatunku);
                oci_bind_by_name($stid, ":rok", $rok);
                oci_bind_by_name($stid, ":cena", $cena);
                oci_bind_by_name($stid, ":img", $img);
                if (oci_execute($stid) === TRUE) {
                    echo "Dodano nowy rekord";
                  } else {
                    echo "Błąd w dodawaniu rekordu <br> Sprawdź czy podałeś poprawne dane";
                  }
            }

        }





                    
                    if (isset($_GET['deleteAlbum'])) {
                        echo "
            <form method='POST' style='margin 0 auto;padding-top:30px'>
            <input class='form-control' type='text' placeholder='Id albumu który chcesz usunąć' name='id' required>
            <button class='btn btn-lg w-100' style='background-color:pink;' type='submit'>Usuń</button>
            </form>
            
            ";
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                global $conn;
                $id = $_POST['id'];
                $stid = oci_parse($conn, "begin usunalbum(:id_albumu_in); end;");
                oci_bind_by_name($stid, ":id_albumu_in", $id);
                
                if (oci_execute($stid) === TRUE) {
                    echo "Pomyślnie usunięto";
                  } else {
                    echo "Nie ma takiego id w bazie";
                  }
                    
                } 
            }
            if (isset($_GET['policz'])){
              $stid = oci_parse($conn, "begin :r := ile_albumow(); end;");
              oci_bind_by_name($stid, ':r', $r, 500);
              oci_execute($stid);
              echo "
              <h1>$r</h1>
              ";

            }



        }else header('Location: index.php');
                ?>




            </div>
        </div>


    </div>






</body>

</html>