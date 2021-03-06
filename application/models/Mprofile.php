<?php
Class Mprofile extends MY_Model{

    function count($where){
        $sql = $this->db->query("SELECT profile_key FROM tblprofile " . $where);
        return $sql;
    }
    function get($where, $sidx, $sord, $limit, $start){
        $sql = $this->db->query("SELECT *,
        DATE_FORMAT(besukdate,'%d-%m-%Y') besukdateview,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedonview
        FROM tblbesuk " . $where . " ORDER BY $sidx $sord LIMIT $start , $limit");
        return $sql;
    }
    function getM($where, $sidx, $sord, $limit, $start){
        $query = "select *,
        DATE_FORMAT(activitydate,'%d-%m-%Y') activitydate,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedon from tblprofile  " . $where . " ORDER BY $sidx $sord LIMIT $start , $limit";
        return $this->db->query($query);
    }
    function add($tabel,$data){
        $sql = $this->db->insert($tabel,$data);
    }
    function edit($tabel,$data,$id){
        $query = $this->db->where("profile_key",$id);
        $query = $this->db->update($tabel,$data);
    }
    function getwhere($member_key){
        $sql = $this->db->query("SELECT *,
        DATE_FORMAT(dob,'%d-%m-%Y') dob,
        DATE_FORMAT(tglbesuk,'%d-%m-%Y') tglbesuk,
        DATE_FORMAT(baptismdate,'%d-%m-%Y') baptismdate,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedon
        FROM tblmember WHERE member_key ='$member_key' LIMIT 0,1");
        return $sql;
    }
    function del($tabel,$id){
        $query = $this->db->where("profile_key",$id);
        $sql = $this->db->delete($tabel);
        return $sql;
    }
}
?>
