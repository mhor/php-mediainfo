<?php

namespace Mhor\MediaInfo\Checker;

abstract class AbstractAttributeChecker implements AttributeCheckerInterface
{
    /**
     * @param string $attribute
     *
     * @return bool
     */
    public function isMember(string $attribute): bool
    {
        return in_array($attribute, $this->getMembersFields());
    }
}
