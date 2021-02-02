<?php


namespace common\exceptions;


use yii\base\Exception;

/**
 * Class EatenException
 * @package common\exceptions
 */
class EatenException extends Exception
{
    public $message = 'Fruit is eaten';
}