<?php

namespace Mhor\MediaInfo\Checker;

interface AttributeCheckerInterface
{
    public function getMembersFields(): array;

    public function create($value);
}
