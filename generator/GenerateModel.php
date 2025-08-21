<?php

require_once(__DIR__ . '/vendor/autoload.php');

use Office365\Generator\Builders\TemplateContext;
use Office365\Generator\Builders\TypeBuilder;
use Office365\Generator\Documentation\MSGraphDocsService;
use Office365\Generator\Documentation\SharePointSpecsService;
use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Http\RequestException;
use Office365\Runtime\OData\MetadataResolver;
use Office365\Runtime\OData\ODataModel;
use Office365\Runtime\OData\V3\ODataV3Reader;
use Office365\Runtime\OData\V4\ODataV4Reader;
use Office365\SharePoint\ClientContext;


/**
 * @param $typeSchema array
 * @param $options array
 */
function generateTypeFile(array $typeSchema, array $options)
{
    if(!isset($typeSchema['baseType'])){
        #print ("[Warn] ${$typeSchema['alias']} type not determined.\n");
        return;
    }
    else{
        $templatePath = join(DIRECTORY_SEPARATOR,[$options['templatePath'],$typeSchema['baseType'] . '.php']) ;
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
    $options = loadSettingsFromFile('./Settings.SharePoint.json');
    try {
        $options['docs'] = new SharePointSpecsService($options['docsRoot']);
    } catch (RequestException $e) {
        //ignore
    }
    $reader = new ODataV3Reader();
    $model = $reader->generateModel($options);
    generateFiles($model);
}

function generateOutlookServicesModel()
{
    $generatorOptions = loadSettingsFromFile('./Settings.OutlookServices.json');
    $reader = new ODataV4Reader();
    $model = $reader->generateModel($generatorOptions);
    generateFiles($model);
}

function generateGraphModel()
{
    $options = loadSettingsFromFile('./Settings.Graph.json');
    $options['docs'] = new MSGraphDocsService();
    $reader = new ODataV4Reader();
    $model = $reader->generateModel($options);
    generateFiles($model);
}


function saveMetadataFile($xml, $metadataPath){
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml);
    file_put_contents($metadataPath,$dom->saveXML());
}


function syncSharePointMetadataFile($fileName){
    $settings = include('../tests/Settings.php');
    $credentials = new ClientCredential($settings['ClientId'], $settings['ClientSecret']); //new UserCredentials($Settings['UserName'], $Settings['Password']);
    $ctx = (new ClientContext($settings['Url']))->withCredentials($credentials);
    $ctx->requestFormDigest()->executeQuery();
    $latestVersion = $ctx->getContextWebInformation()->LibraryVersion;

    $options = json_decode(file_get_contents($fileName), true);
    if(!file_exists($options['metadataPath']) || $options['version'] != $latestVersion){
        echo "Loading metadata for version " . $options['version'] . " ..."  . PHP_EOL;
        $contents = MetadataResolver::getMetadata($ctx);
        saveMetadataFile($contents, $options['metadataPath']);
        $options['version'] = $latestVersion;
        $options['timestamp'] = date('c');
        file_put_contents($fileName,json_encode($options,JSON_PRETTY_PRINT));
    }
}


try {

    $modelName = "Graph";
    if (count($argv) > 1)
        $modelName = $argv[1];


    switch ($modelName) {
        case "SharePoint":
            generateSharePointModel();
            break;
        case "OutlookServices":
            generateOutlookServicesModel();
            break;
        case "Graph":
            generateGraphModel();
            break;
    }

} catch (Exception $ex) {
    $message = $ex->getMessage();
    print_r("An error occurred while generating model: $message \r\n");
}