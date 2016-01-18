<html>
<head>
	<title>Html Atomic Secret Finder</title>
	<meta charset="utf-8" />

	<style>
		.table td {
			padding: 3px 10px;
		}
		.table thead td {
			font-weight: bold;
			border-bottom: 1px solid #000;
		}
	</style>

	<script src="<?php echo Url::generate('/js/jquery-1.9.1.min.js'); ?>"></script>

</head>
<body>

<a href="<?php echo Url::generate('/') ?>">Форма поиска</a>
<a href="<?php echo Url::generate('/result') ?>">Результаты</a>

<h3>Результаты парсинга</h3>

<table class="table">
	<thead>
	<tr>
		<td>Host</td>
		<td>Type</td>
		<td>Results</td>
		<td>Actions</td>
	</tr>
	</thead>
	
	<?php foreach ($results as $item) { ?>
	<tr>
		<td><?php echo $item['host'] ?></td>
		<td><?php echo $types[ $item['type'] ] ?></td>
		<td><?php echo $item['count'] ?></td>
		<td><a href="<?php echo Url::generate('/result/view/' . $item['id']) ?>">View</a></td>
	</tr>
	<?php } ?>

</table>

</body>
</html>