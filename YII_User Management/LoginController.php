<?php

class LoginController extends Controller
{
        public $defaultAction = 'login';


        public function actionLogin()
        {
                if (Yii::app()->user->isGuest) {
                        $model=new UserLogin;

                        if(isset($_POST['UserLogin']))
                        {
                                $model->attributes=$_POST['UserLogin'];

                                if($model->validate()) {
                                        $this->lastViset();
                                        if (Yii::app()->user->returnUrl=='/index.php')
                                                $this->redirect(Yii::app()->controller->module->returnUrl);
                                        else
                                                $this->redirect(Yii::app()->user->returnUrl);
                                }
                        }

                        $this->render('/user/login',array('model'=>$model));
                } else
                        $this->redirect(Yii::app()->controller->module->returnUrl);
        }

        private function lastViset() {
                $lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
                $lastVisit->lastvisit = time();
                $lastVisit->save();
        }

}

