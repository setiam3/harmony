<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>
?>
<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
<?php echo '<?php ';?>
$widget->run();