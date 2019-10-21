<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/builders/DocCommentBuilder.php');
require_once(__DIR__ . '/builders/ClientValueBuilder.php');
require_once(__DIR__ . '/AnnotationsResolver.php');

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
        $builder->createTypeFile();
        $outputFile = $typeSchema['file'];
        echo "$outputFile has been generated" . PHP_EOL;
    }
}

function generateFiles(ODataModel $model){
    $annotations = new AnnotationsResolver($model->getOptions());
    $types = $model->getTypes();

    $curIdx = 0;
    $startIdx = 0;
    $count = count($types);
    foreach ($types as $typeName => $type){
        $curIdx++;
        if($curIdx >= $startIdx){
            echo "Processing type ($curIdx of $count):  $typeName ... " . PHP_EOL;
            //$annotations->resolveTypeComment($typeName,$type);
            //generateTypeFile($type,$model->getOptions());
        }
    }
}

try {

    $ctx = connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $edmxContents = MetadataResolver::getMetadata($ctx);
    $outputPath = dirname((new ReflectionClass($ctx))->getFileName());
    $rootNamespace = (new ReflectionClass($ctx))->getNamespaceName();
    $ctx->requestFormDigest();
    $ctx->executeQuery();
    $now = date('c');
    $version = $ctx->getContextWebInformation()->LibraryVersion;
    $generatorOptions = array(
        'outputPath' => $outputPath,
        'docsRoot' => 'https://docs.microsoft.com/en-us/openspecs/sharepoint_protocols/ms-csomspt/',
        'rootNamespace' => $rootNamespace,
        'version' => $version,
        'timestamp' => $now,
        'placeholder' => "Updated By PHP Office365 Generator",
        'ignoredTypes' => array(
            "SP.SimpleDataRow",
            "SP.SimpleDataTable",
            "SP.MethodInformation",
            "SP.TypeInformation",
            "SP.PropertyInformation",
            "SP.ParameterInformation",
            "SP.ResourcePath",
            "SP.WebResponseInfo",
            "SP.ApiMetadata",
            "SP.Data.*")
    );

    $reader = new ODataV3Reader($edmxContents,$generatorOptions);
    $model = $reader->generateModel();
    generateFiles($model);
}
catch (Exception $ex){
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}



