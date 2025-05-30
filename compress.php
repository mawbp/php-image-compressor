<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
	$image = $_FILES['image'];
	$format = $_POST['format'] ?? 'jpg';

	if($image['error'] === 0){
		$manager = new ImageManager(new Driver());
		$img = $manager->read($image['tmp_name']);

		$img->resize(1024, null, function($constraint) {
			$constraint->aspectRatio();
			$constraint->upSize();
		});

		$uploadDir = 'uploads/';
		if(!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		$outputFilename = uniqid() . "." . $format;
		$outputPath = __DIR__ . '/uploads/' . $outputFilename;

		if($format === 'webp'){
			$img->toWebp(75)->save($outputPath);
		} else {
			$img->toJpeg(75)->save($outputPath, 75);
		}

		header("Location:index.php?file=" . urlencode($outputFilename));
		exit;
	} else {
		echo "Terjadi kesalahan saat upload gambar" . $image['error'];
	}
} else {
	echo "Permintaan tidak valid";
}

