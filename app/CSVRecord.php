<?php

namespace App;

class CSVRecord 
{

    /**
     * Associative array of fields held in the record
     *
     * @var array
     */
    protected array $fields = []; 

    /**
     * An array list of the field order to write the csv in
     *
     * @var array
     */ 
    protected array $returnOrder = [];

    
    /**
     * Returns an array of field values in the sort order provided
     *
     * @return array
     */
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

    /**
     * Add a field with a value to the record
     *
     * @param string fieldName
     * @param string value
     * @return CSVRecord
     */
    public function addField(string $fieldName, string $value) : CSVRecord
    {
        $this->fields[$fieldName] = $value;
        array_push($this->returnOrder, $fieldName);
        return $this;
    }

    /**
     * Set the return order of fields in getArray()
     *
     * @param array returnOrder 
     * @return CSVRecord
     */
    public function setReturnOrder(array $returnOrder) : CSVRecord
    {
        $this->returnOrder = $returnOrder;
        return $this;
    }
}
