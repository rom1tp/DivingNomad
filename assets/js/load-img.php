<?php
$photosModel = new PhotosModel();
$photo = $photosModel->getPhoto($id);
$src = $photo['src'];

echo $src;