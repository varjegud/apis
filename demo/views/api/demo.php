<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title ?></title>
</head>
<style>
/* Makeshift CSS Reset */
{ margin: 0; padding: 0; }
/* Render HTML5 elements as blocks */
header, footer, aside, nav, article { display: block; }
body {
	margin: 0 auto;
	width: 60em;
	font: 80% Helvetica, Arial, sans-serif;
	background: #f0f0f0;
}
nav h2 { font-size: 1em; }
nav ul { padding: 0 1em 1em; }
nav ul li { list-style: square; margin-left: 1.6em; }
header { background: #fff; padding: 1em; }
#body { display: table; margin: 1em 0; }
#body nav { display: table-cell; padding-right: 1em; border-right: solid 1px #ccc; }
#body section { display: table-cell; padding-left: 1em; }
footer { background: #fff; padding: 1em; text-align: center; }
</style>
<body>
<header>
	<h1><?php echo $title ?></h1>
</header>
<div id="body">
	<nav>
		<h2>Demos</h2>
		<?php if ( ! $demos): ?>
		<p>No demos available. Try enabling a provider API.</p>
		<?php else: ?>
		<ul>
		<?php foreach ($demos as $demo => $link): ?>
		<li><?php echo HTML::anchor($link, $demo) ?></li>
		<?php endforeach ?>
		</ul>
		<?php endif ?>
	</nav>
	<section>
		<?php echo $content ?>
	</section>
</div>
<footer>©2010 Kohana Team</footer>
</body>
</html>