<?php
namespace s3_api;

/**
 * Class S3Client
 * @brief Cliente para conectarse rápidamente a Amazon S3.
 * @author Edwin Ariza <edwin.ariza@systemico.co>
 */

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;

class S3Api{
  public $connector;
  public function connect($key, $secret,$region){
    $credentials=new Credentials($key, $secret);
    $this->connector=new S3Client([
      'version'     => 'latest',
      'region'      => $region,
      'credentials' => $credentials
    ]);
  }
  public function get_buckets(){
    return $this->connector->listBuckets();
  }
  public function upload($bucket, $filename, $file_path){
    try {
      // Upload data.
      $result = $this->connector->putObject([
        'Bucket' => $bucket,
        'Key'    => $filename,
        'SourceFile' => $file_path,
        'ACL'    => 'public-read'
      ]);

      // Print the URL to the object.
      echo $result['ObjectURL'] . PHP_EOL;
    } catch (S3Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
  }
}
