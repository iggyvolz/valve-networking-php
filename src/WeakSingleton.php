<?php

namespace iggyvolz\ValveNetworking;

use LogicException;
use WeakReference;

trait WeakSingleton
{
    /**
     * @var WeakReference<static>|null
     */
    private static ?WeakReference $ref = null;
    protected function __construct()
    {
    }
    final public static function get(): self
    {
        $self = self::$ref?->get();
        if(is_null($self)) {
            $self = new static();
            self::$ref = WeakReference::create($self);
        }
        return $self;
    }
    final public function __clone(): never
    {
        throw new LogicException("Cannot clone singleton");
    }
    public function __sleep(): never
    {
        throw new LogicException("Cannot serialize singleton");
    }
    public function __wakeup(): never
    {
        throw new LogicException("Cannot unserialize singleton");
    }
}