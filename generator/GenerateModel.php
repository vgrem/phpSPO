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
function generateTypeFile($typeSchema, $options)
{
    $templatePath = $options['templatePath'] . "\\" . $typeSchema['baseType'] . 'Template.php';
    $template = new TemplateContext($templatePath);
    $builder = new TypeBuilder($options, $typeSchema);
    echo "Processing " . $typeSchema['file'] . " file: " . PHP_EOL;
    if ($builder->build($template)) {
        $outputFile = $typeSchema['file'];
        $outputFolder = dirname($outputFile);
        ensureFolder($outputFolder);
        $builder->save($outputFile);
        echo "File: " . $typeSchema['file'] . ' has been generated' . PHP_EOL;
    }
}

function ensureFolder(&$path)
{
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}


function generateFiles(ODataModel $model)
{
    $types = $model->getTypes();
    $curIdx = 0;
    $startIdx = 0;
    $count = count($types);
    foreach ($types as $typeName => $type) {
        $curIdx++;
        if ($curIdx >= $startIdx) {
            echo "Processing type ($curIdx of $count):  $typeName ... " . PHP_EOL;
            generateTypeFile($type, $model->getOptions());
        }
    }
}


/**
 * @param string $fileName
 * @return array
 */
function loadSettingsFromFile($fileName)
{
    $settings = json_decode(file_get_contents($fileName), true);
    $settings['timestamp'] = date('c');
    $settings['templatePath'] = realpath($settings['templatePath']);
    $settings['outputPath'] = realpath($settings['outputPath']);
    return $settings;
}


function generateSharePointModel()
{
    syncSharePointMetadataFile('./Settings.SharePoint.json');
    $generatorOptions = loadSettingsFromFile('./Settings.SharePoint.json');
    $reader = new ODataV3Reader();
    $model = $reader->generateModel($generatorOptions);
    generateFiles($model);
}

function generateOutlookServicesModel()
{
    $generatorOptions = loadSettingsFromFile('./Settings.OutlookServices.json');
    $reader = new ODataV4Reader();
    $model = $reader->generateModel($generatorOptions);
    generateFiles($model);
}

function generateMicrosoftGraphModel()
{
    $generatorOptions = loadSettingsFromFile('./Settings.MicrosoftGraph.json');
    $reader = new ODataV4Reader();
    $model = $reader->generateModel($generatorOptions);
    generateFiles($model);
}


function syncSharePointMetadataFile($fileName){
    $Settings = include('../Settings.php');
    $ctx = ClientContext::connectWithUserCredentials($Settings['Url'], $Settings['UserName'], $Settings['Password']);
    $ctx->requestFormDigest();
    $ctx->executeQuery();
    $latestVersion = $ctx->getContextWebInformation()->LibraryVersion;

    $options = json_decode(file_get_contents($fileName), true);
    if(!file_exists($options['metadataPath']) || $options['version'] != $latestVersion){
        echo "Loading metadata for version " . $options['version'] . " ..."  . PHP_EOL;
        $contents = MetadataResolver::getMetadata($ctx);
        file_put_contents($options['metadataPath'],$contents);
        $options['version'] = $latestVersion;
        $options['timestamp'] = date('c');
        file_put_contents($fileName,json_encode($options,JSON_PRETTY_PRINT));
    }
}


try {

    $modelName = "SharePoint";
    if (count($argv) > 1)
        $modelName = $argv[1];

    switch ($modelName) {
        case "SharePoint":
            generateSharePointModel();
            break;
        case "OutlookServices":
            generateOutlookServicesModel();
            break;
        case "MicrosoftGraph":
            generateMicrosoftGraphModel();
            break;
    }

} catch (Exception $ex) {
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}
