# aws-s3-api
Simplify the AWS S3 interactions.

### Use the example 1 to start wwith this library:

    <?php
    #Ejemplo para subir un archivo con permisos públicos
    require(__DIR__.'/../vendor/autoload.php');
    use s3_api\S3Api;

    $s3=new S3Api();
    $api = '[API_KEY]';
    $region = '[REGION]';
    $secret = '[SECRET]';
    $file = 'prueba.txt';
    $bucket = '[BUCKET]';
    $file_path = '[FILE_PATH]';

    $s3->connect($api,$secret, $region);
    $s3->connect($api,$secret, $region);

    // UPLOAD A FILE FROM LOCAL TO BUCKET
    $s3->upload($bucket, $file, $file_path);
    
    // DOWNLOAD FROM BUCKET TO LOCAL
    $s3->download($bucket, $file, $file_path);

