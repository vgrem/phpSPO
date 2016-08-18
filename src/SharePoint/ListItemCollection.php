<?php

namespace SharePoint\PHP\Client;


/**
 * ListItem collection
 *
 */
class ListItemCollection extends ClientObjectCollection
{

    /**
     * Process Xml response from SharePoint REST service
     * @param string $xmlPayload
     */
    public function processXmlPayload($xmlPayload)
    {
        $xmlPayload = simplexml_load_string($xmlPayload);
        $xmlPayload->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xmlPayload->xpath("//z:row");
        foreach ($rows as $row) {
            $item = new ListItem($this->getContext(), $this->getResourcePath());
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item->setProperty($normalizedFieldName, (string)$v);
            }
            $this->addChild($item);
        }
    }

}