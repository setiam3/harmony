<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<?php $kodemember='BY0000002';
$upline1=Controller::get_upline($kodemember);
        $upline2=Controller::get_upline(Controller::get_upline($kodemember));
        $upline3=Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember)));
        $upline4=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember))));
        $upline5=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember)))));
        $upline6=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember))))));
echo $upline1!=='#'?$upline1:''.'<br>';
echo $upline2!=='#'?$upline2:''.'<br>';
echo $upline3!=='#'?$upline3:''.'<br>';
echo $upline4!=='#'?$upline4:''.'<br>';
echo $upline5!=='#'?$upline5:''.'<br>';
echo $upline6!=='#'?$upline6:''.'<br>';
?>