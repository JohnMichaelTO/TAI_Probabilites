<?php
	include("pData.class.php");
	include("pDraw.class.php");
	include("pImage.class.php");
	include("generateData.php");
	$LongueurGraph = 2000;
	$HauteurGraph = 1000;
	
	/* Create and populate the pData object */
	$MyData = new pData();  
	$MyData->addPoints($NbSuicide,"Nombre de suicides");
	$MyData->setAxisName(0,"Nombre de suicides");
	$MyData->addPoints($NbAxe,"Numéro de l'expérience");
	$MyData->setSerieDescription("Months","Month");
	$MyData->setAbscissa("Numéro de l'expérience");

	/* Create the pChart object */
	$myPicture = new pImage($LongueurGraph+100, $HauteurGraph+30, $MyData);

	/* Turn of Antialiasing */
	$myPicture->Antialias = TRUE;

	/* Add a border to the picture */
	$myPicture->drawRectangle(0,0,$LongueurGraph+99,$HauteurGraph+29,array("R"=>0,"G"=>0,"B"=>0));

	/* Set the default font */
	$myPicture->setFontProperties(array("FontName"=>"./pf_arma_five.ttf","FontSize"=>6));

	/* Define the chart area */
	$myPicture->setGraphArea(60,40,$LongueurGraph+50,$HauteurGraph);

	/* Draw the scale */
	$scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
	$myPicture->drawScale($scaleSettings);

	/* Write the chart legend */
	$myPicture->drawLegend($LongueurGraph,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

	/* Turn on shadow computing */ 
	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

	/* Draw the chart */
	$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
	$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
	$myPicture->drawBarChart();

	/* Render the picture (choose the best way) */
	$myPicture->render($fichier . ".png");
?>