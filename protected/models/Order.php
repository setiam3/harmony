<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $order_code
 * @property string $order_date
 * @property string $kode_member
 * @property string $bank_transfer
 * @property integer $payment_status
 * @property double $grandtotal
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Order the static model class
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
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_code, order_date, kode_member, bank_transfer', 'required'),
			array('payment_status', 'numerical', 'integerOnly'=>true),
			array('grandtotal', 'numerical'),
			array('order_code', 'length', 'max'=>17),
			array('kode_member', 'length', 'max'=>45),
			array('bank_transfer', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_code, order_date, kode_member, bank_transfer, payment_status, grandtotal', 'safe', 'on'=>'search'),
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
			'order_code' => 'Order Code',
			'order_date' => 'Order Date',
			'kode_member' => 'Kode Member',
			'bank_transfer' => 'Bank Transfer',
			'payment_status' => 'Payment Status',
			'grandtotal' => 'Grandtotal',
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
		$criteria->compare('order_code',$_GET['sSearch'],true,'OR');
		$criteria->compare('order_date',$_GET['sSearch'],true,'OR');
		$criteria->compare('kode_member',$_GET['sSearch'],true,'OR');
		$criteria->compare('bank_transfer',$_GET['sSearch'],true,'OR');
		$criteria->compare('payment_status',$_GET['sSearch'],true,'OR');
		$criteria->compare('grandtotal',$_GET['sSearch'],true,'OR');
	}
		$criteria->compare('id',$this->id);
		$criteria->compare('order_code',$this->order_code,true);
		$criteria->compare('order_date',$this->order_date,true);
		$criteria->compare('kode_member',$this->kode_member,true);
		$criteria->compare('bank_transfer',$this->bank_transfer,true);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('grandtotal',$this->grandtotal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>new EDTSort(__CLASS__, $columns,array('id'=>'desc')),
			'pagination'=>new EDTPagination,
		));
	}
        public function afterSave() {
            //parent::beforeSave();
            //if($this->isNewRecord){
                //hitung potensi cashback
                $hargaakhir=Controller::diskonbelanja($this->grandtotal,$this->kode_member);//totalbelanja, kodemember
                if($this->grandtotal-$hargaakhir>0){
                        $bonus=new Bonus;
                        $bonus->bonus=$this->grandtotal-$hargaakhir;
                        $bonus->kode_member=$this->kode_member;
                        $bonus->tanggal=Controller::date_sql_now();
                        $bonus->keterangan='cashback diskon level pembelanjaan';
                        $bonus->dari_member=$this->kode_member;
                        $bonus->save();
                }
                //hitung pembagian cashback ke upline
                Controller::bonus6($this->kode_member,$hargaakhir);//kodemember, harga setelah diskon
                Controller::bonuspoinbelanja($this->grandtotal,$this->kode_member);
        //}
        }
}