<?php 
if (isset($concert)) {
	foreach($concert as $info) {
		$id_concert = $info->id_concert;
		$artiste = $info->artiste;
		$lieu = $info->lieu;
		$adresse = $info->adresse;
		$ville = $info->ville;
		$date = $info->date;
		$prix = $info->prix;
	}
	$thisDate = substr($date, 0, 10);
	$thisTime = substr($date, -8);
	$thisHour = substr($thisTime, 0, 2);
	$thisMinutes = substr($thisTime, 3, 2);
}
for ($i = 0; $i<24;$i++){
	if ($i>=10) {
		$heure[$i] = $i;
	} else {
		$heure["0".$i] = "0".$i;
	}
}

for ($i = 0; $i<60;$i++) {
	if ($i>=10) {
		$minutes[$i] = $i;
	} else {
		$minutes["0".$i] = "0".$i;
	}
}
?>