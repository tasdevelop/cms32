<script type="text/javascript">
function readurl(input) {
    var x = $("#photofile").val();
    var ext = x.split('.').pop();
    switch(ext){
        case 'jpg':
        case 'JPG':
            var reader = new FileReader();
            reader.onload = function (e){
                $('#blah')
                .attr('src', e.target.result)
                .width(200);
            };
            reader.readAsDataURL(input.files[0]);
            $("#extphotofile").val(ext);
        break;
        default:
            $("#extphotofile").val("");
            alert('extensi harus jpg');
            this.value='';
    }
}

$(document).ready(function(){
    $('input[type=text]').focusout(function() {
        $(this).val($(this).val().toUpperCase());
    });

    $("#btn_clear_photo").click(function(){
        $("#blah").attr("src", "<?php echo base_url();?>uploads/medium_nofoto.jpg");
        $("#editphotofile").val("clearfoto");
    });

/*
    $('input').focusout(function() {
        // Uppercase-ize contents
        this.value = this.value.toLocaleUpperCase();
    });
*/

    $('input[type=email]').focusout(function() {
        $(this).val($(this).val().toLowerCase());
    });

    $('textarea').focusout(function() {
        $(this).val($(this).val().toUpperCase());
    });

});
</script>
<?php
    @$query=("SELECT *, DATE_FORMAT(dob,'%d-%m-%Y') dob,
        DATE_FORMAT(tglbesuk,'%d-%m-%Y') tglbesuk,
        DATE_FORMAT(baptismdate,'%d-%m-%Y') baptismdate,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedon FROM tblmember WHERE member_key=".$member_key." LIMIT 0,1");
    @$row=queryCustom2($query);
?>

<style type="text/css">
    @font-face{
        font-family: COOPERM;
        src: url('libraries/font/COOPERM.TTF'),url('../../libraries/font/COOPERM.eot'); /* IE9 */
    }

    @font-face{
        font-family: CHISER__;
        src: url('libraries/font/CHISER__.TTF'),url('../../libraries/font/CHISER__.eot'); /* IE9 */
    }

    @font-face{
        font-family: segoeui;
        src: url('libraries/font/segoeui.ttf'),url('../../libraries/font/segoeui.eot'); /* IE9 */
    }
    table{
        font-family:segoeui;
        font-size: 12px;
    }

    input{
        font-family:segoeui;
        font-size: 8px;
    }

    #address{
        font-family:segoeui;
        font-size: 11px;
    }
</style>
<input type="hidden" name="member_key" value="<?php echo @$row['member_key'] ?>">
<table class="table table-condensed" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>grp_pi</td>
        <td>: <input type="checkbox" class="inputmedium" <?php if(@$row['grp_pi']==1 OR @$grp_pi=="pi"){echo "checked";} ?> value="1" name="grp_pi" id="grp_pi"></td>
    </tr>
    <tr>
        <td>relationno</td>
        <td width="250">: <input type="text" class="inputmedium" value="<?php echo $row['relationno'] ?>" name="relationno" id="relationno"></td>
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
            <br>
            <div class="upload">Ganti Foto
                <input id="photofile" type="file" name="photofile" onchange="readurl(this);"/>
            </div>
            <a href="<?php echo base_url()?>jemaat/download/<?php echo $url ?>" title="Download Foto">
                <img src='<?php echo base_url(); ?>libraries/icon/16x16/download.jpg'>
            </a>
            <a href="#" id="btn_clear_photo">
                <img src='<?php echo base_url(); ?>libraries/icon/16x16/delete.png'>
            </a>
            <input type="hidden" name="editphotofile" id="editphotofile" value="<?php echo $row['photofile'] ?>">
            <input type="hidden" name="extphotofile" id="extphotofile">
            <div id="loading"></div>
        </td>
    </tr>
    <tr>
        <td>memberno</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['memberno'] ?>" name="memberno" id="memberno"></td>
    </tr>
    <tr>
        <td>membername</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['membername'] ?>" name="membername" id="membername"><span id="tip"></span></td>
    </tr>
    <tr>
        <td>chinesename</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['chinesename'] ?>" name="chinesename" id="chinesename"></td>
    </tr>
    <tr>
        <td>phoneticname</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['phoneticname'] ?>" name="phoneticname" id="phoneticname"></td>
    </tr>
    <tr>
        <td>aliasname</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['aliasname'] ?>" name="aliasname" id="aliasname"></td>
    </tr>
    <tr>
        <td>tel_h</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['tel_h'] ?>" name="tel_h" id="tel_h"></td>
    </tr>
    <tr>
        <td>tel_o</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['tel_o'] ?>" name="tel_o" id="tel_o"></td>
    </tr>
    <tr>
        <td>handphone</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['handphone'] ?>" name="handphone" id="handphone"></td>
    </tr>
    <tr>
        <td>address</td>
        <td>:
            <textarea name="address" id="address"><?php echo @$row['address'] ?></textarea>
        </td>
    </tr>
    <tr>
        <td>add2</td>
        <td>:
            <textarea name="add2" id="add2"><?php echo @$row['add2'] ?></textarea>
        </td>
    </tr>
    <tr>
        <td>city</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['city'] ?>" name="city" id="city"></td>
    </tr>
    <tr>
        <td>gender</td>
        <td>:
            <select id="genderid" name="genderid">
                <option value=""></option>
                <?php
                    foreach ($sqlgender as $rowform) {
                        ?>
                            <option <?php if($row['gender_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>pstatusid</td>
        <td>:
            <select id="pstatusid" name="pstatusid">
                <option value=""></option>
                <?php
                    foreach ($sqlpstatus as $rowform) {
                        ?>
                            <option <?php if($row['pstatus_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>pob</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['pob'] ?>" name="pob" id="pob"></td>
    </tr>
    <tr>
        <td>dob</td>
        <td>:
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#dob").datepicker({dateFormat: 'dd-mm-yy'});
                });
            </script>
            <input type="text" class="inputmedium" value="<?php echo @$row['dob'] ?>" name="dob" id="dob">
        </td>
    </tr>
    <tr>
        <td>bloodid</td>
        <td>:
            <select id="bloodid" name="bloodid">
                <option value=""></option>
                <?php
                    foreach ($sqlblood as $rowform) {
                        ?>
                            <option <?php if($row['blood_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>kebaktianid</td>
        <td>:
            <select id="kebaktianid" name="kebaktianid">
                <option value=""></option>
                <?php
                    foreach ($sqlkebaktian as $rowform) {
                        ?>
                            <option <?php if($row['kebaktian_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>persekutuanid</td>
        <td>:
            <select id="persekutuanid" name="persekutuanid">
                <option value=""></option>
                <?php
                    foreach ($sqlpersekutuan as $rowform) {
                        ?>
                            <option <?php if($row['persekutuan_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>rayonid</td>
        <td>:
            <select id="rayonid" name="rayonid">
                <option value=""></option>
                <?php
                    foreach ($sqlrayon as $rowform) {
                        ?>
                            <option <?php if($row['rayon_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>statusid</td>
        <td>:
            <select id="statusid" name="statusid">
                <option value=""></option>
                <?php
                    foreach ($sqlstatusid as $rowform) {
                        ?>
                            <option <?php if($row['status_key']==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>fax</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['fax'] ?>" name="fax" id="fax"></td>
    </tr>
    <tr>
        <td>email</td>
        <td>: <input type="email" class="inputmedium" value="<?php echo @$row['email'] ?>" name="email" id="email"></td>
    </tr>
    <tr>
        <td>website</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['website'] ?>" name="website" id="website"></td>
    </tr>
    <tr>
        <td>baptismdocno</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['baptismdocno'] ?>" name="baptismdocno" id="baptismdocno"></td>
    </tr>
    <tr>
        <td>baptis</td>
        <td>: <input type="checkbox" value="1" id="baptis" name="baptis" <?php if($row['baptis']==1){echo "checked";} ?>></td>
    </tr>
    <tr>
        <td>baptismdate</td>
        <td>:
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#baptismdate").datepicker({dateFormat: 'dd-mm-yy'});
                });
            </script>
            <input type="text" class="inputmedium" value="<?php echo @$row['baptismdate'] ?>" name="baptismdate" id="baptismdate">
        </td>
    </tr>
    <tr>
        <td>remark</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['remark'] ?>" name="remark" id="remark"></td>
    </tr>
    <tr>
        <td>relation</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['relation'] ?>" name="relation" id="relation"></td>
    </tr>
    <tr>
        <td>oldgrp</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['oldgrp'] ?>" name="oldgrp" id="oldgrp"></td>
    </tr>
    <tr>
        <td>kebaktian</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['kebaktian'] ?>" name="kebaktian" id="kebaktian"></td>
    </tr>

    <?php
        $pembesukdari="";
        $remark="";
        $besukdate="";
        $q = ("SELECT * FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
        //$q = mysql_query("SELECT *, DATE_FORMAT(besukdate,'%Y-%m-%d') AS besukdate FROM tblbesuk WHERE member_key='$member_key' ORDER BY besukdate DESC");
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
        <td>:
            <?php echo @$besukdate ?>
        </td>
    </tr>
    <tr>
        <td>pembesukdari</td>
        <td>:
            <?php echo @$pembesukdari ?>
        </td>
    </tr>
    <tr>
        <td>remark</td>
        <td>:
            <?php echo @$remark ?>
        </td>
    </tr>
    <tr>
        <td>teambesuk</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['teambesuk'] ?>" name="teambesuk" id="teambesuk"></td>
    </tr>
    <tr>
        <td>description</td>
        <td>: <input type="text" class="inputmedium" value="<?php echo @$row['description'] ?>" name="description" id="description"></td>
    </tr>
</table>