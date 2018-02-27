<?php

namespace Magento\Braintree\Model\CustomFields;

/**
 * Class Pool
 * @package Magento\Braintree\Model\CustomFields
 * @author Aidan Threadgold <aidan@gene.co.uk>
 */
class Pool
{
    /**
     * @var array
     */
    protected $fieldsPool;

    /**
     * CustomFieldsDataBuilder constructor.
     * @param array $fields
     */
    public function __construct($fields = [])
    {
        $this->fieldsPool = $fields;
        $this->checkFields();
    }

    /**
     * @param $buildSubject
     * @return array
     */
    public function getFields($buildSubject)
    {
        $result = [];
        /**
         * @var $field CustomFieldInterface
         */
        foreach ($this->fieldsPool as $field) {
            $result[ $field->getApiName() ] = $field->getValue($buildSubject);
        }

        return $result;
    }

    /**
     * @return bool
     */
    protected function checkFields()
    {
        foreach ($this->fieldsPool as $field) {
            if (!($field instanceof CustomFieldInterface)) {
                throw new \InvalidArgumentException('Custom field must implement CustomFieldInterface');
            }
        }
        return true;
    }
}