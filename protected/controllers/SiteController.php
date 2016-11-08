<?php

class SiteController extends Controller
{
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	

	public function actionMessage()
	{
		$message = new Message;
		$answer='';
		$adminMail=Yii::app()->params['adminEmail'];
		$name=Yii::app()->request->getPost('name');
		$email=Yii::app()->request->getPost('email');
		$body=Yii::app()->request->getPost('body');
		if (isset($_POST['name'])){
			$message->attributes=array(
				'name'=>$name,
				'email'=>$email,
				'body'=>$body
			);
			$message->verifyCode= Yii::app()->request->getPost('verifyCode');
			if ($message->validate())
				if ($message->save()){
					Mails::send($adminMail,$name.' '.$email,$body); 
					$answer='Сообщение зарегистрировано';
				}else
					$answer='Приходите завтра';
			else
				$answer=0;
		}
		echo json_encode(array('answer'=>$answer));
		Yii::app()->end();
	}

	public function actionIndex()
	{
		$model = new Message;
		$this->render('index',array('model'=>$model));
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}