<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/ModelBuilders.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\Runtime\OData\MetadataResolver;
use Office365\PHP\Client\Runtime\OData\ODataModel;
use Office365\PHP\Client\Runtime\OData\ODataV3Reader;
use Office365\PHP\Client\SharePoint\ClientContext;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;


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
 * @param $typeName string
 * @param $typeSchema array
 */
function generateTypeFile($typeName,$typeSchema)
{
    $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP5);
    if($typeSchema['state'] === "attached"){
        //echo "Updating type: $typeName" . PHP_EOL;
        $code = file_get_contents($typeSchema['file']);
        $ast = $parser->parse($code);
        $traverser = new NodeTraverser();
        $builder = new ClientValueBuilder($typeSchema['properties']);
        $traverser->addVisitor($builder);
        $generatedAst = $traverser->traverse($ast);
        if($builder->getStatistics()['new'] > 0){
            $traverser->removeVisitor($builder);
            $traverser->addVisitor(new DocsBuilder());
            $generatedAst = $traverser->traverse($generatedAst);

            $prettyPrinter = new PrettyPrinter\Standard();
            $code = $prettyPrinter->prettyPrintFile($generatedAst);
            //$testPath = __DIR__ .  "/$typeName.php";
            //file_put_contents($testPath, $code);
            file_put_contents($typeSchema['file'], $code);
        }
    }
    else{
         echo "Creating type: $typeName" . PHP_EOL;
    }
}

function generateFiles(ODataModel $model){
    $types = $model->getTypes();
    foreach ($types as $typeName => $type){
        generateTypeFile($typeName,$type);
    }
}

try{
    $ctx = connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $edmxContents = MetadataResolver::getMetadata($ctx);
    $reader = new ODataV3Reader();
    $model = $reader->generateModel($edmxContents);
    generateFiles($model);
}
catch (Exception $ex){
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}



