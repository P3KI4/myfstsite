<?php
require_once("include/config.php");
require_once("include/function.php");

$bd = Connect_db($host, $dbuser, $dbpass, $dbname);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Простейший сайт на php</title>
</head>

<style>
	* {
		margin: 0;
		padding: 0;
	}

	main {
		border: thin solid #999;
		width: 1440px;
		height: auto;
		margin-top: 0;
		margin-right: auto;
		margin-bottom: auto;
		margin-left: auto;
	}

	header {
		background-image: url(headder.jpg);
		background-repeat: no-repeat;
		height: 300px;
		width: 1440px;

	}

	nav {
		background-color: LightGrey;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 100%;
		line-height: 1.8em;
		font-style: normal;
		color: black;
		font-weight: bold;
		text-align: center;
	}

	nav ul {
		list-style-type: none;
		text-align: center;
		text-indent: 45px;
	}

	nav li {
		margin: 0px 8px 8px 8px;
		display: inline;
		width: 1440px;
		height: auto;
	}

	nav li a {
		text-decoration: none;
		color: green;
	}

	nav li a:hover {
		color: yellow;
	}

	aside {
		margin: 5px;
		width: 200px;
		float: left;
		font-family: 'Courier New', Courier, monospace;
		font-size: 130%;
		font-style: normal;
		font-weight: normal;
		color: blue;
		text-align: justify;
		text-indent: 1.5rem;
		margin-right: 5px;

	}

	aside ul {
		list-style-type: none;
		text-decoration: none;
		border: thin solid red;
	}

	aside li {
		display: block;
		margin: 10px 2px 10px 2px;
		text-align: left;
	}

	aside a {
		text-decoration: none;
		color: green;
	}

	aside a:hover {
		text-decoration: underline;
		color: greenyellow;
	}

	#content {
		width: 1215px;
		margin: 5px;
		/*height: 500px;*/
		border: thin solid red;
		float: left;
	}

	#content p {
		margin: 5px;
		text-align: justify;
		width: 236px;
		float: left;
	}

	#content h3 {
		margin: 5px;
	}

	#articlesdb {
		width: 1215px;
		margin: 15px;
	}

	#articlesdb ul {
		list-style-type: none;
	}

	#articlesdb li {
		list-style-type: none;
		margin-top: 10px;
		margin-right: 2px;
		margin-bottom: 10px;
		margin-left: 2px;
		text-align: left;
	}

	footer {
		background-color: gray;
		color: #fff;
		font-family: Arial, Helvetica, sans-serif;
		font-style: normal;
		font-size: 120%;
		padding: 5px;
		clear: both;
		height: 150px;
	}
</style>

<main>
	<header>Это шапка</header>

	<?php
	top_menu(3);

	if ($tr == 1) {
		$tr = top_menu_min_id(3);
		podmenu_left(3);
	} else {
		podmenu_left(3);
	}


	?>


	<div id='content'>
		<h3>Область контента</h3>
		<?php
		if ($tpm != 0) {
			if ($article_id != 0) {
				View_Article(3);
			} else {
				ContentPMArticle(3);
			}
		} else {
			Content();
		}


		?>
	</div>

	<footer>
		это футир
	</footer>

</main>

<body>

</body>

</html>