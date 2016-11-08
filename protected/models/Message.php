<?php
class Message extends CActiveRecord
{
	public $verifyCode;

	public function tableName()
	{
		return '{{message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id', 'length', 'max'=>10),
			array('name,email', 'length', 'max'=>255),
			array('id, name , email , body ', 'safe'),
			array('id, name , email , body ', 'safe', 'on'=>'search'),
			array(
				'verifyCode',
				'captcha',
				// авторизованным пользователям код можно не вводить
				'allowEmpty'=>!Yii::app()->user->isGuest,
			),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Код',
			'name' => 'Имя',
			'email' => 'Почта',
			'body' => 'Сообщение',
			'verifyCode' => 'Код проверки',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
