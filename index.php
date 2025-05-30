<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h2>Upload Gambar untuk dikompres</h2>
	<form action="compress.php" method="post" enctype="multipart/form-data">
		<label for="">Pilih Gambar:</label>
		<input type="file" name="image" accept="image/*" required><br><br>

		<label for="">Format Output</label>
		<select name="format" id="">
			<option value="jpg">JPG</option>
			<option value="webp">WebP</option>
		</select>
		<button type="submit">Upload dan Kompres</button>
	</form>
	<?php if(isset($_GET['file'])): ?>
		<h3>Hasil Kompresi:</h3>
		<a href="uploads/<?php echo htmlspecialchars($_GET['file']); ?>" download>Download Gambar</a><br><br>
		<img src="uploads/<?php echo htmlspecialchars($_GET['file']); ?>" style="max-width: 400px;" alt="">
	<?php endif; ?>
</body>
</html>