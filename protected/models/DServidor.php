<?php

/**
 * This is the model class for table "D_Servidor".
 *
 * The followings are the available columns in table 'D_Servidor':
 * @property integer $CDDServidor
 * @property integer $Servidor_CDServidor
 * @property string $Assinatura
 *
 * The followings are the available model relations:
 * @property Servidor $servidorCDServidor
 */
class DServidor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DServidor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'D_Servidor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Servidor_CDServidor', 'required'),
			array('CDDServidor, Servidor_CDServidor', 'numerical', 'integerOnly'=>true),
			array('Assinatura', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDDServidor, Servidor_CDServidor, Assinatura', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'servidorCDServidor' => array(self::BELONGS_TO, 'Servidor', 'Servidor_CDServidor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDDServidor' => 'Cddservidor',
			'Servidor_CDServidor' => 'Servidor Cdservidor',
			'Assinatura' => 'Configure sua assinatura',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('CDDServidor',$this->CDDServidor);
		$criteria->compare('Servidor_CDServidor',$this->Servidor_CDServidor);
		$criteria->compare('Assinatura',$this->Assinatura,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}