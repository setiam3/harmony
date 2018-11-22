<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public $arrayImages=array('jpg','bmp','png','jpeg','pdf');
    public static function imagesPath(){
        return Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;   
    }
    public static function imagesUrl(){
        return Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
    }
    public static function date_sql_now(){
        return gmdate("Y-m-d H:i:s", time()+60*60*7);
    }

    public static function tanggal_indo($tanggal){//tanggal mysql to indo
    if(isset($tanggal) && !empty($tanggal)){
        $split=explode('-', $tanggal);
        return $split[2].'-'.$split[1].'-'.$split[0];}
    }
    public function isActive($d){
            if(isset($this->module)){
                $controller=$this->module->id.'/'.$this->id;
            }else{
                $controller= $this->id;
            }
            $baseUrl=Yii::app()->baseUrl;
           $a="'".$baseUrl.'/'.$d."'";
            if($d===$controller.'/'.Yii::app()->controller->action->id){
                echo '<script>'
                . 'jQuery(function($){
                    jQuery.noConflict();
                    $("a[href*='.$a.']").parent().addClass("active");
                    $("a[href*='.$a.']").parent().parent().addClass("visible");
                    $("a[href*='.$a.']").parent().parent().parent().addClass("opened active");
                    $("a[href*='.$a.']").parent().parent().parent().parent().parent().addClass("opened active");
                });'
                . '</script>';
         }     
    }
    public static function arMessage(){//member notify()
        return array('success','alert','warning','danger','error');
    }
    public function notify(){
        foreach ($this->arMessage() as $type) {
        if (!Yii::app()->user->hasFlash($type))
                continue;
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/assets/js/toastr.js',CClientScript::POS_END);
        $alertext=Yii::app()->user->getFlash($type); 
        echo "<script>"
            . "jQuery(function($){jQuery.noConflict();setTimeout(function(){			
		var opts = {
			'closeButton': true,
			'debug': false,
			'positionClass': 'toast-top-right',
			'onclick': null,
			'showDuration': '30',
			'hideDuration': '1000',
			'timeOut': '5000',
			'extendedTimeOut': '1000',
			'showEasing': 'swing',
			'hideEasing': 'linear',
			'showMethod': 'fadeIn',
			'hideMethod': 'fadeOut'
		};
		toastr.$type('".$alertext."', '".$type."', opts);
	}, 3000);         
});"
            ."</script>";
            }
        }
        public static function genListView($model,$attributes,$id=null){//model, attrbutes, id
        $tbname=Controller::generateRandomString();
            $i=0; $n= 0;
        echo '<table class="table table-bordered table-responsive table-hover" id="'.$tbname.'">';
            //looping th labels
        foreach($attributes as $attribute){
			if(is_string($attribute))
			{
				if(!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/',$attribute,$matches))
					throw new CException(Yii::t('zii','The attribute must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));
				$attribute=array(
					'name'=>$matches[1],
					'type'=>isset($matches[3]) ? $matches[3] : 'text',
				);
				if(isset($matches[5]))
					$attribute['label']=$matches[5];
			}
			if(isset($attribute['visible']) && !$attribute['visible'])
				continue;
                        if(isset($attribute['label']))
				$tr['{label}']=$attribute['label'];
			elseif(isset($attribute['name']))
			{
				if($model instanceof CModel)
					$tr['{label}']=$model::model()->getAttributeLabel($attribute['name']);
				else
					$tr['{label}']=ucwords(trim(strtolower(str_replace(array('-','_','.'),' ',preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $attribute['name'])))));
			}
			if(!isset($attribute['type']))
				$attribute['type']='text';
			if(isset($attribute['value']))
				$value=is_object($attribute['value']) && get_class($attribute['value']) === 'Closure' ? call_user_func($attribute['value'],$this->data) : $attribute['value'];
			elseif(isset($attribute['name']))
				$value=CHtml::value($model,$attribute['name']);
			else
				$value=null;
			$i++;
            echo '<tr><td class="col-sm-1" style="font-weight:bold;text-align:right;">'.$tr['{label}'].'</td><td class="col-sm-6">'.$value.'</td></tr>';
		}
            echo '</table>';
        }
    public static function generateRandomString($length = 10){//member gentables
        $charaters = "01234567890abcdefghijklmnopqrstuvwxyz";
        $randomString = '';
        for($i = 0; $i<$length;$i++){
        $randomString .= $charaters[rand(0,strlen($charaters) - 1)];
        }
        return $randomString;
    }
    public function deepValues(array $array, array &$values) {
        foreach($array as $level) {
            if (is_array($level)) {
                $this->deepValues($level, $values);
            } else {
                $values[$level] = $level;
            }
        }
        //return $value;
    }
    public function getUpline($cnd){
        $row = array();
        foreach(Member::model()->cache(1000)->findAllByAttributes(array('kode_member'=>$cnd)) as $haha){
            if($haha->kode_upline!=='#' or $haha->level!=='distributor'){
                $row[] = $cnd;
                $row['upline'] = $haha->kode_upline;
                if(count($this->getUpline2($haha->kode_upline))>0){
                    $row[] = $this->getUpline2($haha->kode_upline);
                }
            }
        }
        return $row;
    }
    public function getUpline2($cnd){
        $row = array();
        foreach(Member::model()->cache(1000)->findAllByAttributes(array('kode_member'=>$cnd)) as $haha){
             if($haha->kode_upline!=='#'){
                $row['upline'] = $haha->kode_upline;
                if(count($this->getUpline2($haha->kode_upline))>0 && $haha->kode_upline!=='#'){
                   $row[] = $this->getUpline2($haha->kode_upline);
                }
            }
        }
        return $row;
    }
    public function comboSponsor($kode_member){
        $values=array();
        foreach(Controller::getUpline($kode_member) as $level) {
            if (is_array($level)) {
                Controller::deepValues($level, $values);
            } else {
                $values[$level] = $level;
            }
        }
        if(in_array('#', $values)){
            array_pop($values);
        }
        return $values;
    }
    public function jsonmember(){
        $js=array();
        if(empty($_POST['id'])){
            if(empty(Member::model()->findAll())){
                $js=array('id'=>'#','text'=>'#');
            }else{
                foreach(Member::model()->findAll('level!="distributor"') as $k=>$row){
                    $js[]=array('id'=>$row->kode_member,'text'=>$row->kode_member.'-'.$row->nama.'-'.$row->alamat);
                }
            }
        }else{
            foreach(Member::model()->findAll('level!="distributor" and kode_member="'.$_POST['id'].'"') as $k=>$row){
                    $js[]=array('id'=>$row->kode_member,'text'=>$row->kode_member.'-'.$row->nama.'-'.$row->alamat);
                }
        }
        echo CJSON::encode($js);
    }
    public static function get_member($q){
        $qs = new CDbCriteria(array('select'=>'kode_member','condition' => "kode_member LIKE :match",'params'=> array(':match' => "%$q%")));
        $model=Member::model()->findAll($qs);
        $arr=array();
        foreach ($model as $value) {
            $arr[]=$value->kode_member;
        }
        echo json_encode($arr);
    }
    public static function id_member(){
        return Member::model()->findByAttributes(array('id'=>Yii::app()->user->id))->kode_member;
    }
    public static function reg_upline($q){
        $qs = new CDbCriteria(array('select'=>'kode_member','condition' => "level!='distributor' and kode_member LIKE :match",'params'=> array(':match' => "%$q%")));
        $model=Member::model()->findAll($qs);
        $arr=array();
        foreach ($model as $value) {
            $arr[]=$value->kode_member;
        }
        echo json_encode($arr);
    }
    public static function cari($act,$q){
        if($act==='upline'){Controller::reg_upline($q);die;}
        if($act==='member'){Controller::get_member($q);die;}
    }
    public static function autoformat(){
        $getlastjo=Yii::app()->db->createCommand('select kode_member from member order by user_id desc limit 1')->queryScalar();//BY0000001
        $format='BY';
        if(!empty($getlastjo)){
            $t=trim($getlastjo,$format);
            $lastno=intval($t)+1;
        }else{
            $lastno=1;
        }
            if(strlen($lastno)==1){
                $lastno='000000'.$lastno;
            }elseif(strlen($lastno)==2){
                $lastno='00000'.$lastno;
            }elseif(strlen($lastno)==3){
                $lastno='0000'.$lastno;
            }elseif(strlen($lastno)==4){
                $lastno='000'.$lastno;
            }elseif(strlen($lastno)==5){
                $lastno='00'.$lastno;
            }elseif(strlen($lastno)==6){
                $lastno='0'.$lastno;
            }elseif(strlen($lastno)==7){
                $lastno=$lastno;
            }
        return $format.$lastno;
    }
    public static function get_upline($kodemember){
        $sql=Yii::app()->db->createCommand('select kode_upline from member where kode_member="'.$kodemember.'"')->queryRow();
        return $sql['kode_upline'];
    }
    public static function get_level($kodemember){
        if($kodemember!=='#'){
            $mem=Member::model()->findByAttributes(array('kode_member'=>$kodemember));
        return $mem->level;
        }
    }
    public static function diskonbelanja($total,$kodemember=NULL){
        $level=Controller::get_level($kodemember);
        $mb=SettingBonus::model()->findByAttributes(array('jenis_bonus'=>"diskonbelanja",'param'=>$level));
        return round($total-($total*$mb->bonus),2);
    }
    public static function bonus6($kodemember,$setelahdiskon){
        $upline1=Controller::get_upline($kodemember);
        $upline2=Controller::get_upline(Controller::get_upline($kodemember));
        $upline3=Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember)));
        $upline4=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember))));
        $upline5=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember)))));
        $upline6=Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline(Controller::get_upline($kodemember))))));
        if($setelahdiskon>0){
            if($upline1!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline1;//yg nerima bonus;
                $bonus->bonus=(1/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc1';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
            if($upline2!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline2;//yg nerima bonus;
                $bonus->bonus=(0.8/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc2';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
            if($upline3!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline3;//yg nerima bonus;
                $bonus->bonus=(0.5/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc3';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
            if($upline4!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline4;//yg nerima bonus;
                $bonus->bonus=(0.3/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc4';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
            if($upline5!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline5;//yg nerima bonus;
                $bonus->bonus=(0.3/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc5';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
            if($upline6!=='#'){
                $bonus=New Bonus;
                $bonus->kode_member=$upline6;//yg nerima bonus;
                $bonus->bonus=(0.3/100)*$setelahdiskon;
                $bonus->tanggal=Controller::date_sql_now();
                $bonus->keterangan='disc6';
                $bonus->dari_member=$kodemember;
                $bonus->idbonus='';
                $bonus->save();
            }
        }
    }
    public static function get_id($kodemember){
        return Member::model()->findByAttributes(array('kode_member'=>$kodemember))->id;
    }
    public static function get_sponsor($kodemember){
        $mem=Member::model()->findByAttributes(array('kode_member'=>$kodemember));
        return $mem->sponsor;
    }
    public static function company(){
        return SettingPerusahaan::model()->cache(2000)->findByPk(1)->nama_perusahaan;
    }
    public static function upgradelevel($kodeupline){
        if(!empty($kodeupline) && $kodeupline!=='#'){
           $upline=Member::model()->countByAttributes(array('kode_member'=>$kodeupline));
        if($upline>0){
            $jmldownline=Member::model()->countByAttributes(array('kode_upline'=>$kodeupline));
            if($jmldownline==1){
                $jmldownline=0;
            }
            $sql='select max(member) AS max from setting_level limit 1';
            $cmd=Yii::app()->db->createCommand($sql);
            $max=$cmd->queryRow();
            $q2=SettingLevel::model()->findByAttributes(array('member'=>$jmldownline));
            if(!empty($q2) && count($jmldownline)<=$max['max']){//max di setting level
                $sql="
                update profiles set level='$q2->level' where kode_member='$kodeupline';
                update AuthAssignment set itemname='$q2->level' where userid=".Controller::get_id($kodeupline).";";
                Yii::app()->db->createCommand($sql)->execute();
                return true;
            }
        }
        }
        
    }

    public static function bonussponsor($kodesponsor,$kodemember){
        if($kodesponsor!='#' || $kodemember!='#'){
        $q1=SettingBonus::model()->findAllByAttributes(array('jenis_bonus'=>'sponsor'));
        $jmlsponsor=Member::model()->countByAttributes(array('sponsor'=>$kodesponsor));
        foreach ($q1 as $value) {
            $upline_level=Controller::get_level(Controller::get_upline($kodemember));
            if($jmlsponsor>0 && is_numeric($value->param)){
                if($jmlsponsor%$value->param==0 && $kodesponsor!='#'){
                    $model=new Bonus;
                    $model->kode_member=$kodesponsor;
                    $model->bonus=$value->bonus;
                    $model->tanggal=Controller::date_sql_now();
                    $model->keterangan=$value->keterangan;
                    $model->dari_member=$kodemember;
                    $model->idbonus=$value->id;
                    $model->save();
                }
            }
            elseif(!is_numeric($value->param) && !empty($upline_level) && $upline_level==$value->param){
                $mb=Bonus::model()->findAllByAttributes(array('dari_member'=>Controller::get_upline($kodemember)));
                $inarray=array();
                foreach($mb as $bonus){
                    $inarray[]=$bonus->idbonus;//simpan dalam array
                }
                if(is_array($inarray)){
                    if(!in_array($value->id, $inarray) && Controller::get_sponsor(Controller::get_upline($kodemember))!='#'){//19 id bonus sponsorship
                        //echo '<script>console.log("bonus 10k")</script>';
                        $models=new Bonus;
                        $models->kode_member=Controller::get_sponsor(Controller::get_upline($kodemember));
                        $models->bonus=$value->bonus;
                        $models->tanggal=Controller::date_sql_now();
                        $models->keterangan=$value->keterangan;
                        $models->dari_member=Controller::get_upline($kodemember);
                        $models->idbonus=$value->id;
                        $models->save();
                    }}
                }
            }
        }
    }
    public static function hitungbonusgetmember($kodeupline=NULL,$kodemember){
        if(empty($kodeupline) && $kodeupline=='#'){ return true;}else{
        $upline=Member::model()->countByAttributes(array('kode_member'=>$kodeupline));
        if($upline>0){
            $q1=SettingBonus::model()->findAllByAttributes(array('jenis_bonus'=>'getmember'));
            $jmldownline=Member::model()->countByAttributes(array('kode_upline'=>$kodeupline));
            //$jmldownline=5;
            foreach ($q1 as $value) {
                if($jmldownline>0 && is_numeric($value->param)){
                    if($jmldownline%$value->param==0){
                        $model=new Bonus;
                        $model->kode_member=$kodeupline;
                        $model->bonus=$value->bonus;
                        $model->tanggal=Controller::date_sql_now();
                        $model->keterangan=$value->keterangan;
                        $model->dari_member=$kodemember;
                        $model->idbonus=$value->id;
                        $model->save();
                    }
                }
                //tambahkan bonus poin
                if(!is_numeric($value->param) && $value->param=='poin'){
                    $model=new Bonus;
                    $model->kode_member=$kodeupline;
                    $model->poin=$value->bonus;
                    $model->tanggal=Controller::date_sql_now();
                    $model->keterangan=$value->keterangan;
                    $model->dari_member=$kodemember;
                    $model->idbonus=$value->id;
                    $model->save();
                }}
            }
        }
    }

    public static function bonuspoinbelanja($totalbelanja,$kodemember){
        $range=array();
        $sb=SettingBonus::model()->findAll('jenis_bonus="poin" order by param asc');
        foreach ($sb as $k=>$value) {
            $range[$k]=$value;
        }
        Controller::bonuspoinbelanja1($totalbelanja,$range,$kodemember);
    }
    public static function bonuspoinbelanja1($totalbelanja,$range,$kodemember){
        switch ($totalbelanja) {
            case ($totalbelanja>=$range[0]['param'] && $totalbelanja<$range[1]['param']):
                $poin=$range[0]['bonus'];
                if(isset($poin) && $poin>0 && !empty($poin) && !empty($totalbelanja) && $totalbelanja>1){
                    //insert to bonus
                    $bonus=new Bonus;
                    $bonus->kode_member=$kodemember;
                    $bonus->poin=$poin;
                    $bonus->tanggal=Controller::date_sql_now();
                    $bonus->dari_member=$kodemember;
                    $bonus->keterangan=$range[0]['keterangan'];
                    $bonus->idbonus=$range[0]['id'];
                    $bonus->save();
                }
                if($totalbelanja-$range[0]['param']>=$range[0]['param']){
                    Controller::bonuspoinbelanja($totalbelanja-$range[0]['param'],$kodemember);
                }
                break;
            case ($totalbelanja>=$range[1]['param'] && $totalbelanja<$range[2]['param'] && !empty($totalbelanja) && $totalbelanja>1):
                $poin=$range[1]['bonus'];
                if(isset($poin) && $poin>0 && !empty($poin)){
                    //insert to bonus
                    $bonus=new Bonus;
                    $bonus->kode_member=$kodemember;
                    $bonus->poin=$poin;
                    $bonus->tanggal=Controller::date_sql_now();
                    $bonus->dari_member=$kodemember;
                    $bonus->keterangan=$range[1]['keterangan'];
                    $bonus->idbonus=$range[1]['id'];
                    $bonus->save();
                }
                if($totalbelanja-$range[1]['param']>0){
                    Controller::bonuspoinbelanja($totalbelanja-$range[1]['param'],$kodemember);
                }
                break;
            case ($totalbelanja>=$range[2]['param'] && !empty($totalbelanja) && $totalbelanja>1):
                $poin=$range[2]['bonus'];
                if(isset($poin) && $poin>0 && !empty($poin)){
                    //insert to bonus
                    $bonus=new Bonus;
                    $bonus->kode_member=$kodemember;
                    $bonus->poin=$poin;
                    $bonus->tanggal=Controller::date_sql_now();
                    $bonus->dari_member=$kodemember;
                    $bonus->keterangan=$range[2]['keterangan'];
                    $bonus->idbonus=$range[2]['id'];
                    $bonus->save();
                }
                if($totalbelanja-$range[2]['param']>0){
                    Controller::bonuspoinbelanja($totalbelanja-$range[2]['param'],$kodemember);
                }
                break;
            
            default:
                // code...
                break;
        }
    }
}