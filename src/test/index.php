<?php
#Ejemplo para subir un archivo con permisos públicos
require(__DIR__.'/../../vendor/autoload.php');
require_once(__DIR__. '/S3Api.php');

use s3_api\S3Api;

$s3=new S3Api();
$api = '[API_KEY]';
$region = '[REGION]';
$secret = '[SECRET]';
$file = 'prueba.txt';
$bucket = '[BUCKET]';
$file_path = '[FILE_PATH]';

$s3->connect($api,$secret, $region);
$s3->upload($bucket, $file, $file_path);
