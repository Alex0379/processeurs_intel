<?php
session_start();
include('entete.html');
include_once("connex.inc.php");
$idcom=connex("magasin");
?>
 
 <!-- Parties tableaux -->
					<div id="conteneur">
						<form action="" method="POST"><br />
								<label>Rechercher un article &nbsp;</label><input type="text" size="auto" name="motcle">
									<label>Catégorie &nbsp;</label><SELECT name="categorie" size="1" style="width:200px">
									<OPTION value="">Toutes</OPTION>
									<OPTION value="Photos">Photos</OPTION>
									<OPTION value="Videos">Videos</OPTION>
									<OPTION value="Informatique">Informatique</OPTION>
									<OPTION value="Divers">Divers</OPTION>
									</SELECT>&nbsp; 
									<label>Trier par &nbsp;: &nbsp;Année &nbsp;: &nbsp;<input id="radioMarque" name ="tri" type="radio" value="nom_a" checked="checked"/> 
									Désignation &nbsp;: &nbsp;<input id="radioPrix" name ="tri" type="radio" value="prix"/></label>
									<input type="submit" value="Rechercher" name="envoi">&nbsp;
						</form><br />
						<div id="ligne"> </div>
						
						
						<?php
					if(isset($_POST['envoi']))
					{
						/****************************/
						// Récupération des saisies */
						/****************************/
						$motcle= $_POST['motcle'];
						$categorie= $_POST['categorie'];
						$tri= $_POST['tri'];
						/****************************/
						// Création de la requete ***/
						/****************************/
						$requete = "SELECT id_article, nom_a, prix FROM article WHERE";
						if($motcle) $requete.=" nom_a LIKE '%$motcle%'";
						if($categorie !="") $requete.=" AND categorie='$categorie'";
						$requete.=(" ORDER BY '%$tri%'");
						$result = $idcom->query($requete);
						while($donnees = $result->fetch())
						{
								echo"<form action=\"panier.php\" method=\"post\">";
								echo"<div class=\"resultat\"><b>" ,$donnees['nom_a'] ,"</b><br />
								Prix unitaire : ",$donnees['prix'] ," &euro; <br />
								Référence : ",$donnees['id_article'] ," <br /> Choisir la quantité :
								<input type=\"text\" name=\"quantite\" size=\"2\"
								maxlenght=\"2\" value=\"0\"/> <input type=\"submit\" value=\"Commander\" />
								<input type=\"hidden\" name=\"id_article\" value=\"",
								$donnees['id_article'],
								"\" /> <input type=\"hidden\" name=\"prix_unit\" value=\"",
								$donnees['prix'],"\" /> <input type=\"hidden\" name=\"nom_a\" value=\"",
								$donnees['nom_a'],
								"\" /></div>";
								echo "<form>";
						}
						$result->closeCursor(); // Termine le traitement de la requète .
					}
				?>
						
					</div>
				
		&nbsp;
<!-- --------- -->

<?php include("footer.html"); ?>