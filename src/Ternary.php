<?php

namespace Dgame\Ternary;

use Exception;
use RuntimeException;

/**
 * Class Ternary
 * @package Dgame\Ternary
 */
final class Ternary
{
    const YES     = 0;
    const NO      = 2;
    const UNKNOWN = 6;
    /**
     * @var Ternary[]
     */
    private static $instances = [];

    /**
     * @var int
     */
    private $id;

    /**
     * Ternary constructor.
     *
     * @param int $id
     */
    private function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Ternary
     */
    private static function instance(int $id): self
    {
        if (!array_key_exists($id, self::$instances)) {
            self::$instances[$id] = new self($id);
        }

        return self::$instances[$id];
    }

    /**
     * @return Ternary
     */
    public static function yes(): self
    {
        return self::instance(self::YES);
    }

    /**
     * @return Ternary
     */
    public static function no(): self
    {
        return self::instance(self::NO);
    }

    /**
     * @return Ternary
     */
    public static function unknown(): self
    {
        return self::instance(self::UNKNOWN);
    }

    /**
     * @param int|bool $value
     *
     * @return Ternary
     * @throws Exception
     */
    public static function translate($value): self
    {
        if (is_bool($value)) {
            return (bool) $value ? self::yes() : self::no();
        }

        if (!is_numeric($value)) {
            throw new RuntimeException('Cannot translate ' . var_export($value, true));
        }

        switch ((int) $value) {
            case self::NO:
                return self::no();
            case self::YES:
                return self::yes();
            default:
                return self::unknown();
        }
    }

    /**
     * @return bool
     */
    public function isYes(): bool
    {
        return $this->id === self::YES;
    }

    /**
     * @return bool
     */
    public function isNo(): bool
    {
        return $this->id === self::NO;
    }

    /**
     * @return bool
     */
    public function isUnknown(): bool
    {
        return $this->id === self::UNKNOWN;
    }

    /**
     * @return Ternary
     */
    public function invert(): self
    {
        return new self((386 >> $this->id) & 6);
    }
}
