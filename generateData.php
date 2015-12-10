<?php
	$Echantillon = 100000;
	$NombreExperience = 100;
	$P = 19.6 / $Echantillon;
	
	for($i = 0; $i < $NombreExperience; $i++)
	{
		$NbSuicide[$i] = 0;
		$NbAxe[$i] = $i + 1;
	}
	
	$tableau = "\n\nN° | Nombre de suicides sur un &eacute;chantillon de $Echantillon | Moyenne\n";
	$tableau .= "----------------------------------------------------------------------\n";
	
	$excel = "";
	
	for($i = 0; $i < $NombreExperience; $i++)
	{
		for($j = 0; $j < $Echantillon; $j++)
		{
			if((mt_rand(0, $Echantillon-1) / $Echantillon) < $P)
			{
				$NbSuicide[$i]++;
			}
		}
		$MoyennePartielle[$i] = $NbSuicide[$i] / $Echantillon;
		$tableau .= "" . ($i + 1) . "\t|\t$NbSuicide[$i]\t|\t$MoyennePartielle[$i]\n";
		$excel .= "$NbSuicide[$i]\n";
	}
	
	$NbSuicideTotal = array_sum($NbSuicide);
	$SommeMoyennePartielle = array_sum($MoyennePartielle);
	$Moyenne = $NbSuicideTotal / $NombreExperience;
	
	$tableau .= "----------------------------------------------------------------------\n";
	$tableau .= "Somme\t|\t$NbSuicideTotal\t|\t$SommeMoyennePartielle";
	
	$donnees = "Echantillon = $Echantillon\n";
	$donnees .= "Nombre d'exp&eacute;rience = $NombreExperience\n";
	$donnees .= "Moyenne totale = $NbSuicideTotal / $NombreExperience = $Moyenne";

	$donnees = html_entity_decode($donnees);
	$tableau = html_entity_decode($tableau);
	
	$fichier = "experiences/" . date('d-m-Y_His');
	
	$fp = fopen($fichier . ".txt", 'w+');
	if($fp)
	{
		fputs($fp, $donnees);
		fputs($fp, $tableau);
	}
	fclose($fp);
	
	$fp = fopen($fichier . "_export.txt", 'w+');
	if($fp)
	{
		fputs($fp, $excel);
	}
	fclose($fp);
?>