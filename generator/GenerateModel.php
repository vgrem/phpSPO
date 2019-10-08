<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/ModelBuilders.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\OData\MetadataResolver;
use Office365\PHP\Client\Runtime\OData\ODataModel;
use Office365\PHP\Client\Runtime\OData\ODataV3Reader;
use Office365\PHP\Client\SharePoint\ClientContext;


$Settings = include('../Settings.php');

/**
 * @param $url string
 * @param $username string
 * @param $password string
 * @return ClientContext
 * @throws Exception
 */
function connectWithUserCredentials($url,$username,$password){
    $authCtx = new AuthenticationContext($url);
    $authCtx->acquireTokenForUser($username,$password);
    $ctx = new ClientContext($url,$authCtx);
    return $ctx;
}

/**
 * @param $typeSchema array
 * @param $options array
 */
function generateTypeFile($typeSchema,$options)
{
    $builder = new ClientValueBuilder($typeSchema,$options);
    if ($typeSchema['state'] === "attached") {
        $updated = $builder->updateTypeFile();
        if ($updated) {
            echo $typeSchema['file'] . " has been updated" . PHP_EOL;
        }
    } else {
        $outputFile = $builder->createTypeFile();
        echo "$outputFile has been generated" . PHP_EOL;
    }
}

function generateFiles(ODataModel $model){
    $types = $model->getTypes();
    foreach ($types as $typeName => $type){
        generateTypeFile($type,$model->getOptions());
    }
}

try {
    $ctx = connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $edmxContents = MetadataResolver::getMetadata($ctx);
    $outputPath = dirname((new \ReflectionClass($ctx))->getFileName());
    $rootNamespace = ((new \ReflectionClass($ctx))->getNamespaceName());
    $ctx->requestFormDigest();
    $ctx->executeQuery();
    $now = date('c');
    $version = $ctx->getContextWebInformation()->LibraryVersion;
    $generatorOptions = array(
        'outputPath' => $outputPath,
        'rootNamespace' => $rootNamespace,
        'version' => $version,
        'timestamp' => $now,
        'placeholder' => "Updated By PHP Office365 Generator",
        'ignoredTypes' => array(
            "SP.MethodInformation",
            "SP.TypeInformation",
            "SP.PropertyInformation",
            "SP.ParameterInformation",
            "SP.ResourcePath")
    );

    $reader = new ODataV3Reader();
    $model = $reader->generateModel($edmxContents,$generatorOptions);
    generateFiles($model);
}
catch (Exception $ex){
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}



