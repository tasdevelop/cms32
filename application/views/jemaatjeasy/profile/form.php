<div style="margin:0;padding:20px">
    <input type="hidden" name="member_key" value="<?php echo @$member_key ?>">
    <div  class="row">
<?php
    @$query=("SELECT *, DATE_FORMAT(activitydate,'%d-%m-%Y') activitydate,
        DATE_FORMAT(modifiedon,'%d-%m-%Y %T') modifiedon FROM tblprofile WHERE profile_key=".$profile_key." LIMIT 0,1");
    @$row=queryCustom($query);
    @$activity = getParameterKey($row->activityid)->parameterid;
    @$exp1 = explode('-',$row->activitydate);
    @$activitydate = $exp1[1]."/".$exp1[0]."/".$exp1[2];
    @$activitydate = @$activitydate == "00/00/0000"?"":@$activitydate;

?>
        <input type="hidden" name="profile_key" value="<?php echo @$row->profile_key ?>">
        <div style="margin-bottom:10px">
            <input name="activitydate" labelPosition="left" class="easyui-datebox"  value="<?= @$activitydate ?>"  label="activitydate:" style="width:100%">
        </div>
        <div style="margin-bottom:10px">
                <select name="activityid"  labelPosition="left" class="easyui-combobox" label="activity:" style="width:100%;">
                <option value=""></option>
                <?php
                    foreach ($sqlactivity as $rowform) {
                        ?>
                            <option <?php if(@$row->activityid==$rowform->parameter_key){echo "selected";} ?> value="<?php echo $rowform->parameter_key ?>"><?php echo $rowform->parametertext ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        <div style="margin-bottom:10px">
            <input name="remark" labelPosition="left" class="easyui-textbox"  value="<?= @$row->remark ?>"  label="remark:" style="width:100%">
        </div>
    </div>
</div>