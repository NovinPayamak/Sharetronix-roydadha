<?php
	
	if( !$this->network->id ) {
		$this->redirect('home');
	}
	if( !$this->user->is_logged ) {
		$this->redirect('signin');
	}
	$db2->query('SELECT 1 FROM users WHERE id="'.$this->user->id.'" AND is_network_admin=1 LIMIT 1');
	if( 0 == $db2->num_rows() ) {
		$this->redirect('dashboard');
	}
	
	$this->load_langfile('inside/global.php');
	$this->load_langfile('inside/admin.php');
	
	$D->page_title	= 'ثبت رویداد ها - '.$C->SITE_TITLE;
	$tabs = array('add','edit');
$D->tab = 'add';

if(trim($this->param('tab')) && in_array(trim($this->param('tab')),$tabs)){
$D->tab = trim($this->param('tab'));

}
	$D->menu_d	= array();
	$D->menu_m	= array("","فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور","مهر","آبان","آذر","دی","بهمن","اسفند");
	$D->menu_y	= array();
	
	for($i=1; $i<=31; $i++) {
		$D->menu_d[$i]	= $i;
	}
	for($i=intval(pdate('Y')); $i>=1300; $i--) {
		$D->menu_y[$i]	= $i;
	}
	
	$D->error =false;
	$D->submit = false;
	$D->error_msg = '';
	$D->submit_msg = 'ذخیره شد';
	$D->s = array();
	 $flag = false;
	
	
	if(isset($_POST['add'],$_POST['sh']) && !empty($_POST['sh'])){

	foreach($_POST['sh'] as $k=>$v){

	 $title = $db2->e($_POST['title'][$k]);
	 $about = $db2->e($_POST['about'][$k]);
	 $day = intval($_POST['day'][$k]);
	 $month = intval($_POST['month'][$k]);
	 $year = intval($_POST['year'][$k]);
	 
	 
	 if(!$title || !$about || $day=="0" || $month=="0" || $year=="0" ){
	 $D->error = true;
	 $D->error_msg .= 'تمام موارد باید تکمیل شود';
	 }
	 
	 
	 if(!$D->error){
	 
	 $db2->query('INSERT INTO rooydad SET title="'.$title.'" , about="'.$about.'" , day="'.$day.'", month="'.$month.'", year="'.$year.'"');
	 $flag = true;
	 }
	 
	
	}
	if($flag){
	 $D->submit = true;
	 $D->submit_msg .= '<br>مواردی ذخیره شد و در زیر مشاهده میفرمایید';
	 }
	
	}
	
	$db2->query('SELECT * FROM rooydad ORDER BY year DESC, month DESC , day DESC ');
	if($db2->num_rows()>0){
	
	while($o = $db2->fetch_object()){
	$D->s[] = $o;
	}
	
	}
if($D->tab == 'edit' && ($id = intval($this->param('id')))){
$D->r = new stdclass;



if(isset($_POST['edit'])){
     $title = $db2->e($_POST['title']);
	 $about = $db2->e($_POST['about']);
	 $day = intval($_POST['day']);
	 $month = intval($_POST['month']);
	 $year = intval($_POST['year']);
 if(!$title || !$about || $day=="0" || $month=="0" || $year=="0" ){
	 $D->error = true;
	 $D->error_msg .= 'تمام موارد باید تکمیل شود';
	 }
	  if(!$D->error){
	 
	 $db2->query('UPDATE  rooydad SET title="'.$title.'" , about="'.$about.'" , day="'.$day.'", month="'.$month.'", year="'.$year.'" WHERE id="'.$id.'" LIMIT 1');
	 $flag = true;
	 }
}
$db2->query('SELECT * FROM rooydad WHERE id="'.$id.'" LIMIT 1');
if($db2->num_rows() == 0){
$this->redirect('admin/happends');
}

$D->r = $db2->fetch_object();

}
	
	$this->load_template('admin_happends.php');
	
?>