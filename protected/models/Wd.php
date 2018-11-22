<?php

/**
 * This is the model class for table "Withdrawl".
 *
 * The followings are the available columns in table 'Withdrawl':
 * @property integer $id
 * @property double $jumlahwd
 * @property string $kode_member
 * @property string $tanggal_wd
 * @property double $jumlahbayar
 * @property string $tanggalbayar
 * @property string $keterangan
 */
class Wd extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Wd the static model class
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
		return 'Withdrawl';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jumlahwd, kode_member, tanggal_wd, jumlahbayar', 'required'),
			array('jumlahwd, jumlahbayar', 'numerical'),
			array('kode_member', 'length', 'max'=>45),
			array('keterangan', 'length', 'max'=>255),
			array('tanggalbayar', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jumlahwd, kode_member, tanggal_wd, jumlahbayar, tanggalbayar, keterangan', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'jumlahwd' => 'Jumlahwd',
			'kode_member' => 'Kode Member',
			'tanggal_wd' => 'Tanggal Wd',
			'jumlahbayar' => 'Jumlahbayar',
			'tanggalbayar' => 'Tanggalbayar',
			'keterangan' => 'Keterangan',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(array $columns)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if (isset($_GET['sSearch'])) {
		$criteria->compare('id',$_GET['sSearch'],true,'OR');
		$criteria->compare('jumlahwd',$_GET['sSearch'],true,'OR');
		$criteria->compare('kode_member',$_GET['sSearch'],true,'OR');
		$criteria->compare('tanggal_wd',$_GET['sSearch'],true,'OR');
		$criteria->compare('jumlahbayar',$_GET['sSearch'],true,'OR');
		$criteria->compare('tanggalbayar',$_GET['sSearch'],true,'OR');
		$criteria->compare('keterangan',$_GET['sSearch'],true,'OR');
	}
		$criteria->compare('id',$this->id);
		$criteria->compare('jumlahwd',$this->jumlahwd);
		$criteria->compare('kode_member',$this->kode_member,true);
		$criteria->compare('tanggal_wd',$this->tanggal_wd,true);
		$criteria->compare('jumlahbayar',$this->jumlahbayar);
		$criteria->compare('tanggalbayar',$this->tanggalbayar,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>new EDTSort(__CLASS__, $columns,array('id'=>'desc')),
			'pagination'=>new EDTPagination,
		));
	}
}