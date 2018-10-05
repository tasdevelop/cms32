<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Besuk extends MY_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->model([
			'mbesuk',
			'mgender',
			'mpstatus',
			'mblood',
			'mkebaktian',
			'mpersekutuan',
			'mrayon',
			'mjemaat',
			'mparameter',
			'mserving',
			'mmenu'
		]);
	}
	public function set(){
		$_SESSION['member_key'] = $_GET['member_key'];
	}
	/**
     * Fungsi awal besuk
     * @AclName Awal besuk
     */
	public function index(){
		$link = base_url()."besuk/gridbesuk";
		$this->render('besuk/gridbesuk',['link'=>$link]);
	}
	public function jemaat(){
		if(empty($_SESSION['member_key'])){
			echo" Empty";
		}
		else{
			$data['member_key'] = $_SESSION['member_key'];
			$data['sql'] = $this->mbesuk->getwhere($_SESSION['member_key']);


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
			$this->load->view('jemaat/gridbesuk',$data);
		}
	}

	/**
     * Fungsi grid besuk di jemaat
     * @AclName grid besuk di jemaat
     */
	public function gridBesukJemaat($member_key){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
		$sort = isset($_GET['sort']) ? strval($_GET['sort']) : 'member_key';
		$order = isset($_GET['order']) ? strval($_GET['order']) : 'asc';

		$filterRules = isset($_GET['filterRules']) ? ($_GET['filterRules']) : '';
		$cond = '';
		if (!empty($filterRules)){
			$cond = ' where member_key = "'.$member_key.'" and  1=1 ';
			$filterRules = json_decode($filterRules);

			foreach($filterRules as $rule){
				$rule = get_object_vars($rule);
				$field = $rule['field'];
				$op = $rule['op'];
				$value = $rule['value'];
				if (!empty($value)){
					if ($op == 'contains'){
						$cond .= " and ($field like '%$value%')";
					} else if ($op == 'greater'){
						$cond .= " and $field>$value";
					}
				}
			}
		}else{
			$cond = ' where member_key = "'.$member_key.'" ';
		}
		$where='';
		$sql = $this->mbesuk->count($cond);
		$total = $sql->num_rows();
		$offset = ($page - 1) * $rows;
		$data = $this->mbesuk->get($cond,$sort,$order,$rows,$offset)->result();
		foreach($data as $row){
			$view = '<button id='.$row->member_key.' class="icon-view_detail" onclick="viewData(\''.$row->besukid.'\')" style="width:16px;height:16px;border:0"></button> ';
			$edit = '<button id='.$row->member_key.' class="icon-edit" onclick="editData(\''.$row->besukid.'\');" style="width:16px;height:16px;border:0"></button> ';
			$del = '<button id='.$row->member_key.' class="icon-remove" onclick="deleteData(\''.$row->besukid.'\');" style="width:16px;height:16px;border:0"></button>';
			$row->aksi =$view.$edit.$del;
			$row->besukdate=$row->besukdate=="00-00-0000"?"-":$row->besukdate;
		}
		$response = new stdClass;
		$response->total=$total;
		$response->rows = $data;
		$_SESSION['excelbesuk']= "asc|member_key|".$cond;
		echo json_encode($response);
	}
	/**
     * Fungsi grid besuk
     * @AclName grid besuk
     */
	function grid($member_key){
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
			$where = " where member_key='".$member_key."'";
       		if (isset($filters)) {
				$where= $this->operation($filters,$member_key);
		    }
		$sql = $this->mbesuk->count($where);
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
		$data = $this->mbesuk->get($where, $sidx, $sord, $limit, $start);
		$_SESSION['excelbesuk']= $sord."|".$sidx."|".$where;
		@$responce->page = $page;
		@$responce->total = $total_pages;
		@$responce->records = $count;
		$i=0;
		foreach($data->result() as $row){
			if(hasPermission('besuk','view')){
				$view='<a href="#" member_key='.$row->member_key.' besukid='.$row->besukid.' title="view" class="btnviewbesuk" style="float:left"><span class="ui-icon ui-icon-document"></span></a>';
			}
			else{
				$view='<span style="float:left" class="ui-state-disabled ui-icon ui-icon-document"></span>';
			}
			if(hasPermission('besuk','edit')){
				$edit='<a href="#" member_key='.$row->member_key.' besukid='.$row->besukid.' title="Edit" class="btneditbesuk" style="float:left"><span class="ui-icon ui-icon-pencil"></span></a>';
			}
			else{
				$edit='<span style="float:left" class="ui-state-disabled ui-icon ui-icon-pencil"></span>';
			}
			if(hasPermission('besuk','delete')){
				$del='<a href="#" member_key='.$row->member_key.' besukid='.$row->besukid.' title="Del" class="btndelbesuk" style="float:left"><span class="ui-icon ui-icon-trash"></span></a>';
			}
			else{
				$del='<span class="ui-state-disabled ui-icon ui-icon-trash"></span>';
			}
			$responce->rows[$i]['id']   = $row->besukid;
			$responce->rows[$i]['cell'] = array(
				$row->besukid,
				$view.$edit.$del,
				$row->member_key,
				$row->besukdate,
				$row->pembesuk,
				$row->pembesukdari,
				$row->remark,
				$row->besuklanjutan,
				$row->modifiedby,
				$row->modifiedon,
				);
			$i++;
		}
		echo json_encode($responce);
	}
	/**
     * Fungsi add besuk
     * @AclName Tambah besuk
     */
	public function add($member_key=null){
		$data=[];
		if($this->input->server('REQUEST_METHOD') == 'POST' ){
			$data = $this->input->post();
			$cek = $this->_save($data);
			$status = $cek?"sukses":"gagal";
			$hasil = array(
		        'status' => $status
		    );
		    echo json_encode($hasil);
		}else{
			$data = $this->input->post();
		}
		$check=$member_key==null?0:$member_key;
		$this->load->view('besuk/add',['data'=>$data,'check'=>$check]);
	}
	private function operation($filters,$recno){
		$filters = json_decode($filters);
		$where = " where member_key='".$member_key."'";
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
		    	if($fieldName=="besukdate"){
                	$whereArray[] = "DATE_FORMAT(besukdate,'%d-%m-%Y')".$fieldOperation;
                }
                else if($fieldName=="modifiedon"){
                	$whereArray[] = "DATE_FORMAT(modifiedon,'%d-%m-%Y %T')".$fieldOperation;
                }
                else{
                	$whereArray[] = $fieldName.$fieldOperation;
                }
		    }
		}
	}

	/**
     * Fungsi edit besuk
     * @AclName Edit besuk
     */
	public function edit($id,$member_key=null){
		$data = $this->mbesuk->getById('tblbesuk','besukid',$id);
        if(empty($data)){
            redirect('besuk');
        }
		if($this->input->server('REQUEST_METHOD') == 'POST' ){
			$data = $this->input->post();
			$data['besukid'] = $this->input->post('besukid');
			$cek = $this->_save($data);
			$status = $cek?"sukses":"gagal";
			$hasil = array(
		        'status' => $status
		    );
		    echo json_encode($hasil);
		}
		$check=$member_key==null?0:$member_key;
		$this->load->view('besuk/edit',['data'=>$data,'check'=>$check]);
	}
	/**
     * Fungsi delete besuk
     * @AclName Delete besuk
     */
	public function delete($id,$member_key=null){
		$data = $this->mbesuk->getById('tblbesuk','besukid',$id);
		if(empty($data)){
			redirect('besuk');
		}
		if($this->input->server('REQUEST_METHOD') == 'POST'){
			$cek = $this->mbesuk->delete($this->input->post('besukid'));
			$status = $cek?"sukses":"gagal";
			$hasil = array(
		        'status' => $status
		    );
		    echo json_encode($hasil);
		}
		$check=$member_key==null?0:$member_key;
		$this->load->view('besuk/delete',['data'=>$data,'check'=>$check]);
	}
	private function _save($data){
		$data = array_map("strtoupper", $data);
        $this->mbesuk->save($data);
    }
	/**
     * Fungsi view besuk
     * @AclName View besuk
     */
	public function view($id,$member_key=null){
		$data = $this->mbesuk->getById('tblbesuk','besukid',$id);
        if(empty($data)){
            redirect('besuk');
        }
        $check=$member_key==null?0:$member_key;
		$this->load->view('besuk/view',['data'=>$data,'check'=>$check]);
	}

	/**
     * Fungsi export excel
     * @AclName Export excel
     */
	public function excel(){
		excel('excelbesuk','tblbesuk','besuk/excel');
	}
}