<?php


namespace common\models;


use common\exceptions\EatenException;
use common\exceptions\HangingFromATreeException;
use common\exceptions\LiedFiveHoursException;
use yii\base\Exception;

/**
 * Class AppleManager
 * @package common\models
 */
class AppleManager
{
    private const SHELF_LIFE = 18000; // five hours
    private const DEFAULT_EATING_SIZE = 25;

    /**
     * @param Apple $apple
     * @return bool
     */
    public function isHangingFromATree(Apple $apple)
    {
        return $apple->status == FruitStatus::ON_TREE;
    }

    /**
     * @param Apple $apple
     * @return bool
     */
    public function isLiedFiveHours(Apple $apple)
    {
        return $apple->fell_at && (time() - $apple->fell_at >= self::SHELF_LIFE);
    }

    /**
     * @param Apple $apple
     * @return bool
     */
    public function isEaten(Apple $apple)
    {
        return !$apple->size;
    }

    /**
     * @return bool
     */
    public function create()
    {
        $apple = new Apple();
        $apple->color = Color::getRandomOne();
        $apple->status = FruitStatus::ON_TREE;
        $apple->size = 100;
        $apple->created_at = time();

        return $apple->save();
    }

    /**
     * @param Apple $apple
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function deleteApple(Apple $apple)
    {
        $apple->delete();
    }

    /**
     * Delete all apples
     */
    public function deleteApples()
    {
        Apple::deleteAll();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getApples()
    {
        return Apple::find()->all();
    }

    /**
     * @param int $id
     */
    public function fall(int $id)
    {
        $apple = Apple::findOne($id);
        if ($this->isHangingFromATree($apple)) {
            $apple->status = FruitStatus::FELL;
            $apple->fell_at = time();
            $apple->save();
        }
    }

    /**
     * @param int $id
     * @param int $size
     * @throws Exception
     */
    public function eat(int $id, $size = self::DEFAULT_EATING_SIZE)
    {
        $apple = Apple::findOne($id);

        $this->checkEatable($apple);

        if ($apple->size - $size <= 0) {
            $apple->size = 0;
            $apple->status = FruitStatus::EATEN;
        } else {
            $apple->size = $apple->size - $size;
        }

        $apple->save();
    }

    /**
     * @param Apple $apple
     * @throws Exception
     */
    private function checkEatable(Apple $apple)
    {
        if ($this->isEaten($apple)) {
            throw new EatenException();
        } elseif ($this->isLiedFiveHours($apple)) {
            throw new LiedFiveHoursException();
        } elseif ($this->isHangingFromATree($apple)) {
            throw new HangingFromATreeException();
        }
    }

}