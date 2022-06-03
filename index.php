<?php

$nickname="";
$pin="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$odg=$_POST;
	if (empty($odg["nickname"]))  {
        	echo "Korisnicki račun nije unesen.";
		
    		}
	else if (empty($odg["pin"]))  {
        	echo "Lozinka nije unesena.";
		
    		}
	else {
		$nickname= $odg["nickname"];
		$pin= $odg["pin"];
	
		provjera($nickname,$pin);
	}
}


function provjera($nickname, $pin) {
	
	$xml=simplexml_load_file("lista.xml");
	foreach ($xml->user as $usr) {
  	 	$usrn = $usr->name;
		$usrs = $usr->surname;
		$usrd = $usr->dob;
		$usrnn = $usr->nickname;
		$usrpin = $usr->pin;
		if($usrnn==$nickname){
			if($usrpin == $pin){
				echo " Prijavljeni ste kao $usrn $usrs. " .godine($nickname);
				return;
				}
			else{
				echo "Netočna lozinka";
				return;
				}
			}
		}
	echo "Korisnik ne postoji.";
	return;
}

function godine($nickname) {

    $god=simplexml_load_file("lista.xml");
    foreach ($god->user as $kor) {
		$nick = $kor->nickname;
		$birthDate = $kor->dob;
		if ($nick==$nickname){
        	$currentDate = date("Y-m-d");
        	$age = date_diff(date_create($birthDate), date_create($currentDate));
        	echo "Vaša dob je: ".$age->format("%y");
		}
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Luka Petrović - 0007178019 - Informatički dizajn</title>
</head>
<body action="" method="post">
    <form>
        <br><label for="nickname">Nadimak:</label><br>
        <input type="text" id="nickname" name="nickname"><br>
        <label for="pin">PIN:</label><br>
        <input type="password" id="pin" name="pin"><br><br>
        <input type="submit" name="submit" formmethod="post" formaction="" value="Pošalji"><br><br>
    </form>
    <div>
        Luka Petrović - 0007178019 - Informatički dizajn
    </div>
</body>
</html>