<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Office365\Generator\Builders\TemplateContext;
use Office365\Generator\Builders\TypeBuilder;
use Office365\Runtime\OData\MetadataResolver;
use Office365\Runtime\OData\ODataModel;
use Office365\Runtime\OData\ODataV3Reader;
use Office365\Runtime\OData\ODataV4Reader;
use Office365\SharePoint\ClientContext;


/**
 * @param $typeSchema array
 * @param $options array
 */
function generateTypeFile($typeSchema,$options)
{
    $templatePath =  $options['templatePath'] . "\\" . $typeSchema['baseType'] . 'Template.php';
    $template = new TemplateContext($templatePath);
    $builder = new TypeBuilder($options,$typeSchema);
    echo "Processing " . $typeSchema['file'] . " file: "  . PHP_EOL;
    if($builder->build($template)){
        $outputFile = $typeSchema['file'];
        $outputFolder = dirname($outputFile);
        ensureFolder($outputFolder);
        $builder->save($outputFile);
        echo "File: " . $typeSchema['file'] . ' has been generated' . PHP_EOL;
    }
}

function ensureFolder(&$path){
    if (!is_dir($path)) {
        mkdir($path,0777,true);
    }
}


function loadMetadataFile(ClientContext $ctx){
    $version = $ctx->getContextWebInformation()->LibraryVersion;
    $filePath = './metadata/SharePoint' . $ctx->getContextWebInformation()->LibraryVersion . ".xml";
    if(!file_exists($filePath)){
        echo "Loading metadata for version " . $version . " ..."  . PHP_EOL;
        $contents = MetadataResolver::getMetadata($ctx);
        file_put_contents($filePath,$contents);
        return $contents;
    }
    return file_get_contents($filePath);
}


function generateFiles(ODataModel $model){
    $types = $model->getTypes();
    $curIdx = 0;
    $startIdx = 0;
    $count = count($types);
    foreach ($types as $typeName => $type){
        $curIdx++;
        if($curIdx >= $startIdx){
            echo "Processing type ($curIdx of $count):  $typeName ... " . PHP_EOL;
            generateTypeFile($type,$model->getOptions());
        }
    }
}


function generateSharePointModel()
{
    $Settings = include('../Settings.php');
    $ctx = ClientContext::connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $ctx->requestFormDigest();
    $ctx->executeQuery();
    $edmxContents = loadMetadataFile($ctx);

    $generatorOptions = json_decode(file_get_contents('./Settings.SharePoint.json'), true);
    $generatorOptions['version'] = $ctx->getContextWebInformation()->LibraryVersion;
    $generatorOptions['timestamp'] = date('c');
    $generatorOptions['templatePath'] = realpath($generatorOptions['templatePath']);
    $generatorOptions['outputPath'] = realpath($generatorOptions['outputPath']);
    $reader = new ODataV3Reader();
    $model = $reader->generateModel($edmxContents, $generatorOptions);
    generateFiles($model);
}


function generateOutlookServicesModel(){
    $generatorOptions = json_decode(file_get_contents('./Settings.OutlookServices.json'), true);
    $generatorOptions['timestamp'] = date('c');
    $generatorOptions['templatePath'] = realpath($generatorOptions['templatePath']);
    $generatorOptions['outputPath'] = realpath($generatorOptions['outputPath']);
    $edmxContents = file_get_contents("./metadata/OutlookServices.xml");
    $reader = new ODataV4Reader();
    $model = $reader->generateModel($edmxContents, $generatorOptions);
    generateFiles($model);
}



try {
    generateSharePointModel();
    //generateOutlookServicesModel();
}
catch (Exception $ex){
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}
