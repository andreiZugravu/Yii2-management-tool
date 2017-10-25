<?php

namespace common\models;

use Yii;
use yii\helpers\VarDumper;

class myHelper
{
    public static function stringToArrayIntegers($string)
    {
        $index = 0;
        $length = strlen($string);
        $arrayIndex = 0;

        $array = [];

        while($index < $length)
        {
            while ($index < $length && $string[$index] == ' ') ++$index;
            //skip white spaces

            $number = null;
            while ($index < $length && is_numeric($string[$index]))
            {
                $number .= $string[$index];
                ++$index;
            }

            if ($number != null)
            {
                $array[$arrayIndex] = $number;
                ++$arrayIndex;
            }
        }

        return $array;
    }

    public static function findIdInString($id_array, $id)
    {
        $index = 0;
        $length = strlen($id_array);
        $found = false;

        while($index < $length)
        {
            while ($index < $length && $id_array[$index] === ' ') ++$index;
            //ignore white spaces

            $computedString = NULL;
            while($index < $length && is_numeric($id_array[$index]))
            {
                $computedString .= $id_array[$index];
                ++$index;
            }

            if($computedString == $id)
            {
                $found = true;
                break;
            }
        }

        return $found;
    }
}