<?php


namespace common\exceptions;


use yii\base\Exception;

/**
 * Class HangingFromATreeException
 * @package common\exceptions
 */
class HangingFromATreeException extends Exception
{
    public $message = 'Fruit is hanging from the tree';
}