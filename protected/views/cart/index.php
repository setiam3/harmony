<?php
$this -> breadcrumbs = array('Cart', );
?>

    <div class="row">
    <form id='cekout' method="post" action="<?php echo $this->createUrl('cart/finishshop')?>">
    <div class="form-group">
        <div class="col-sm-2">Kode Member</div>
        <div class="col-sm-4">
            <input type="text" id="kode_member" name="kode_member" class="form-control typeahead" data-remote="<?php echo $this->createUrl('cari?act=member&q=%QUERY')?>">
        </div>
        <?php echo CHtml::submitButton('Selesai')?>
</div></form>
    </div>
<br>
<div class="row">
			<div class="form-group">
				<div class="col-sm-2">Nama Barang</div>
				<div class="col-sm-4">
        <?php echo CHtml::dropDownList('produk','id',$this->get_produk(),array('data-allow-clear'=>'true','prompt'=>'','data-placeholder'=>'pilih produk','class'=>'select2 visible',
        	'ajax'=>array(
                        'type'=>'get',
                        'url'=>$this->createUrl('listproduct'),
                        'update'=>'#link1',
                        'data'=>array('id'=>'js:this.value'),
                        'success'=>'function(datae){
                            $("#link1").attr("value",datae);
                        }'
                        ),
        	
                    )
        ); ?>
			
		</div>
                                <div class="col-sm-2">
					<?php echo CHtml::htmlButton(
					'Add',array('id'=>'link1',
						'ajax'=>array(
	                        'type'=>'get',
	                        'url'=>$this->createUrl('product/addtocart/'),
	                        'data'=>array('id'=>'js:this.value'),
	                        'success'=>'function(datae){
	                        	location.reload();
	                        	//$("#cart").show();
	                        }'
	                        ),

					));?>
				</div>
			</div>
		</div>
<style>
	table {
		clear: both;
		border-collapse: collapse;
		margin-left: 5px;
		margin-top: 30px;
	}
	td {
		padding: 4px;
		border: solid 1px #cce2f8;
	}
	th {
		padding: 4px;
		border: solid 1px #cce2f8;
	}
	#clean td {
		border: none;
	}
</style>
<div id='cart' style="padding:0 10px 5px 0;margin:5px 5px 15px 5px; border:1px solid #CCC;text-align: justify;">

<?php
	if(empty($data)){
?>
<center>
	<h1 style="font-size:12px; margin: 5px 0 0 5px;">
		Keranjang Belanja Anda Kosong<br><br>
		<a style="text-decoration: none;color:green;" href="<?php echo $this->createUrl("product/");?>">Silahkan belanja</a>
	</h1>	
</center>
<?php }else{ ?>
<h1 style="float:left;font-size:12px; margin: 5px 0 0 5px;">Keranjang Belanja Anda</h1>
	

<table width="100%">
	<tr>
		<th>No</th>
		<th>Barang</th>
		<th align="right">Harga</th>
		<th align="right">Jumlah</th>
		<th align="right">Subtotal</th>
		<th align="center">#</th>
	</tr>


<?php echo CHtml::beginForm(array('change')); ?>
<?php $i=1;foreach($data as $model): $sum=$sum+($model['harga'] * $model['qty'])?>
	<?php echo CHtml::hiddenField('id' . $i, $model['id'], array('maxlength' => 3, 'style' => "width:20px;text-align:center")); ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><b><?php echo $model['nama_produk']; ?></b><br>
			<?php if(!empty($model['image'])):?>
    <a href="<?php echo Yii::app()->baseUrl.'/images/'.$model['image']?>"><?php echo CHtml::image($this->imagesUrl().$model['image'],'',array('class'=>"col-xs-4","style" => "width:82px;"));?>
    </a>
    <?php endif;?>
			</td>
		<td align="right"><b>IDR <b><?php echo number_format($model['harga'], 0, '.', '.'); ?></b></td>
		<td align="right"><?php echo CHtml::textField('qty' . $i, $model['qty'], array('maxlength' => 3, 'style' => "width:20px;text-align:center")); ?></td>
		<td align="right"><b>IDR <?php echo number_format($model['harga'] * $model['qty'], 0, '.', '.'); ?></b></td>	
		<td align="right"><?php echo CHtml::link(CHtml::encode("Hapus"), array('cart/remove', 'id' => $model['id'])); ?></td>
	</tr>
	
<?php $i++;
		endforeach;
	?>
	<tr id="clean">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Grand Total</td>
		<td>&nbsp;</td>
		<td align="right"><b>IDR <?=number_format($sum, 0, ",", ".") ?></b></td>
		<td></td>
	</tr>
	<tr id="clean">
		<td></td>
		<td><?php 
		echo CHtml::link('Belanja Lagi',array('product/index'),array('class'=>'btn'));


		//echo CHtml::button('Belanja lagi', array('submit' => array('product/index'))); ?></td>
		<td>&nbsp;</td>
		<td align="right"><?php echo CHtml::submitButton('Ubah'); ?></td>
		<td><?php //echo CHtml::link('Selesai Belanja', array('cart/finishshop')); ?></td>
		<td>&nbsp;</td>
	</tr>
			
</table>
                                        
<?php echo CHtml::endForm(); ?>
<?php } ?>
</div>
<script>
 $("#cekout").submit(function() {
      if ($('#kode_member').val()!=='') {
        return true;
      }
      else {
      	alert('isi kode member dulu');
        return false;
      }
    });

// $('input[type=submit]').click(function(e){
// 	e.preventDefault();
// 	if($('#kode_member').val()==''){
//     	alert('isi kode member dulu');
//     	return false;
//     }
//     $('form').submit();
// })
    

</script>
<!-- Imported styles on this page -->
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2-bootstrap.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/selectboxit/jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/minimal/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/square/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/flat/_all.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/futurico/futurico.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/skins/polaris/polaris.css">

    <!-- Bottom scripts (common) -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

    <!-- Imported scripts on this page -->

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/select2/select2.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/typeahead.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>

    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/moment.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/jquery.multi-select.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/icheck/icheck.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/assets/js/neon-chat.js"></script>