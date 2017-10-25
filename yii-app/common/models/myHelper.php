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
}