<?php
class Macos extends MY_Model{
    protected $table = 'tblacos';
    protected $alias = 'tblacos';
    function count($where){
        $sql = $this->db->query("SELECT * FROM tblacos " . $where);
        return $sql;
    }
    function get($where, $sidx, $sord, $limit, $start){
        $query = "select * from tblacos " . $where." ORDER BY $sidx $sord LIMIT $start , $limit";
        return $this->db->query($query);
    }
    public function getList($conditions=[],$count=false,$limit=0,$offset=0){
        $table =$this->table;
        $alias = $this->alias;
        $this->db->from($table.' as '.$alias);
        $select = "";
        if(!empty($conditions)){
            $this->db->where($conditions);
        }
        if(!empty($limit)){
            $this->db->limit($limit,$offet);
        }
        if($count===true){
            return $this->db->get()->num_rows();
        }else{
            $this->db->order_by('class asc');
            return $this->db->get()->result();
        }
    }
    public function getGroup(){
        $table =$this->table;
        $this->db->from($table);
        $this->db->group_by('class');
        return $this->db->get()->result();
    }
    public function getByMultiId($ids){
        if(!empty($ids)){
            $acos = $this->db->where_in('acosid',$ids)
                    ->from($this->table)
                    ->get()
                    ->result_array();
            return $acos;
        }
        return [];

    }
    public function save($data){
        $conditions = [
            'class' => $data['class'],
            'method' =>$data['method']
        ];
        if($this->getBy($conditions,true) > 0){
            $result = $this->getBy($conditions);
            $id = $result[0]['acosid'];
            return $this->update($data,$id,'acosid');
        }else{
            return $this->insert($data);
        }
    }
}