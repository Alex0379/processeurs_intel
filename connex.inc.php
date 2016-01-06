<?php
// pour la base dico
function connex($base)
{ try
	{
		$idcom = new PDO('mysql:host=localhost;dbname=magasin;charset=utf8', 'root', '');
		$idcom->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	return $idcom;
}
?>