<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div class="header">

		<div class="wrapper">

			<h1><a href="./"><img src="img/logo1.jpg" class="titleimg"></a></h1>

			<ul class="nav">
                <li class="women<?php if ($section == "women") { echo "on"; } ?>"><a href="catalog.php?cat=women">Women</a></li>
                <li class="men<?php if ($section == "men") { echo "on"; } ?>"><a href="catalog.php?cat=men">Men</a></li>
                <li class="kids<?php if ($section == "kids") { echo "on"; } ?>"><a href="catalog.php?cat=kids">Kids</a></li>
                <li class="suggest<?php if ($section == "suggest") { echo "on"; } ?>"><a href="suggest.php">Suggest</a></li>
            </ul>

		</div>

	</div>

	<div id="content">
