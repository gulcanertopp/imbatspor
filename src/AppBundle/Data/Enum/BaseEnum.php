<?php
namespace AppBundle\Data\Enum;

class BaseEnum
{
    public static function GetName($value)
    {
        $reflector = new \ReflectionClass(get_called_class());
        foreach($reflector->getConstants() as $key => $val)
            if ($val == $value)
                return $key;

        return null;
    }

    public static function GetNames()
    {
        $reflector = new \ReflectionClass(get_called_class());
        return array_flip($reflector->getConstants());
    }

    public static function GetValues()
    {
        $reflector = new \ReflectionClass(get_called_class());
        return $reflector->getConstants();
    }

    public static function GetValue($name)
    {
        return array_key_exists($name, self::GetValues()) ? self::GetValues()[$name] : null;
    }
}