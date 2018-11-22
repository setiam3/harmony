<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlahwd')); ?>:</b>
	<?php echo CHtml::encode($data->jumlahwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode_member')); ?>:</b>
	<?php echo CHtml::encode($data->kode_member); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_wd')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_wd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlahbayar')); ?>:</b>
	<?php echo CHtml::encode($data->jumlahbayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggalbayar')); ?>:</b>
	<?php echo CHtml::encode($data->tanggalbayar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />


</div>