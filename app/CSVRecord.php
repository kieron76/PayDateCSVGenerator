<?php

namespace App;

class CSVRecord 
{
    protected array $fields = []; 
    protected array $returnOrder = [];

    public function getArray() : array 
    {
        $returnArray = [];

        foreach ($this->returnOrder as $fieldName) {
            if (!isset($this->fields[$fieldName])) {
               throw new \Exception("Field '$fieldName' supplied in the sort order is not found");
            }

            $returnArray[] = $this->fields[$fieldName];
        }

        return $returnArray;
    }

    public function addField(string $fieldName, string $value) : CSVRecord
    {
        $this->fields[$fieldName] = $value;
        array_push($this->returnOrder, $fieldName);
        return $this;
    }

    public function setReturnOrder(array $returnOrder) : CSVRecord
    {
        $this->returnOrder = $returnOrder;
        return $this;
    }
}
