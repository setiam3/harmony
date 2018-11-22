<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
        private function addQuantity($product_id, $cart_code = '', $qty = '') {
		/*model Cart findBy attributes product_id dan cart_code*/
		$modelCart = Cart::model() -> findByAttributes(array('product_id' => $product_id, 'cart_code' => $cart_code));
		/*jika ada didalam keranjang belanja*/
		if (count($modelCart) > 0) {
			/*maka update qty nya*/
			$modelCart -> qty += $qty;
			/*simpan dan return true*/
			$modelCart -> save();
			return TRUE;
		} else {
			/*lain dari itu return false*/
			return FALSE;
		}
	}
	/*untuk menambahkan product ke keranjang belanja*/
	public function actionAddtocart($id) {
                if(Yii::app()->request->isPostRequest){
                    print_r($_POST);die;
                }
		/*gunakan layout store*/
		//$this -> layout = 'store';
		/*panggil model Cart*/
		$model = new Cart;
		/*set data ke masing masing field*/
		/*product_id*/
		$_POST['Cart']['product_id'] = $id;
		/*qty*/
		$_POST['Cart']['qty'] = 1;
		/*cart_code*/
		$_POST['Cart']['cart_code'] = Yii::app()->session['cart_code'];
		/*set ke attribut2*/
		$model -> attributes = $_POST['Cart'];
		
		/*update qty-nya jika produk sudah ada di dalam keranjang belanja
		 *menjadi +1*/
		if ($this -> addQuantity($id, Yii::app()->session['cart_code'], 1)) {
			/*direct ke halaman cart*/	
			$this -> redirect(array('cart/'));
		/*add ke keranjang belanja jika produk belum ada di keranjang*/	
		} elseif ($model -> save()) {
			/*direct ke halaman cart*/ 
			$this -> redirect(array('cart/'));
		} else {
			/*produk tidak ada di dalam data product kasih error 404*/
			throw new CHttpException(404, 'The requested id invalid.');
		}

	}
        public function actionIndex()
	{
		/*gunakan layout store*/
		//$this -> layout = 'store';
		/*order by id desc*/
		$criteria = new CDbCriteria( array('order' => 'id DESC', ));
		/*count data product*/
		$count = Product::model() -> count($criteria);
		/*panggil class paging*/
		$pages = new CPagination($count);
		/*elements per page*/
		$pages -> pageSize = 8;
		/*terapkan limit page*/
		$pages -> applyLimit($criteria);

		/*select data product
		 *cache(1000) digunakan untuk men cache data,
		 * 1000 = 10menit*/
		$models = Product::model() -> cache(1000) -> findAll($criteria);

		/*render ke file index yang ada di views/product
		 *dengan membawa data pada $models dan
		 *data pada $pages
		 **/
		$this -> render('products', array('models' => $models, 'pages' => $pages, ));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate(){
		$model=new Product;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$images=CUploadedFile::getInstancesByName('foto');
                if (isset($images) && count($images) > 0){
                    $i=1;
                    foreach ($images as $image=>$pic) {
                        $ext=substr($pic, strrpos($pic, '.')+1);
                        if(in_array($ext, $this->arrayImages)){
                            $pic->saveAs($this->imagesPath().'Produk'.$model->id.'_'.$i.'_'.'.'.$ext);
                        }else{
                            $messageType = 'warning';
                            $message = "<strong>Only images file type allowed";
                            Yii::app()->user->setFlash($messageType, $message);
                            $this->redirect(array('create'));
                        }
                        $foto='Produk'.$model->id.'_'.$i.'_'.'.'.$ext;
                    //image resize
$image= Yii::app()->image->load($this->imagesPath().'Produk'.$model->id.'_'.$i.'_'.'.'.$ext);
                    $image->resize(640,640);
                    $image->save();
                    $i++;
                    }
                $model->image=$foto;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$images=CUploadedFile::getInstancesByName('foto');
                if (isset($images) && count($images) > 0){
                    $i=1;
                    foreach ($images as $image=>$pic) {
                        $ext=substr($pic, strrpos($pic, '.')+1);
                        if(in_array($ext, $this->arrayImages)){
                            $pic->saveAs($this->imagesPath().'Produk'.$model->id.'_'.$i.'_'.'.'.$ext);
                        }else{
                            $messageType = 'warning';
                            $message = "<strong>Only images file type allowed";
                            Yii::app()->user->setFlash($messageType, $message);
                            $this->redirect(array('create'));
                        }
                        $foto='Produk'.$model->id.'_'.$i.'_'.'.'.$ext;
        $image= Yii::app()->image->load($this->imagesPath().'Produk'.$model->id.'_'.$i.'_'.'.'.$ext);
                    $image->resize(640,640);
                    $image->save();
                        
                    $i++;
                    }
	                $model->image= $foto;
	            }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	public $columns=array(
				array(
        		'type'=>'html',
        		'name'=>'nama_produk',
        		'value'=>'CHtml::link($data->nama_produk,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
                        array(
        		'type'=>'html',
        		'name'=>'harga',
        		'value'=>'CHtml::link($data->harga,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'desc',
        		'value'=>'CHtml::link($data->desc,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
			array(
        		'type'=>'html',
        		'name'=>'image',
        		'value'=>'CHtml::link($data->image,Yii::app()->controller->createUrl("view",array("id"=>$data->id)))',
        		),
	);

	/**
	 * Lists all models.
	 */
	public function actionLists()
	{
		$model=new Product('search');
		$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'Product-grid',
		 'dataProvider'  => $model->search($this->columns),
		 'ajaxUrl'       => $this->createUrl($this->getAction()->getId()),
		 'columns'       => $this->columns,
         'bootstrap'=>true,
		));
		
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
		  $this->render('index', array('widget' => $widget));
		  return;
		} else {
		  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
		  Yii::app()->end();
		}

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$ar1=array('class'=> 'EButtonColumn',
            'template'=>'{update}{delete}',
		    'buttons'=>array(
		    	'update'=>array(
		    		'url'=>'Yii::app()->createUrl("Product/update/$data->id")',
		    		),
		        'delete' => array(
		        	'url'=>'Yii::app()->createUrl("Product/delete/$data->id")',
		            'visible'=>'Yii::app()->user->getIsSuperuser()==1',           
		        ),
		    ));
        array_push($this->columns,$ar1);

		$model=new Product('search');
		$model->unsetAttributes();

		$widget=$this->createWidget('ext.EDataTables.EDataTables', array(
		 'id'            => 'bonus-grid',
		 'dataProvider'  => $model->search($this->columns),
		 'ajaxUrl'       => $this->createUrl($this->getAction()->getId()),
		 'columns'       => $this->columns,
         'bootstrap'=>true,
		));
		
		if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
		  $this->render('admin', array('widget' => $widget));
		  return;
		} else {
		  echo json_encode($widget->getFormattedData(intval($_REQUEST['sEcho'])));
		  Yii::app()->end();
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
