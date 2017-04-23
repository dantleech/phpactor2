<?php

namespace DTL\Phpactor\Model\Reflection;

final class Access
{
    const PRIVATE = 'private';
    const PROTECTED = 'protected';
    const PUBLIC = 'public';

    private $access;

    public function __construct(string $level)
    {
        $validLevels = [
            self::PRIVATE,
            self::PROTECTED,
            self::PUBLIC
        ];

        if (!in_array($level, $validLevels)) {
            throw new \InvalidArgumentException(sprintf(
                '"%s" is not a valid access type, valid types: "%s"',
                $level, implode('", "', array_keys($validLevels))
            ));
        }

        $this->access = $access;
    }

    public function isPrivate()
    {
        return $this->access === self::PRIVATE;
    }

    public function isProtected()
    {
        return $this->access === self::PROTECTED;
    }

    public function isPublic()
    {
        return $this->access === self::PUBLIC;
    }
}
