<?php

namespace DTL\Phpactor\Model\Reflection;

interface Method
{
    public function getName(): string;

    public function getReturnType(): Type;

    public function getAccess(): Access;

    public function describe(): string;
}
