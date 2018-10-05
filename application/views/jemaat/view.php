<?php
    @$query="SELECT *, DATE_FORMAT(dob,'%d-%m-%Y') dob,
        DATE_FORMAT(tglbesuk,'%d-%m-%Y') tglbesuk,
        DATE_FORMAT(baptismdate,'%d-%m-%Y') baptismdate,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedon FROM tblmember WHERE member_key=".$member_key." LIMIT 0,1";
    @$row=queryCustom2($query);
?>
<input type="hidden" name="member_key" value="<?php echo @$row['member_key'] ?>">
<table class="table table-condensed" cellpadding="0" cellspacing="0">
    <tr>
        <td>grp_pi</td>
        <td>: <?php echo @$row['grp_pi'] ?></td>
    </tr>
    <tr>
        <td>relationno</td>
        <td>: <?php echo @$row['relationno'] ?></td>
        <td rowspan="37" valign="top" align="center">
            <?php
                if($row['photofile']!=""){
                    $url = "medium_".$row['photofile'];
                }
                else{
                    $url = "medium_nofoto.jpg";
                }
            ?>
            <img width="200" class="mediumpic" id="blah" src="<?php echo base_url();?>uploads/<?php echo $url ?>">
            <a href="<?php echo base_url()?>jemaat/download/<?php echo $url ?>" title="Download Foto">
                <img src='<?php echo base_url(); ?>libraries/icon/24x24/download.jpg'>
            </a>
            <input type="hidden" name="editphotofile" id="editphotofile" value="<?php echo $row['photofile'] ?>">
        </td>
    </tr>
    <tr>
        <td>memberno</td>
        <td>: <?php echo @$row['memberno'] ?></td>
    </tr>
    <tr>
        <td>membername</td>
        <td>: <?php echo @$row['membername'] ?></td>
    </tr>
    <tr>
        <td>chinesename</td>
        <td>: <?php echo @$row['chinesename'] ?></td>
    </tr>
    <tr>
        <td>phoneticname</td>
        <td>: <?php echo @$row['phoneticname'] ?></td>
    </tr>
    <tr>
        <td>aliasname</td>
        <td>: <?php echo @$row['aliasname'] ?></td>
    </tr>
    <tr>
        <td>tel_h</td>
        <td>: <?php echo @$row['tel_h'] ?></td>
    </tr>
    <tr>
        <td>tel_o</td>
        <td>: <?php echo @$row['tel_o'] ?></td>
    </tr>
    <tr>
        <td>handphone</td>
        <td>: <?php echo @$row['handphone'] ?></td>
    </tr>
    <tr>
        <td>address</td>
        <td>: <?php echo @$row['address'] ?></td>
    </tr>
    <tr>
        <td>add2</td>
        <td>: <?php echo @$row['add2'] ?></td>
    </tr>
    <tr>
        <td>city</td>
        <td>: <?php echo @$row['city'] ?></td>
    </tr>
    <tr>
        <td>gender_key</td>
        <td>: <?php echo $row['gender_key']; ?></td>
    </tr>
    <tr>
        <td>pstatus_key</td>
        <td>: <?php echo $row['pstatus_key']; ?></td>
    </tr>
    <tr>
        <td>pob</td>
        <td>: <?php echo @$row['pob'] ?></td>
    </tr>
    <tr>
        <td>dob</td>
        <td>:
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#dob").datepicker();
                });
            </script>
         <?php echo @$row['dob'] ?>
        </td>
    </tr>
    <tr>
        <td>blood_key</td>
        <td>: <?php echo $row['blood_key']; ?></td>
    </tr>
    <tr>
        <td>kebaktian_key</td>
        <td>: <?php echo $row['kebaktian_key']; ?></td>
    </tr>
    <tr>
        <td>persekutuan_key</td>
        <td>: <?php echo $row['persekutuan_key']; ?></td>
    </tr>
    <tr>
        <td>rayon_key</td>
        <td>: <?php echo $row['rayon_key']; ?></td>
    </tr>
    <tr>
        <td>status_key</td>
        <td>: <?php echo @$row['status_key'] ?></td>
    </tr>
    <tr>
        <td>fax</td>
        <td>: <?php echo @$row['fax'] ?></td>
    </tr>
    <tr>
        <td>email</td>
        <td>: <?php echo @$row['email'] ?></td>
    </tr>
    <tr>
        <td>website</td>
        <td>: <?php echo @$row['website'] ?></td>
    </tr>
    <tr>
        <td>baptismdocno</td>
        <td>: <?php echo @$row['baptismdocno'] ?></td>
    </tr>
    <tr>
        <td>baptis</td>
        <td>: <?php echo $row['baptis']; ?></td>
    </tr>
    <tr>
        <td>baptismdate</td>
        <td>:
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#baptismdate").datepicker();
                });
            </script>
         <?php echo @$row['baptismdate'] ?>
        </td>
    </tr>
    <tr>
        <td>remark</td>
        <td>: <?php echo @$row['remark'] ?></td>
    </tr>
    <tr>
        <td>relation</td>
        <td>: <?php echo @$row['relation'] ?></td>
    </tr>
    <tr>
        <td>oldgrp</td>
        <td>: <?php echo @$row['oldgrp'] ?></td>
    </tr>
    <tr>
        <td>kebaktian</td>
        <td>: <?php echo @$row['kebaktian'] ?></td>
    </tr>

    <?php
        $pembesukdari="";
        $remark="";
        $besukdate="";
        $q = ("SELECT * FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
        if($dta = queryCustom2($q)){
            $pembesukdari=$dta['pembesukdari'];
            $remark=$dta['remark'];
            $besukdate=$dta['besukdate'];

            $d=strtotime($besukdate);
            $besukdate = date("Y-m-d", $d);
        }
    ?>

    <tr>
        <td>besukdate</td>
        <td>:<?php echo @$row['besukdate'] ?></td>
    </tr>
    <tr>
        <td>pembesukdari</td>
        <td>: <?php echo @$row['pembesukdari'] ?></td>
    </tr>
    <tr>
        <td>remark</td>
        <td>: <?php echo @$row['remark'] ?></td>
    </tr>
    <tr>
        <td>modifiedby</td>
        <td>: <?php echo @$row['modifiedby'] ?></td>
    </tr>
    <tr>
        <td>description</td>
        <td>: <?php echo @$row['description'] ?></td>
    </tr>
    <tr>
        <td>modifiedon</td>
        <td>: <?php echo @$row['modifiedon'] ?></td>
    </tr>
</table>