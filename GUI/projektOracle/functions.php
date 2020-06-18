<?php

$conn = oci_connect('system', 'oracle', '//localhost/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

function getAlbums()
{
	global $conn;	
	$stid = oci_parse($conn, 'select * from albumy INNER JOIN wykonawcy ON albumy.id_wykonawcy = wykonawcy.id_wykonawcy INNER JOIN gatunek ON albumy.id_gatunku = gatunek.id_gatunku  order by tytul asc');
	oci_execute($stid);	
	while ($row = oci_fetch_array($stid)) {		
		$id_albumu = $row['ID_ALBUMU'];
		$tytul = $row['TYTUL'];
		$id_wykonawcy = $row['ID_WYKONAWCY'];
		$id_gatunku = $row['ID_GATUNKU'];
		$rok = $row['ROK'];
		$cena = $row['CENA'];
		$img = $row['IMG'];
		$nazwa = $row['NAZWA'];
		$nazwaGatunku = $row['NAZWAGATUNKU'];
		
		echo "
				<div class='col-sm-12 col-md-12 col-lg-6 col-xl-4' id='inside' data-name='$tytul' data-gatunek='$nazwaGatunku' data-cena='$cena' data-nazwa='$nazwa'>
							<div class='productinfo text-center '>
								<img src='img/$img' style='width:250px;height:250px'  class='img-fluid rounded' />
								<h2 style='font-size:20px'><br><b>$tytul</b></h2><br>
								<h2 style='font-size: medium'><b>$nazwa</b></h2><br>
								<p><b>$cena zł</b></p><br>
								<a href='index.php?add_cart=$id_albumu' class='btn add-to-cart' name='add_to_cart'>Dodaj do koszyka</a>
							</div>

			</div>
				";
	}

}

function createCheckbox()
{
	global $conn;
	$stid = oci_parse($conn,'select nazwaGatunku from gatunek order by nazwaGatunku asc');
	oci_execute($stid);
	while ($row = oci_fetch_array($stid)) {
		$nazwa = $row['NAZWAGATUNKU'];
		echo "
		<div class='list-group-item checkbox ' style='background-color:pink'>
            <label><input type='checkbox' name='gatunek' value='$nazwa' id='checkbox' > $nazwa</label>
        </div>
		";
	}
}

function cartDelete(){
	
	if (!empty($_SESSION["cart"])) {
		foreach ($_SESSION["cart"] as $product => $val) {
			if($val["id_albumu"] == $_SESSION['id_albumu'])
			{
				unset($_SESSION["cart"][$product]);
			}
		}
	}
}


