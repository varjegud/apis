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
	width: 80em;
	font: 80% Helvetica, Arial, sans-serif;
	background: #f0f0f0;
}
pre { width: 100%; white-space: pre-wrap; }
nav ul { padding: 0 1em 1em; }
nav ul li { list-style: square; margin-left: 1.6em; }
header { background: #fff; padding: 1em; }
#body { display: table; margin: 1em 0; width: 100%; }
#body #menu { display: table-cell; padding-right: 1em; border-right: solid 1px #ccc; }
#body #content { display: table-cell; padding-left: 1em; }
section { padding-bottom: 1em; margin-bottom: 1em; border-bottom: solid 1px #ccc; }
section:last-child { padding-bottom: 0; border-bottom: 0; }
footer { background: #fff; padding: 1em; text-align: center; }
</style>
<body>
<header>
	<h1><?php echo $title ?></h1>
</header>
<div id="body">
	<nav id="menu">
		<h4>Demos</h4>
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
	<div id="content">
		<section>
			<h2>Response</h2>
			<?php echo $content ?>
		</section>
		<section>
			<h3>Source Code</h3>
			<?php echo $code ?>
		</section>
	</div>
</div>
<footer>©2010 Kohana Team</footer>
</body>
</html>