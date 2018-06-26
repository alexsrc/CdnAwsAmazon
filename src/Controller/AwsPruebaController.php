<?php

namespace App\Controller;

use Aws\S3\S3Client;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



//Instalar SDk amazon
//Instalar Bundle AWS version 2.0 compatible con symfony 4
class AwsPruebaController extends Controller
{
    /**
     * @Route("/aws/prueba", name="aws_prueba")
     */
    public function guardarArchivos()
    {
        //se pasan las credenciales asignadas al usuario creado en aws en amazon (My Security Credentials)
        //se pasa la version del sdk
        //se pasa la region del cdn al cual se esta accediendo
        $client=S3Client::factory(array(
            'credentials' => array(
                'key'    => 'AKIAI7TDNNUGWRMN5NZQ',
                'secret' => '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',
            ),
            'version' => 'latest',
            'region'  => 'us-east-2'
            ));

        //se captura un archivo de prueba
        $pathToFile=realpath('/var/www/html/HomeMakkers/carbono/public/assets/images/profile.jpg');
        try {
            //se manda el archivo al bucket
            $result = $client->putObject(array(
                //bucket al que se desea mandar el archivo
                'Bucket'     => 'alexcdn',
                //ruta / nombre con que se guarda el archivo
                'Key'        => 'asaas/data_from_file.jpg',
                //archivo que se va a guardar
                'SourceFile' => $pathToFile
            ));
            //sin investigar
//            $client->waitUntil('ObjectExists', array(
//                'Bucket' => 'alexcdn',
//                'Key'    => 'data_from_file.jpg'
//            ));
            //captura los errores
        } catch (\Aws\S3\Exception\S3Exception $e) {
            // The AWS error code (e.g., )
            echo $e->getAwsErrorCode() . " \n \n" ;

            // The bucket couldn't be created
            echo $e->getMessage() . "\n";
        }

//        var_dump("hola");
//        die();
    }

    public function verArhivosMultimedia(){
        //
    }
}
