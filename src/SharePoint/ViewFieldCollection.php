<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\OData\ODataPrimitiveTypeKind;

/**
 * Represents a collection of fields in a list view.
 */
class ViewFieldCollection extends ClientObjectCollection
{

  function convertFromJson($json)
  {
    $this->clearData();
    if (in_array($this->getEntityTypeName(), ODataPrimitiveTypeKind::getPrimitiveCollectionNames())) {
      $this->data = $json->results;
    } else {
      foreach ($json as $item) {
        $clientValueObject = $this->createTypedValueObject();
        $clientValueObject->convertFromJson($item);
        $this->addChild($clientValueObject);
      }
    }
  }

}