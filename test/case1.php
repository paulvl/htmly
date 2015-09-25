<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Test</title>

</head>

<body>
	
	<?php

		use Htmly\Htmly;

		$htmly = new Htmly;

		echo $htmly->div([
			'content' => 'this is a parent div',
			'class' => ['bold', 'asd'],
			'style' => ['color:red;']
		])->div([
			'content' => 'this is a 2 div',
			'class' => ['bold', 'asd'],
			'style' => ['color:green;'],	
			'child' => Htmly::a([
				'content' => 'this is an a child',
				'href' => 'http://google.com',
				'target' => '_blank',
				'style' => ['color:blue;'],
				])
		])->print();
		
	?>

</body>

</html>

