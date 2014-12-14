<?php

namespace Mhor\MediaInfo\Attribute;

abstract class AbstractAttribute implements AttributeInterface
{
    /**
     * @param $attribute
     * @return bool
     */
    public function isMember($attribute)
    {
        return in_array($attribute, $this::getMembersFields());
    }
}
