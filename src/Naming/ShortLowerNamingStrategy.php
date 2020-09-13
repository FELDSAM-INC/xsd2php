<?php

namespace GoetasWebservices\Xsd\XsdToPhp\Naming;

use Doctrine\Common\Inflector\Inflector;
use GoetasWebservices\XML\XSDReader\Schema\Item;
use GoetasWebservices\XML\XSDReader\Schema\Type\Type;

class ShortLowerNamingStrategy extends ShortNamingStrategy implements NamingStrategy
{
    public function getAnonymousTypeName(Type $type, $parentName)
    {
        return $this->classify($parentName);
    }

    public function getPropertyName($item)
    {
        return Inflector::camelize(str_replace('.', ' ', strtolower($item->getName())));
    }

    public function getItemName(Item $item)
    {
        $name = $this->classify(strtolower($item->getName()));
        if (in_array(strtolower($name), $this->reservedWords)) {
            $name .= 'Xsd';
        }

        return $name;
    }

    private function classify($name)
    {
        return Inflector::classify(str_replace('.', ' ', strtolower($name)));
    }
}
