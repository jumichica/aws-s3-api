<?php
namespace s3_api;
/**
 * Class S3Client
 * @brief Cliente para conectarse rápidamente a Amazon S3.
 * @author Edwin Ariza <edwin.ariza@systemico.co>
 * @copyright Systemico Software S.A.S
 */
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;

class S3Api{
  /**
   * @var Conector al S3.
   */
  public $connector;
  /**
   * @param $key KEY generado en IAM de AWS de Amazon.
   * @param $secret SECRET generado en IAM de Amazon AWS.
   * @param $region Region en al que se tiene el S3.
   */
  public function connect($key, $secret,$region){
    $credentials=new Credentials($key, $secret);
    $this->connector=new S3Client([
      'version'     => 'latest',
      'region'      => $region,
      'credentials' => $credentials
    ]);
  }

  /**
   * Permite obtener el listado de Buckets disponibles en tu cuenta.
   * @return mixed
   */
  public function get_buckets(){
    return $this->connector->listBuckets();
  }

  /**
   * @param $bucket Nombre del bucket al que se va a subir la información.
   * @param $filename Nombre del archivo que se va a subir. - Puede ser diferente al nombre real del archivo.
   * @param $file_path Ruta completa al archivo que se desea subir.
   */
  public function upload($bucket, $filename, $file_path, $acl=""){
    try {
      // Upload data.
      $result = $this->connector->putObject([
        'Bucket' => $bucket,
        'Key'    => $filename,
        'SourceFile' => $file_path,
        'ACL'    => $acl
      ]);

      // Print the URL to the object.
      echo $result['ObjectURL'] . PHP_EOL;
    } catch (S3Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }
}
