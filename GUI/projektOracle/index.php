<!DOCTYPE html>
<?php
session_start();
include('functions.php');
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
	<?php
	if (!isset($_SESSION['loggedin'])) {
		include('navbar.php');
	} else include('navbar2.php');
	?>

	<div class="jumbotron text-center">
		<h1>Your Music Store<img src="img/nuta.png" width="50px"></h1>
		<p>Znajdź swojego ulubionego artystę!</p>
		<form class="form-inline justify-content-center" action="#">
			<div class="input-group">
				<input type="text" class="form-control" id="search" size="50" placeholder="Wpisz czego szukasz" required>
			</div>
		</form>
	</div>

	<div class="row text-center mx-0">
		<div class="col-sm-2 col-lg-4 col-xl-2 pt-5 text-left " style="background-color:#000000;">
			<form style='background-color:pink;color:#000000;'><?php createCheckbox() ?><h8 style="margin-left: 10px; font-size:20px;">Cena:</h8>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Od" id="min">
					<input type="text" class="form-control" placeholder="Do" id="max">
				</div>


			</form>
		</div>
		<div class="col-sm-10 col-lg-8 col-xl-10 pt-5" style="background-color: #000000;min-height: 50vh; ">
			<div class="row" id="list"><?php getAlbums(); ?></div>
		</div>

	</div>
	<?php


	if (isset($_GET['add_cart'])) {
		if (isset($_SESSION['loggedin'])) {
			echo '<script language="JavaScript">
				{alert("Dodano do koszyka");}
				window.location.href = "index.php";
			</script>';

			$_SESSION['id_albumu'] = $_GET['add_cart'];
			global $conn;
			$stid = oci_parse($conn,"select * from albumy INNER JOIN wykonawcy ON albumy.id_wykonawcy = wykonawcy.id_wykonawcy where id_albumu=" . $_GET['add_cart']);
			oci_execute($stid);			
			while ($row = oci_fetch_array($stid)) {
				$_SESSION['tytul'] = $row['TYTUL'];
				$_SESSION['nazwa'] = $row['NAZWA'];
				$_SESSION['cena'] = $row['CENA'];
				$_SESSION['img'] = $row['IMG'];
				$_SESSION['id_albumu'] = $row['ID_ALBUMU'];

				$_SESSION['cart'][] = array(
					$_SESSION['tytul'],
					$_SESSION['nazwa'],
					$_SESSION['cena'],
					$_SESSION['img'],
					$_SESSION['id_albumu']
				);
			}
			echo "<script> refresh () </script>";
		} else {
			echo '<script language="JavaScript">
 
{alert("Proszę się zalogować");}
 
</script>';
		}
	}





	?>

	<?php include('footer.php'); ?>
	<script src="filter.js">
		
	</script>
</body>

</html>