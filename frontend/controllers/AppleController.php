<?php


namespace frontend\controllers;

use common\models\AppleManager;
use yii\web\Controller;

class AppleController extends Controller
{
    /**
     * @var AppleManager
     */
    private $appleManager;

    public function init()
    {
        $this->appleManager = new AppleManager();

        parent::init();
    }

    public function actionIndex()
    {
        $apples = $this->appleManager->getApples();

        return $this->render('index', compact('apples'));
    }

    public function actionCreate()
    {
        $this->appleManager->deleteApples();
        $randCount = rand(1, 10);

        for ($i = 0; $i < $randCount; $i++) {
            $this->appleManager->create();
        }

        return $this->redirect('index');
    }

    public function actionFall($id)
    {
        $this->appleManager->fall($id);

        return $this->redirect(['apple/index']);
    }

    public function actionEat($id, $size = null)
    {
        $this->appleManager->eat($id, $size);

        return $this->redirect(['apple/index']);
    }
}