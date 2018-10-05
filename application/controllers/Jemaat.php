<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jemaat extends MY_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->model([
			'mjemaat',
			'mpstatus',
			'mparameter',
			'mblood',
			'mkebaktian',
			'mpersekutuan',
			'mrayon',
			'mserving',
			'mmenu'
		]);
        $this->load->library('pinyin');

	}

	function download($filename){
		$this->load->helper('download');
		$data = file_get_contents('uploads/'.$filename);
		force_download($filename,$data);
	}

	function index(){
		$this->view();
	}

	function m(){
		$this->view();
	}

	function pi(){
		$this->view();
	}

	function creatrelation(){
		$this->mjemaat->creat_relation();
		echo 1;
	}

	function simpan_relation($recno){
		$this->mjemaat->simpan_relation($recno);
		echo $recno;
	}

	function view(){
		$data['sqlgender'] = getParameter('GENDER');
		$data['sqlpstatus'] =getParameter('PSTATUS');

		$data['sqlstatusidv'] = getParameter('STATUS');
		$data['sqlblood'] =getParameter('BLOOD');
		$data['sqlkebaktian'] =getParameter('KEBAKTIAN');
		$data['sqlpersekutuan'] =getParameter('PERSEKUTUAN');
		$data['sqlrayon'] =getParameter('RAYON');

		$data['statusidv'] = getComboParameter('STATUS');
		$data['blood'] = getComboParameter('BLOOD');
		$data['gender'] = getComboParameter('GENDER');
		$data['pstatus'] = getComboParameter('PSTATUS');
		$data['kebaktian'] = getComboParameter('KEBAKTIAN');
		$data['persekutuan'] =getComboParameter('PERSEKUTUAN');
		$data['rayon'] = getComboParameter('RAYON');
		$this->render('jemaat/gridjemaat',$data);
	}
	// function grid3($status=''){
	// 	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	// 	$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
	// 	$sort = isset($_GET['sort']) ? strval($_GET['sort']) : 'member_key';
	// 	$order = isset($_GET['order']) ? strval($_GET['order']) : 'asc';

	// 	$filterRules = isset($_GET['filterRules']) ? ($_GET['filterRules']) : '';
	// 	$cond = '';
	// 	$where="";
	// 	if($status=="m"){
	// 		$where .= " where status_key='9' ";
	// 	}else if($status=="pi"){
	// 		$where .= " where grp_pi=1 ";
	// 	}else{
	// 		$where .= " where status_key != '9' and status_key != '18' ";
	// 	}
	// 	if (!empty($filterRules)){
	// 		$cond = ' and  1=1 ';
	// 		$filterRules = json_decode($filterRules);


	// 		foreach($filterRules as $rule){
	// 			$rule = get_object_vars($rule);
	// 			$field = $rule['field'];
	// 			$op = $rule['op'];
	// 			$value = $rule['value'];

	// 			if (!empty($value)){
	// 				if($field=="umur"){
	// 					$field = " DATE_FORMAT(NOW(),'%Y') - DATE_FORMAT(dob,'%Y') ";
	// 					$op="equal";
	// 				}
	// 				if ($op == 'contains'){
	// 					$cond .= " and ($field like '%$value%')";
	// 				} else if ($op == 'equal'){
	// 					$cond .= " and $field = '$value'";
	// 				}else if($op == 'notequal'){
	// 					$cond .= " and $field != '' ";
	// 				}

	// 			}
	// 		}
	// 	}
	// 	$cond = $where.$cond;
	// 	$sql = $this->mjemaat->count($cond);
	// 	$total = $sql->num_rows();
	// 	$offset = ($page - 1) * $rows;
	// 	$data = $this->mjemaat->getM($cond,$sort,$order,$rows,$offset)->result();
	// 	$_SESSION['exceljemaat']= $order."|".$sort."|".$cond;
	// 	foreach($data as $row){
	// 		$relation='<a href="#" id="'.$row->relationno.'" title="View Relation" class="relation"><span class="ui-icon ui-icon-note"></span></a>';
	// 		if($row->photofile!=""){
	// 			$photofile="<img style='width:20px;height:16px;' src='".base_url()."uploads/small_".$row->photofile."' class='btnzoom' onclick='zoom(\"medium_".$row->photofile."\")'>";
	// 		}
	// 		else{
	// 			$data_photo="medium_nofoto.jpg";
	// 			$photofile="<img style='width:20px;' src='".base_url()."uploads/small_nofoto.jpg' class='btnzoom' onclick='zoom(\"".$data_photo."\")'>";
	// 		}
	// 		$row->photofile = $photofile;
	// 		$view='';
	// 		$edit='';
	// 		$del='';
	// 			$view = '<button id='.$row->member_key.' class="icon-view_detail" onclick="viewJemaat(\'view\',\''.$row->member_key.'\',\'formjemaat\')" style="width:16px;height:16px;border:0"></button> ';

	// 			$edit = '<button id='.$row->member_key.' class="icon-edit" onclick="save(\'edit\',\''.$row->member_key.'\',\'formjemaat\',null);" style="width:16px;height:16px;border:0"></button> ';

	// 			$del = '<button id='.$row->member_key.' class="icon-remove" onclick="del(\'del\','.$row->member_key.',\'formjemaat\');" style="width:16px;height:16px;border:0"></button>';

	// 		$rel="";
	// 	    $db1 = get_instance()->db->conn_id;



	// 		$member_key = $row->member_key;
	// 		$pembesukdari="";
	// 		$remark="";
	// 		$besukdate="";
	// 		$q = mysqli_query($db1,"SELECT * FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
	// 		if($dta = mysqli_fetch_array($q,MYSQLI_ASSOC)){
	// 			$pembesukdari=$dta['pembesukdari'];
	// 			$remark=$dta['remark'];
	// 			$besukdate=$dta['besukdate'];
	// 			$d=strtotime($besukdate);
	// 			$besukdate = date("Y-m-d", $d);
	// 		}

	// 		$row->blood_key = $row->blood_key=='' || $row->blood_key=="-" ?'-':getParameterKey($row->blood_key)->parameterid;
	// 		$row->gender_key = $row->gender_key=='' || $row->gender_key=="-" ?'-':getParameterKey($row->gender_key)->parametertext;
	// 		$row->status_key = $row->status_key=='' || $row->status_key=="-" ?'-':getParameterKey($row->status_key)->parametertext;
	// 		$row->kebaktian_key = $row->kebaktian_key==''  || $row->kebaktian_key=="-"  ?'-':getParameterKey($row->kebaktian_key)->parametertext;
	// 		$row->persekutuan_key  = $row->persekutuan_key=='' || $row->persekutuan_key=="-"?'-':getParameterKey($row->persekutuan_key)->parametertext;
	// 		$row->rayon_key = $row->rayon_key=='' || $row->rayon_key=="-"  ?'-':getParameterKey($row->rayon_key)->parametertext;
	// 		$row->pstatus_key =  $row->pstatus_key=='' || $row->pstatus_key=="-" ?'-':getParameterKey($row->pstatus_key)->parametertext;
	// 		// if($row->member_key==7)
	// 		// 	$row->phoneticname = $this->pinyin->pinyin($row->chinesename);

	// 		$jlhbesuk = $this->mjemaat->jlhbesuk($row->member_key);
	// 		$tglbesukterakhir = $this->mjemaat->tglbesukterakhir($row->member_key);

	// 		$row->dob=$row->dob!="00-00-0000"?$row->dob:'-';
	// 		$row->baptismdate=$row->baptismdate!="00-00-0000"?$row->baptismdate:'-';
	// 		$row->umur = $row->umur==Date("Y")?'-':$row->umur;
	// 		$row->relationno = $row->relationno==0?"-":$row->relationno;
	// 		$row->jlhbesuk = $jlhbesuk;
	// 		$row->tglbesukterakhir = $besukdate;
	// 		$row->pembesukdari = $pembesukdari;
	// 		$row->remark = $status;

	// 		$row->aksi =$view.$edit.$del;
	// 	}
	// 	$response = new stdClass;
	// 	$response->total=$total;
	// 	$response->rows = $data;
	// 	$_SESSION['excel']= "asc|member_key|";
	// 	echo json_encode($response);
	// }
	function grid3($status=''){

		@$page = $_POST['page'];
		@$limit = $_POST['rows'];
		@$sidx = $_POST['sidx'];
		@$sord = $_POST['sord'];
		if (!$sidx)
		    $sidx = 1;
		@$totalrows = isset($_POST['totalrows']) ? $_POST['totalrows'] : false;
		if (@$totalrows) {
		   @$limit = $totalrows;
		}

		@$filters = $_POST['filters'];
		@$search = $_POST['_search'];
			$where1="";
			$where2="";
			if($status=="m"){
				$where1 = " WHERE status_key='9' ";
			}
			else if($status=="pi"){
				$where1 = " WHERE grp_pi=1 ";
			}
			else{
				$where1 = " WHERE status_key!='9' and status_key!='18' ";
			}
       		if($search== "true") {
				$where2 = " AND (".$this->operation($filters).")";
		    }
		    $where = $where1." ".$where2;

		$sql = $this->mjemaat->count($where);
		$count = $sql->num_rows();
		if ($count > 0) {
		    @$total_pages = ceil($count / $limit);
		} else {
		    $total_pages = 0;
		}
		if ($page > $total_pages)
		    @$page = $total_pages;
		if ($limit < 0)
		    @$limit = 0;
			$start = $limit * $page - $limit;
		if ($start < 0)
		    @$start = 0;
		$data = $this->mjemaat->getM($where, $sidx, $sord, $limit, $start);
		$_SESSION['exceljemaat']= $sord."|".$sidx."|".$where;
		@$responce->page = $page;
		@$responce->total = $total_pages;
		@$responce->records = $count;
		$i=0;

		foreach($data->result() as $row){

			if($row->photofile!=""){
				$photofile="<img style='margin:0 17px;' src='".base_url()."uploads/small_".$row->photofile."' id='btnzoom' fimage='".$row->photofile."' class='dg-picture-zoom'>";
			}
			else{
				$photofile="<img style='margin:0 17px;' src='".base_url()."uploads/small_nofoto.jpg' id='btnzoom' fimage='nofoto.jpg' class='dg-picture-zoom'>";
			}
			if(hasPermission('jemaat','view')){
				$view='<a href="#" id='.$row->member_key.' title="View" class="btnview" style="float:left"><span class="ui-icon ui-icon-document"></span></a>';
			}
			else{
				$view='<span style="float:left" class="ui-state-disabled ui-icon ui-icon-document"></span>';
			}
			if(hasPermission('jemaat','edit')){
				$edit='<a href="#" id='.$row->member_key.' title="Edit" class="btnedit" style="float:left"><span class="ui-icon ui-icon-pencil"></span></a>';
			}
			else{
				$edit='<span style="float:left" class="ui-state-disabled ui-icon ui-icon-pencil"></span>';
			}
			if(hasPermission('jemaat','delete')){
				$del='<a href="#" id='.$row->member_key.' title="Del" class="btndel" style="float:left"><span class="ui-icon ui-icon-trash"></span></a>';
			}
			else{
				$del='<spans style="float:left" class="ui-state-disabled ui-icon ui-icon-trash"></span>';
			}
			$rel="";
		    $db1 = get_instance()->db->conn_id;


			$member_key = $row->member_key;
			$pembesukdari="";
			$remark="";
			$besukdate="";
			$q = mysqli_query($db1,"SELECT * FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
			if($dta = mysqli_fetch_array($q,MYSQLI_ASSOC)){
				//$dta = "checked";
				$pembesukdari=$dta['pembesukdari'];
				$remark=$dta['remark'];
				$besukdate=$dta['besukdate'];
				$d=strtotime($besukdate);
				$besukdate = date("Y-m-d", $d);
			}

			$jlhbesuk = $this->mjemaat->jlhbesuk($row->member_key);
			$tglbesukterakhir = $this->mjemaat->tglbesukterakhir($row->member_key);
			$select="<spans style='float:left;margin-top:3px;margin-left:4px;'><input style='width:11px' $rel type='checkbox' name='selectboxid[]' id='selectboxid' value='".$row->member_key."'></span>";
			$responce->rows[$i]['id']   = $row->member_key;
			$responce->rows[$i]['cell'] = array(
				$member_key,
				$view.$edit.$del.$select,
				$photofile,
				$row->status_key,
				$row->grp_pi,
				$row->relationno,
				$row->memberno,
				$row->membername,
				$row->chinesename,
				$row->phoneticname,
				$row->tel_h,
				$row->tel_o,
				$row->handphone,
				$row->address,
				$row->add2,
				$row->city,
				$row->gender_key,
				$row->pstatus_key,
				$row->pob,
				$row->dob,
				$row->umur,
				$row->blood_key,
				$row->kebaktian_key,
				$row->persekutuan_key,
				$row->rayon_key,
				$row->serving,
				$row->fax,
				$row->email,
				$row->website,
				$row->baptismdocno,
				$row->baptis,
				$row->baptismdate,
				$row->remark,
				$row->relation,
				$row->oldgrp,
				$row->kebaktian,
				$jlhbesuk,
				$besukdate,
				$pembesukdari,
				$remark,
				$row->modifiedby,
				$row->modifiedon
				);
			$i++;
		}
		echo json_encode($responce);
	}
	function operation($filters){
        $filters = str_replace('\"','"' ,$filters);
        $filters = str_replace('"[','[' ,$filters);
        $filters = str_replace(']"',']' ,$filters);
		$filters = json_decode($filters);
		$where = " ";
		$whereArray = array();
		$rules = $filters->rules;
		$groupOperation = $filters->groupOp;
		foreach($rules as $rule) {
		    $fieldName = $rule->field;
		    $fieldData = escapeString($rule->data);
			   	switch ($rule->op) {
					case "eq": $fieldOperation = " = '".$fieldData."'"; break;
					case "ne": $fieldOperation = " != '".$fieldData."'"; break;
					case "lt": $fieldOperation = " < '".$fieldData."'"; break;
					case "gt": $fieldOperation = " > '".$fieldData."'"; break;
					case "le": $fieldOperation = " <= '".$fieldData."'"; break;
					case "ge": $fieldOperation = " >= '".$fieldData."'"; break;
					case "nu": $fieldOperation = " = ''"; break;
					case "nn": $fieldOperation = " != ''"; break;
					case "in": $fieldOperation = " IN (".$fieldData.")"; break;
					case "ni": $fieldOperation = " NOT IN '".$fieldData."'"; break;
					case "bw": $fieldOperation = " LIKE '".$fieldData."%'"; break;
					case "bn": $fieldOperation = " NOT LIKE '".$fieldData."%'"; break;
					case "ew": $fieldOperation = " LIKE '%".$fieldData."'"; break;
					case "en": $fieldOperation = " NOT LIKE '%".$fieldData."'"; break;
					case "cn": $fieldOperation = " LIKE '%".$fieldData."%'"; break;
					case "nc": $fieldOperation = " NOT LIKE '%".$fieldData."%'"; break;
					default: $fieldOperation = ""; break;
		        }
		    if($fieldOperation != "") {
		    	if($fieldName=="dob"){
                	$whereArray[] = "DATE_FORMAT(dob,'%d-%m-%Y')".$fieldOperation;
                }
                else if($fieldName=="baptismdate"){
                	$whereArray[] = "DATE_FORMAT(baptismdate,'%d-%m-%Y')".$fieldOperation;
                }
                else if($fieldName=="tglbesuk"){
                	$whereArray[] = "DATE_FORMAT(tglbesuk,'%d-%m-%Y')".$fieldOperation;
                }
                else if($fieldName=="modifiedon"){
                	$whereArray[] = "DATE_FORMAT(modifiedon,'%d-%m-%Y %T')".$fieldOperation;
                }
                else if($fieldName=="umur"){
                	$whereArray[] = "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y')".$fieldOperation;
                }
                else if($fieldName=="tglbesukterakhir"){
                	$whereArray[] = "DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y')".$fieldOperation;
                }
                else if($fieldName=="photofile"){
                	if($fieldData=="ada"){
                		$whereArray[] = "photofile !='' ";
                	}
                	else{
                		$whereArray[] = "photofile ='' ";
                	}
                }
                else{
                	$whereArray[] = $fieldName.$fieldOperation;
                }
		    }
		}

		if (count($whereArray)>0) {
		    $where .= join(" ".$groupOperation." ", $whereArray);
		} else {
			$where = " ";
		}
		return $where;
	}
	function gridBesuk(){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
		$sort = isset($_GET['sort']) ? strval($_GET['sort']) : 'member_key';
		$order = isset($_GET['order']) ? strval($_GET['order']) : 'asc';

		$filterRules = isset($_GET['filterRules']) ? ($_GET['filterRules']) : '';
		$cond = '';
		$where="";
		$where .= " where status_key !='9' ";
		if (!empty($filterRules)){
			$cond = ' and 1=1 ';
			$filterRules = json_decode($filterRules);

			foreach($filterRules as $rule){
				$rule = get_object_vars($rule);
				$field = $rule['field'];
				$op = $rule['op'];
				$value = $rule['value'];

				if (!empty($value)){
					if($field=="umur"){
						$field = " DATE_FORMAT(NOW(),'%Y') - DATE_FORMAT(dob,'%Y') ";
						$op="equal";
					}
					if ($op == 'contains'){
						$cond .= " and ($field like '%$value%')";
					} else if ($op == 'equal'){
						$cond .= " and $field = '$value'";
					}else if($op == 'notequal'){
						$cond .= " and $field != '' ";
					}

				}
			}
		}
		$cond = $where.$cond;
		$sql = $this->mjemaat->count($cond);
		$total = $sql->num_rows();
		$offset = ($page - 1) * $rows;
		$data = $this->mjemaat->getM($cond,$sort,$order,$rows,$offset)->result();
		$_SESSION['exceljemaat']= $order."|".$sort."|".$cond;
		foreach($data as $row){
						if($row->photofile!=""){
				$photofile="<img style='margin:0 17px;width:20px;' src='".base_url()."uploads/small_".$row->photofile."' class='btnzoom' onclick='zoom(\"medium_".$row->photofile."\")'>";
			}
			else{
				$data_photo="medium_nofoto.jpg";
				$photofile="<img style='margin:0 17px;width:20px;' src='".base_url()."uploads/small_nofoto.jpg' class='btnzoom' onclick='zoom(\"".$data_photo."\")'>";
			}
			$row->photofile = $photofile;

			$rel="";
		    $db1 = get_instance()->db->conn_id;



			$member_key = $row->member_key;
			$pembesukdari="";
			$remark="";
			$besukdate="";
			$q = mysqli_query($db1,"SELECT * FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
			if($dta = mysqli_fetch_array($q,MYSQLI_ASSOC)){
				//$dta = "checked";
				$pembesukdari=$dta['pembesukdari'];
				$remark=$dta['remark'];
				$besukdate=$dta['besukdate'];
				$d=strtotime($besukdate);
				$besukdate = date("Y-m-d", $d);
			}

			$row->blood_key = $row->blood_key=='' || $row->blood_key=="-" ?'-':getParameterKey($row->blood_key)->parametertext;
			$row->gender_key = $row->gender_key=='' || $row->gender_key=="-" ?'-':getParameterKey($row->gender_key)->parametertext;
			$row->status_key = $row->status_key=='' || $row->status_key=="-" ?'-':getParameterKey($row->status_key)->parametertext;
			$row->kebaktian_key = $row->kebaktian_key==''  || $row->kebaktian_key=="-"  ?'-':getParameterKey($row->kebaktian_key)->parametertext;
			$row->persekutuan_key  = $row->persekutuan_key=='' || $row->persekutuan_key=="-"?'-':getParameterKey($row->persekutuan_key)->parametertext;
			$row->rayon_key = $row->rayon_key=='' || $row->rayon_key=="-"  ?'-':getParameterKey($row->rayon_key)->parametertext;
			$row->pstatus_key =  $row->pstatus_key=='' || $row->pstatus_key=="-" ?'-':getParameterKey($row->pstatus_key)->parametertext;


			$jlhbesuk = $this->mjemaat->jlhbesuk($row->member_key);
			$tglbesukterakhir = $this->mjemaat->tglbesukterakhir($row->member_key);

			$row->dob=$row->dob!="00-00-0000"?$row->dob:'-';
			$row->baptismdate=$row->baptismdate!="00-00-0000"?$row->baptismdate:'-';
			$row->umur = $row->umur==Date("Y")?'-':$row->umur;
			$row->relationno = $row->relationno==0?"-":$row->relationno;


			$row->jlhbesuk = $jlhbesuk;
			$row->tglbesukterakhir = $besukdate;
			$row->pembesukdari = $pembesukdari;
			$row->remark = $remark;
		}
		// $total = count($data);
		$response = new stdClass;
		$response->total=$total;
		$response->rows = $data;
		$_SESSION['excel']= "asc|member_key|";
		echo json_encode($response);
	}
	function grid2(){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
		$sort = isset($_GET['sort']) ? strval($_GET['sort']) : 'recno';
		$order = isset($_GET['order']) ? strval($_GET['order']) : 'asc';
		$where='';
		$sql = $this->mjemaat->count($where);
		$total = $sql->num_rows();
		$data = $this->mjemaat->getJ('',$sort,$order,$rows,$page)->result();

		$response = new stdClass;
		$response->total=$total;
		$response->rows = $data;
		$_SESSION['excel']= "asc|recno|";
		echo json_encode($response);
	}

	function image($image){
		$data["image"] = $image;
		$this->load->view('jemaat/image',$data);
	}
	function form($form,$member_key,$formname){
		$data['grp_pi'] = $this->uri->segment(6);
		$data['sqlgender'] = getParameter('GENDER');
		$data['sqlpstatus'] = getParameter('PSTATUS');
		$data['sqlblood'] =getParameter('BLOOD');
		$data['sqlkebaktian'] = getParameter('KEBAKTIAN');
		$data['sqlpersekutuan'] = getParameter('PERSEKUTUAN');
		$data['sqlrayon'] =getParameter('RAYON');
		$data['sqlserving'] =getParameter('SERVING');
		$data['sqlstatusid'] =getParameter('STATUS');
		$data['formname'] = $formname;
		if($member_key!=null || $member_key!=""){
			$sql= $this->mjemaat->getwhere($member_key);
			$count = $sql->num_rows();
			$data["member_key"] = $member_key;
		}
		$this->load->view('jemaat/'.$form,$data);
	}
	function makeRelation(){
		$json = $_POST['dataMember'];
		$rel = $_POST['dataRel'];
		$data = json_decode($json);
		$checkRel = $this->db->query("select * from tblmember where relationno=".$rel)->result();
		$lastNumber = $rel;
		if(count($checkRel)==0){
			$lastNum = $this->db->query("select relationno from tblmember order by relationno desc")->result();
			$lastNumber= count($lastNum)>0?$lastNum[0]->relationno+1:1;
		}
		$gagal=0;
		foreach($data as $d){
			$sql="update tblmember set relationno = ".$lastNumber." where member_key= ".$d->member_key;
			$check = $this->db->query($sql);
			if(!$check){
				$gagal=1;
			}
		}
		$hasil = array(
			'status' => $gagal==0?"Sukses":"Gagal"
		);
		return json_encode($hasil);
	}
	function crud(){
		@$oper=@$_POST['oper'];
	    @$member_key=@$_POST['member_key'];
	    @$extphotofile=@$_POST['extphotofile'];
	    @$editphotofile=@$_POST['editphotofile'];
	    if($extphotofile!=""){
	    	if($editphotofile!=""){
	    		if (file_exists("uploads/medium_".$editphotofile)) {
					unlink("uploads/medium_".$editphotofile);
				}
				if (file_exists("uploads/small_".$editphotofile)) {
					unlink("uploads/small_".$editphotofile);
				}
				@$namephotofile = date("d-m-Y-h").substr(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), 0, 10) . substr(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), 0, 10);
	    		@$photofile = @$namephotofile.".".@$extphotofile;
		    }
	    	else{
				@$namephotofile = date("d-m-Y-h").substr(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), 0, 10) . substr(str_shuffle("abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz"), 0, 10);
	    		@$photofile = @$namephotofile.".".@$extphotofile;
	    	}
	    }
	    else{
	    	if($editphotofile!=""){
	    		if($editphotofile=="clearfoto"){
	    			@$photofile = "";
	    		}
	    		else{
	    			@$photofile = $editphotofile;
		    	}
	    	}
	    	else{
	    		@$photofile = "";
	    	}
	    }
		$servingid="";
		if(!empty($_POST['servingid'])){
		    foreach ($_POST['servingid'] as $selectedOption){
	    		$servingid=$servingid.$selectedOption."/";
	    	}
	    }
		$_POST = array_map("strtoupper", $_POST);
	    @$dob = $_POST['dob'];
	    @$exp1 = explode('-',$dob);
		@$dob = $exp1[2]."-".$exp1[1]."-".$exp1[0];

		@$baptismdate = $_POST['baptismdate'];
		@$exp2 = explode('-',$baptismdate);
		@$baptismdate = $exp2[2]."-".$exp2[1]."-".$exp2[0];

		@$tglbesuk = $_POST['tglbesuk'];
		@$exp3 = explode('-',$tglbesuk);
		@$tglbesuk = $exp3[2]."-".$exp3[1]."-".$exp3[0];
		@$data = array(
			'grp_pi' => isset($_POST['grp_pi']) ? $_POST['grp_pi'] : 0,
			'relationno' => @$_POST['relationno'],
			'memberno' => @$_POST['memberno'],
			'membername' => @$_POST['membername'],
			'chinesename' => @$_POST['chinesename'],
			'phoneticname' => @$_POST['phoneticname'],
			'aliasname' => @$_POST['aliasname'],
			'tel_h' => @$_POST['tel_h'],
			'tel_o' => @$_POST['tel_o'],
			'handphone' => @$_POST['handphone'],
			'address' => @$_POST['address'],
			'add2' => @$_POST['add2'],
			'city' => @$_POST['city'],
			'gender_key' => @$_POST['genderid'],
			'pstatus_key' => @$_POST['pstatusid'],
			'pob' => @$_POST['pob'],
			'dob' => @$dob,
			'blood_key' => @$_POST['bloodid'],
			'kebaktian_key' => @$_POST['kebaktianid'],
			'persekutuan_key' => @$_POST['persekutuanid'],
			'rayon_key' => @$_POST['rayonid'],
			'status_key' => @$_POST['statusid'],
			'serving' => $servingid,
			'fax' => @$_POST['fax'],
			'email' => @$_POST['email'],
			'website' => @$_POST['website'],
			'baptismdocno' => @$_POST['baptismdocno'],
			'baptis' => isset($_POST['baptis']) ? $_POST['baptis'] : 0,
			'baptismdate' => @$baptismdate,
			'remark' => @$_POST['remark'],
			'relation' => @$_POST['relation'],
			'oldgrp' => @$_POST['oldgrp'],
			'kebaktian' => @$_POST['kebaktian'],
			'tglbesuk' => @$tglbesuk,
			'teambesuk' => @$_POST['teambesuk'],
			'description' => @$_POST['description'],
			'photofile' => @$photofile,
			'modifiedby' => $_SESSION['username'],
			'modifiedon' => date("Y-m-d H:i:s")
			);
	    switch ($oper) {
	        case 'add':
				$this->mjemaat->add("tblmember",$data);
				$hasil = array(
			        'status' => 'sukses',
			        'photofile' => $photofile
			    );
			    echo json_encode($hasil);
	            break;
	        case 'edit':
				$this->mjemaat->edit("tblmember",$data,$member_key);
				$hasil = array(
			        'status' => 'sukses',
			        'photofile' => $photofile
			    );
			    echo json_encode($hasil);
	            break;
	         case 'del':
         		if (file_exists("uploads/medium_".$editphotofile)) {
					unlink("uploads/medium_".$editphotofile);
				}
				if (file_exists("uploads/small_".$editphotofile)) {
					unlink("uploads/small_".$editphotofile);
				}
				$this->mjemaat->del("tblmember",$member_key);
				$hasil = array(
			        'status' => 'sukses',
			        'photofile' => $editphotofile
			    );
			    echo json_encode($hasil);
	            break;
	        default :
	        	$hasil = array(
			        'status' => 'No Operation'.implode("", $_POST)
			    );
			    echo json_encode($hasil);
	           break;
		}
	}

	function upload($namephotofile){
	    $filename = $_FILES['photofile']['name'];
	    if($filename){
	    	$temp = $_FILES['photofile']['tmp_name'];
		    $type = $_FILES['photofile']['type'];
		    $size = $_FILES['photofile']['size'];
		    $newfilename = $namephotofile;
			@$vdir_upload = "uploads/";
			@$directory 	= "uploads/$newfilename";
		    if (MOVE_UPLOADED_FILE($temp,$directory)){
		    	$im_src = imagecreatefromjpeg($directory);
				$src_width = imagesx($im_src);
				$src_height = imagesy($im_src);
				$dst_width = 30;
				$dst_height = ($dst_width/$src_width)*$src_height;
				$im = imagecreatetruecolor($dst_width,$dst_height);
				imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
				imagejpeg($im,$vdir_upload."small_".$newfilename);
				imagedestroy($im_src);
				imagedestroy($im);

				$im_src2 = imagecreatefromjpeg($directory);
				$src_width2 = imagesx($im_src2);
				$src_height2 = imagesy($im_src2);
				$dst_width2 = 500;
				$dst_height2 = ($dst_width2/$src_width2)*$src_height2;
				$im2 = imagecreatetruecolor($dst_width2,$dst_height2);
				imagecopyresampled($im2, $im_src2, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width2, $src_height2);
				imagejpeg($im2,$vdir_upload."medium_".$newfilename);
				imagedestroy($im_src2);
				imagedestroy($im2);
				unlink("uploads/$newfilename");
		        $status = 1;
		    	$msg ="Upload Success".$dst_height2;
		    }
		    else{
		        $status = 2;
		    	$msg ="Upload Error";
		 	}
		}
		else{
			$status = 2;
		    $msg ="Upload Null";
		}

	 	$hasil = array(
	        'status' => $status,
	        'msg' => $msg
	    );
	    echo json_encode($hasil);
	}
	function uploadWA($namephotofile){
	    $filename = $_FILES['photofile']['name'];
	    if($filename){
	    	$temp = $_FILES['photofile']['tmp_name'];
		    $type = $_FILES['photofile']['type'];
		    $size = $_FILES['photofile']['size'];
		    $newfilename = $namephotofile;
			@$vdir_upload = "uploads/";
			@$directory 	= "uploads/$newfilename";
		    if (MOVE_UPLOADED_FILE($temp,$directory)){
		    	$im_src = imagecreatefromjpeg($directory);
				$src_width = imagesx($im_src);
				$src_height = imagesy($im_src);
				$dst_width = 30;
				$dst_height = ($dst_width/$src_width)*$src_height;
				$im = imagecreatetruecolor($dst_width,$dst_height);
				imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
				imagejpeg($im,$vdir_upload."small_".$newfilename);
				imagedestroy($im_src);
				imagedestroy($im);

				$im_src2 = imagecreatefromjpeg($directory);
				$src_width2 = imagesx($im_src2);
				$src_height2 = imagesy($im_src2);
				// start
				$actualHeight  =  imagesy($im_src2);
				$actualWidth   = imagesx($im_src2);
				$maxHeight = 1280;
				$maxWidth = 1280;
				$imgRatio = $actualWidth / $actualHeight;
				$maxRatio = $maxWidth/$maxHeight;
				if($actualHeight>$maxHeight || $actualWidth > $maxWidth){
					if($imgRatio < $maxRatio){
						//menyesuaikan lebar menurut maxHeight
						$imgRatio = $maxHeight / $actualHeight;
						$actualWidth = $imgRatio * $actualWidth;
						$actualHeight = $maxHeight;
					}else if($imgRatio > $maxRatio){
						//menyesuaikan tinggi menurut maxWidth
						$imgRatio = $maxWidth / $actualWidth;
						$actualHeight = $imgRatio * $actualHeight;
						$actualWidth = $maxWidth;
					}else{
						$actualHeight = $maxHeight;
						$actualWidth = $maxWidth;
					}
				}
				//end
				$im2 = imagecreatetruecolor($actualWidth,$actualHeight);
				imagecopyresampled($im2, $im_src2, 0, 0, 0, 0, $actualWidth, $actualHeight, $src_width2, $src_height2);
				imagejpeg($im2,$vdir_upload."medium_".$newfilename);
				imagedestroy($im_src2);
				imagedestroy($im2);
				unlink("uploads/$newfilename");
		        $status = 1;
		    	$msg ="Upload Success";
		    }
		    else{
		        $status = 2;
		    	$msg ="Upload Error";
		 	}
		}
		else{
			$status = 2;
		    $msg ="Upload Null";
		}

	 	$hasil = array(
	        'status' => $status,
	        'msg' => $msg
	    );
	    echo json_encode($hasil);
	}

	function export($file){
		$excel = $_SESSION['exceljemaat'];
		$splitexcel = explode("|",$excel);
		$sord = $splitexcel[0];
		$sidx= $splitexcel[1];
		$where = $splitexcel[2];
		$data['sql']=$this->db->query("SELECT *,
		DATE_FORMAT(dob,'%d-%m-%Y') dob,
		DATE_FORMAT(tglbesuk,'%d-%m-%Y') tglbesuk,
		DATE_FORMAT(baptismdate,'%d-%m-%Y') baptismdate,
		DATE_FORMAT(modifiedon,'%d-%m-%Y') modifiedon,
		DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y') as umur
		FROM tblmember " . $where . " ORDER BY $sidx $sord");
		$this->load->view('jemaat/'.$file,$data);
	}

	function report(){
		$excel = $_SESSION['exceljemaat'];
		$splitexcel = explode("|",$excel);
		$sord = $splitexcel[0];
		$sidx= $splitexcel[1];
		$where = $splitexcel[2];
		$data['sql']=$this->db->query("SELECT *,
		DATE_FORMAT(dob,'%d-%m-%Y') dob,
		DATE_FORMAT(tglbesuk,'%d-%m-%Y') tglbesuk,
		DATE_FORMAT(baptismdate,'%d-%m-%Y') baptismdate,
		DATE_FORMAT(modifiedon,'%d-%m-%Y') modifiedon,
		DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y') as umur
		FROM tblmember " . $where . " ORDER BY $sidx $sord");
		$this->load->view('jemaat/report',$data);

	}
	function konversiRelation(){
		$data = $this->db->query("select relationno from tblmember2 where relationno!='' group by relationno");
		$no=1;
		foreach($data->result() as $d){

			$members = $this->db->query("select * from tblmember2 where relationno='".$d->relationno."'")->result();
			foreach($members as $member){
				$id = $member->member_key;
				$sql="update tblmember2 set relationno='".$no."' where member_key = ".$id;
				$check = $this->db->query($sql);
				if($check){
					echo "berhasil";
				}else{
					echo "gagal";
				}
			}
			echo "<br>";
			echo $no."=".$d->relationno."=".count($members)."<br>";
			$no++;
		}
	}
	public function konversi(){
		$data = $this->db->query("SELECT member_key,TRIM(serving) AS serving FROM tblmember WHERE serving!=''")->result();
		// $total=0;
		// $totalInsert = 0;
		// $totalParam=0;
		foreach($data as $row){
			$pecah = explode("/",$row->serving);
			array_pop($pecah);
			// $total+=count($pecah);
			foreach($pecah as $p){
				$check = $this->mblood->getListAll('tblparameter',['parametergrpid'=>'SERVING','parameterid'=>$p]);
				if(count($check)==0){
					$insert= $this->db->query("INSERT INTO tblparameter values (NULL,'SERVING','".$p."','".$p."','','".$_SESSION['username']."',NOW())");
					$parkey=$this->db->insert_id();
					// if($insert){
					// 	$totalParam+=1;
					// }
					$sql="insert into tblprofile values (NULL,'".$row->member_key."','".$parkey."',NOW(),'',NOW(),'".$_SESSION['username']."')";
					$insert = $this->db->query($sql);
					// if($insert){
					// 	$totalInsert+=1;
					// }
				}else{
					$parkey = !empty($check)?$check[0]->parameter_key:0;
					$sql="insert into tblprofile values (NULL,'".$row->member_key."','".$parkey."',NOW(),'',NOW(),'".$_SESSION['username']."')";
					$insert = $this->db->query($sql);
					// if($insert){
					// 	$totalInsert+=1;
					// }
				}
			}
		}
		// echo "Total Data Serving = ".$total."<br>Total Data Insert Activity = ".$totalInsert."<br>Total Data Parameter = ".$totalParam;
	}
	public function konversiParameter($param,$field_awal){
		$data = $this->db->query("SELECT member_key,TRIM($field_awal) AS field FROM tblmemberlama WHERE $field_awal!='' and $field_awal!='-'")->result();
		foreach($data as $row){
			$check = $this->mblood->getListAll('tblparameter',['parametergrpid'=>$param,'parameterid'=>$row->field]);
			if(count($check)==0){
				$insert= $this->db->query("INSERT INTO tblparameter values (NULL,'".$param."','".$row->field."','".$row->field."','','".$_SESSION['username']."',NOW())");
				$parkey=$this->db->insert_id();
				$sql="update tblmemberlama set $field_awal='$parkey' where member_key = ".$row->member_key;
				// $insert = $this->db->query($sql);
				echo $sql."=1<br>";
			}else{
				$parkey = !empty($check)?$check[0]->parameter_key:0;
				$sql="update tblmemberlama set $field_awal='$parkey' where member_key = ".$row->member_key;
				// $insert = $this->db->query($sql);
				echo $sql."=2<br>";
			}
		}
	}
}






