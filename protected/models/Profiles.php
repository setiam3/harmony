<?php

/**
 * This is the model class for table "profiles".
 *
 * The followings are the available columns in table 'profiles':
 * @property integer $user_id
 * @property string $lastname
 * @property string $firstname
 * @property string $nik
 * @property string $nama
 * @property string $alamat
 * @property string $hp
 * @property string $bank
 * @property string $rekening
 * @property string $tgllahir
 * @property string $kode_upline
 * @property string $sponsor
 * @property string $kode_member
 * @property string $level
 * @property string $foto
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Profiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Profiles the static model class
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
		return 'profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alamat', 'required'),
			array('lastname, firstname, nama, kode_upline, sponsor, kode_member, level, foto', 'length', 'max'=>50),
			array('nik', 'length', 'max'=>25),
			array('hp, bank, rekening', 'length', 'max'=>20),
			array('tgllahir', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, lastname, firstname, nik, nama, alamat, hp, bank, rekening, tgllahir, kode_upline, sponsor, kode_member, level, foto', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'nik' => 'Nik',
			'nama' => 'Nama',
			'alamat' => 'Alamat',
			'hp' => 'Hp',
			'bank' => 'Bank',
			'rekening' => 'Rekening',
			'tgllahir' => 'Tgllahir',
			'kode_upline' => 'Kode Upline',
			'sponsor' => 'Sponsor',
			'kode_member' => 'Kode Member',
			'level' => 'Level',
			'foto' => 'Foto',
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
		$criteria->compare('user_id',$_GET['sSearch'],true,'OR');
		$criteria->compare('lastname',$_GET['sSearch'],true,'OR');
		$criteria->compare('firstname',$_GET['sSearch'],true,'OR');
		$criteria->compare('nik',$_GET['sSearch'],true,'OR');
		$criteria->compare('nama',$_GET['sSearch'],true,'OR');
		$criteria->compare('alamat',$_GET['sSearch'],true,'OR');
		$criteria->compare('hp',$_GET['sSearch'],true,'OR');
		$criteria->compare('bank',$_GET['sSearch'],true,'OR');
		$criteria->compare('rekening',$_GET['sSearch'],true,'OR');
		$criteria->compare('tgllahir',$_GET['sSearch'],true,'OR');
		$criteria->compare('kode_upline',$_GET['sSearch'],true,'OR');
		$criteria->compare('sponsor',$_GET['sSearch'],true,'OR');
		$criteria->compare('kode_member',$_GET['sSearch'],true,'OR');
		$criteria->compare('level',$_GET['sSearch'],true,'OR');
		$criteria->compare('foto',$_GET['sSearch'],true,'OR');
	}
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('rekening',$this->rekening,true);
		$criteria->compare('tgllahir',$this->tgllahir,true);
		$criteria->compare('kode_upline',$this->kode_upline,true);
		$criteria->compare('sponsor',$this->sponsor,true);
		$criteria->compare('kode_member',$this->kode_member,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>new EDTSort(__CLASS__, $columns,array('id'=>'desc')),
			'pagination'=>new EDTPagination,
		));
	}
}