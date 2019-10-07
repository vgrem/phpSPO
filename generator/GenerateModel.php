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
 * @param $rootPath string
 * @param $typeName string
 * @param $typeSchema array
 */
function generateTypeFile($rootPath, $typeName,$typeSchema)
{
    $builder = new ClientValueBuilder($typeName, $typeSchema);
    if ($typeSchema['state'] === "attached") {
        $updated = $builder->updateTypeFile();
        if ($updated) {
            echo "$typeName has been updated" . PHP_EOL;
        }
    } else {
        $systemTypeList = array(
            "SP.MethodInformation",
            "SP.TypeInformation",
            "SP.PropertyInformation",
            "SP.ParameterInformation",
            "SP.ResourcePath");

        if (!in_array($typeName, $systemTypeList)) {
            $parts = explode('.', $typeName);
            array_shift($parts);
            $fileName = $rootPath . "\\" . implode('\\', $parts) . ".php";
            $builder->createTypeFile($fileName);
            echo "$typeName has been generated" . PHP_EOL;
        }
    }
}

function generateFiles($rootPath, ODataModel $model){
    $types = $model->getTypes();
    foreach ($types as $typeName => $type){
        generateTypeFile($rootPath,$typeName,$type);
    }
}

try{
    $ctx = connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $edmxContents = MetadataResolver::getMetadata($ctx);
    $reader = new ODataV3Reader();
    $model = $reader->generateModel($edmxContents);
    $rootPath = dirname((new \ReflectionClass($ctx))->getFileName());
    generateFiles($rootPath,$model);
}
catch (Exception $ex){
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}



