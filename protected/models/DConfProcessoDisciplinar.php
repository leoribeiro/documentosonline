<?php

/**
 * This is the model class for table "D_ConfProcessoDisciplinar".
 *
 * The followings are the available columns in table 'D_ConfProcessoDisciplinar':
 * @property integer $CDConf
 * @property integer $Servidor_Diretor
 * @property integer $Servidor_Comissao
 */
class DConfProcessoDisciplinar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DConfProcessoDisciplinar the static model class
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
		return 'D_ConfProcessoDisciplinar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Servidor_Diretor, Servidor_Comissao', 'required'),
			array('Servidor_Diretor, Servidor_Comissao', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDConf, Servidor_Diretor, Servidor_Comissao', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDConf' => 'Cdconf',
			'Servidor_Diretor' => 'Servidor diretor da instituição',
			'Servidor_Comissao' => 'Servidor responsável da comissão disciplinar',
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

		$criteria->compare('CDConf',$this->CDConf);
		$criteria->compare('Servidor_Diretor',$this->Servidor_Diretor);
		$criteria->compare('Servidor_Comissao',$this->Servidor_Comissao);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}