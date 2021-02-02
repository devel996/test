<?php


namespace common\models;


use yii\base\Exception;

class AppleManager
{
    private const SHELF_LIFE = 18000; // five hours
    private const DEFAULT_EATING_SIZE = 25; // five hours

    private const IS_HANGING_FROM_A_TREE = 'ne vozmozhno ...';
    private const IS_LIED_FIVE_HOURS = 'PCHacac ...';
    private const IS_EATEN = 'KERAC ...';

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
     * @param Apple $apple
     * @return bool
     */
    public function create()
    {
        $randColor = rand(1, 4);

        $apple = New Apple();
        $apple->color = $randColor;
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
     * @param Apple $apple
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
     * @param Apple $apple
     * @param float $size
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
        $apple->validate();

        $apple->save();
    }

    /**
     * @param Apple $apple
     * @throws Exception
     */
    private function checkEatable(Apple $apple)
    {
        if ($this->isEaten($apple)) {
            throw new Exception(self::IS_EATEN);
        } elseif ($this->isLiedFiveHours($apple)) {
            throw new Exception(self::IS_LIED_FIVE_HOURS);
        } elseif ($this->isHangingFromATree($apple)) {
            throw new Exception(self::IS_HANGING_FROM_A_TREE);
        }
    }

}