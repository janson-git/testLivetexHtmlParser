<html>
<head>
	<title>Html Atomic Secret Finder</title>
	<meta charset="utf-8" />
	
	<style>
		#search-text-field, #status-message {
			display: none;
		}
		.header {
			width: 200px;
		}
	</style>

	<script src="<?php echo Url::generate('/js/jquery-1.9.1.min.js'); ?>"></script>

</head>
<body>

	<a href="<?php echo Url::generate('/') ?>">Форма поиска</a>
	<a href="<?php echo Url::generate('/result') ?>">Результаты</a>
	
	<h3>Укажите параметры поиска</h3>
	
	<div id="status-message"></div>
	
	<form action="" method="post" id="search-form">
		
		<table>
			<tr>
				<td class="header">URL for search:</td>
				<td class="field"><input type="text" name="search_url" value="" /></td>
			</tr>
			<tr>
				<td>Search type:</td>
				<td>
					<select name="search_type" id="search-type-select">
						<option value="0">Links</option>
						<option value="1">Images</option>
						<option value="2">Text</option>
					</select>
				</td>
			</tr>
			<tr id="search-text-field">
				<td>Введите текст поиска:</td>
				<td><input type="text" name="search_text" value="" /></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Search" />
				</td>
			</tr>
		</table>
		
		
	</form>


	<script>
		var TEXT_SEARCH = 2;
		$(function() {
			$("#search-type-select").change(function() {
				var value = $(this).val();
				if (value == TEXT_SEARCH) {
					$("#search-text-field").show();
				} else {
					$("#search-text-field").hide();
				}
			})
		})
		
		$("#search-form").submit(function() {
			var url  = $("input[name='search_url']").val();
			var type = $("#search-type-select").val();
			var text = '';
			if (type == TEXT_SEARCH) {
				var text = $("input[name='search_text']").val();
			}
			
			// VALIDATE
			var valid = true;
			var error = '';
			if (url.length == 0) {
				error = error + "\nURL must not be empty!";
				valid = false;
			}
			if (type == TEXT_SEARCH && text.length == 0) {
				error = error + "\nYou should define text to search on page";
				valid = false;
			}
			if (!valid) {
				alert(error);
				return false;
			}
			
			// SEND REQUEST
			$.ajax({
				type : "post",
				url  : "<?php echo Url::generate('/index/search') ?>",
				data : {
					'url'  : url,
					'type' : type,
					'text' : text
				},
				success : function(data) {
					console.log(data, data.error);
					var statusDiv = $('#status-message');
					if (data.error == '' || data.error == undefined) {
						statusDiv.html('<span style="color: green;">Parsing successfully finished</span>').show('slow');
						setTimeout(function() {
							statusDiv.hide('slow').html('');
						}, 3000)
					} else {
						statusDiv.html('<span style="color: red;">' + data.error + '</span>').show('slow');
						setTimeout(function() {
							statusDiv.hide('slow').html('');
						}, 3000)
					}
				},
				error: function() {
					statusDiv.html('<span style="color: red;">Unexpected error! Your request cannot be executed.</span>').show();
					setTimeout(function() {
						statusDiv.hide('slow').html('');
					}, 3000)
				}
			})
			console.log(url);
			return false;
		})
	</script>

</body>
</html>