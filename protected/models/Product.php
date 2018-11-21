<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $nama_produk
 * @property double $harga
 * @property string $desc
 * @property string $image
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_produk, harga', 'required'),
			array('harga', 'numerical'),
			array('nama_produk', 'length', 'max'=>45),
			array('image', 'length', 'max'=>225),
			array('desc', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nama_produk, harga, desc, image', 'safe', 'on'=>'search'),
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
			'nama_produk' => 'Nama Produk',
			'harga' => 'Harga',
			'desc' => 'Desc',
			'image' => 'Image',
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
		$criteria->compare('nama_produk',$_GET['sSearch'],true,'OR');
		$criteria->compare('harga',$_GET['sSearch'],true,'OR');
		$criteria->compare('desc',$_GET['sSearch'],true,'OR');
		$criteria->compare('image',$_GET['sSearch'],true,'OR');
	}
		$criteria->compare('id',$this->id);
		$criteria->compare('nama_produk',$this->nama_produk,true);
		$criteria->compare('harga',$this->harga);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>new EDTSort(__CLASS__, $columns,array('id'=>'desc')),
			'pagination'=>new EDTPagination,
		));
	}
}