<?php

/**
 * This is the model class for table "D_ResponsavelProcDisciplinar".
 *
 * The followings are the available columns in table 'D_ResponsavelProcDisciplinar':
 * @property integer $CDRespProcDisc
 * @property integer $CDServidor
 *
 * The followings are the available model relations:
 * @property Servidor $cDServidor
 */
class DResponsavelProcDisciplinar extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DResponsavelProcDisciplinar the static model class
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
		return 'D_ResponsavelProcDisciplinar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CDServidor', 'required'),
			array('CDServidor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CDRespProcDisc, CDServidor', 'safe', 'on'=>'search'),
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
			'cDServidor' => array(self::BELONGS_TO, 'Servidor', 'CDServidor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CDRespProcDisc' => 'Cdresp Proc Disc',
			'CDServidor' => 'Cdservidor',
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

		$criteria->compare('CDRespProcDisc',$this->CDRespProcDisc);
		$criteria->compare('CDServidor',$this->CDServidor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}