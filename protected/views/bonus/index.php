<?php
$this->breadcrumbs=array(
	'Bonuses',
);

?>

<h1>Bonuses</h1>
<?php 
echo '<b>TOTAL BONUS = '.number_format($total['bonus'],2,',','.')."\n"; 
echo 'TOTAL POIN = '.$total['poin'].'</b>';
$widget->run();