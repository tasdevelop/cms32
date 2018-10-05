<script type="text/javascript">

    $(document).ready(function(){
        $(".ui-th-column").css("background-color","#dddddd");
    });

    function fontColorFormat(cellvalue, options, rowObject) {
        var cellHtml = "<span style='font-size:13px;' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
        return cellHtml;
    }

    $(document).ready(function(){
        $grid = $("#gridjemaat");
        $grid.jqGrid({
            url:'<?php echo base_url()?>jemaat/grid3/<?= $this->uri->segment(2) ?>',
            datatype: "json",
            height: 250,
            autowidth: true,
            colNames:[
            'member_key',
            'aksi',
            'photo',
            'status_key',
            'grp_pi',
            'relationno',
            'memberno',
            'membername',
            'chinesename',
            'phoneticname',
            'tel_h',
            'tel_o',
            'handphone',
            'address',
            'add2',
            'city',
            'gender_key',
            'pstatus_key',
            'pob',
            'dob',
            'umur',
            'blood_key',
            'kebaktian_key',
            'persekutuan_key',
            'rayon_key',
            'serving',
            'fax',
            'email',
            'website',
            'baptismdocno',
            'baptis',
            'baptismdate',
            'remark',
            'relation',
            'oldgrp',
            'kebaktian',
            //'tglbesuk',
            'jlhbesuk',
            'tglbesukterakhir',
            'pembesukdari',
            'remark',
            'modifiedby',
            'modifiedon'
            ],
            colModel:[
                {name:'member_key', index:'member_key',sortable:false, search: false},
                {name:'aksi', index:'aksi', width:70, fixed:true, sortable:false, search: false},
                {name:'photofile', index:'photofile', width:65, fixed:true, stype :'select', searchoptions:{sopt:['eq'], value:":semua;ada:ada;kosong:kosong"}},
                {name:'status_key', index:'status_key', width:50, fixed:true, stype: 'select'},
                {name:'grp_pi', index:'grp_pi', width:60, fixed:true},
                {name:'relationno', index:'relationno', width:90, fixed:true},
                {name:'memberno', index:'memberno', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'membername', index:'membername', width:110, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'chinesename', index:'chinesename', width:100, fixed:true, searchoptions:{sopt:['cn']}, formatter:fontColorFormat},
                {name:'phoneticname', index:'phoneticname', width:100, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'tel_h', index:'tel_h', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'tel_o', index:'tel_o', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'handphone', index:'handphone', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'address', index:'address', width:90, fixed:true, edittype: "textarea",searchoptions:{sopt:['cn']}},
                {name:'add2', index:'add2', width:90, fixed:true, edittype: "textarea", searchoptions:{sopt:['cn']}},
                {name:'city', index:'city', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'gender_key', index:'gender_key', width:90, fixed:true, stype: 'select'},
                {name:'pstatus_key', index:'pstatus_key', width:90, fixed:true, stype: 'select'},
                {name:'pob', index:'pob', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'dob', index:'dob', width:90, fixed:true},
                {name:'umur', index:'umur', width:90, fixed:true, searchoptions:{sopt:['eq']}},
                {name:'blood_key', index:'blood_key', width:90, fixed:true, stype: 'select'},
                {name:'kebaktian_key', index:'kebaktian_key', width:90, fixed:true, stype: 'select'},
                {name:'persekutuan_key', index:'persekutuan_key', width:90, fixed:true, stype: 'select'},
                {name:'rayon_key', index:'rayon_key', width:90, fixed:true, stype: 'select'},
                {name:'serving', index:'serving', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'fax', index:'fax', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'email', index:'email', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'website', index:'website', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'baptismdocno', index:'baptismdocno', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'baptis', index:'baptis', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'baptismdate', index:'baptismdate', width:90, fixed:true},
                {name:'remark', index:'remark', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'relation', index:'relation', width:90, fixed:true, searchoptions:{sopt:['cn']}, formatter:fontColorFormat},
                {name:'oldgrp', index:'oldgrp', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'kebaktian', index:'kebaktian', width:90, fixed:true, searchoptions:{sopt:['cn']}},
             //   {name:'tglbesuk', index:'tglbesuk', width:90, fixed:true},
                {name:'jlhbesuk', index:'jlhbesuk', width:90, fixed:true,search:false,sortable:false},
                {name:'tglbesukterakhir', index:'tglbesukterakhir', width:90, fixed:true},
                {name:'teambesuk', index:'teambesuk', width:90, fixed:true, searchoptions:{sopt:['cn']}, formatter:fontColorFormat},
                {name:'description', index:'description', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'modifiedby', index:'modifiedby', width:90, fixed:true, searchoptions:{sopt:['cn']}},
                {name:'modifiedon', index:'modifiedon', width:130, fixed:true}
            ],
            rowNum:10,
            rowList : [10,20,30,50],
            loadonce:false,
            mtype: "POST",
            rownumbers: true,
            rownumWidth: 40,
            gridview: true,
            pager: '#pgridjemaat',
            enctype: "multipart/form-data",
            viewrecords: true,
            sortable: true,
            editurl: "<?php echo base_url()?>jemaat/crud",
            caption: "Data Jemaat",
            altRows:true,
            altclass:'myAltRowClass',
            toolbar: [true,"top"],
            onSelectRow: function(rowId) {
                var rowData = jQuery(this).getRowData(rowId);
                var member_key = rowData.member_key;
                var relationno = rowData.relationno;
                relasi(relationno);
                besuk(member_key);
            },
            loadComplete: function() {
            var ids = $grid.jqGrid('getDataIDs');
                if (ids) {
                    var stra = "<?php echo @$bgsortira ?>";
                    var strd = "<?php echo @$bgsortird ?>";
                    var sortName = $grid.jqGrid('getGridParam','sortname');
                    var sortOrder = $grid.jqGrid('getGridParam','sortorder');
                    for (var i=0;i<ids.length;i++) {
                        $grid.jqGrid('setCell', ids[i], sortName, '', '',
                                    {style:(sortOrder==='asc'?'background:'+stra+';':
                                                              'background:'+strd+';')});
                    }
                }
            }
        });

        $('#t_' + $.jgrid.jqID($grid[0].id)).append($("<div id='resetFilterOptions'><span id='resetFilterOptions'><i class='ui-icon-plus'></i> Clear Filter</span></div>"));

        $grid.jqGrid('filterToolbar',{
            stringResult: true,
            searchOnEnter : false
        });

        $grid.navGrid('#pgridjemaat',{
            edit:false,
            add:false,
            del:false,
            view: false,
            search:true
        }
        ,{}
        ,{}
        ,{}
        ,{
            multipleSearch: true,
            multipleGroup:true,
            caption:"Delete&nbsp;&nbsp;"
        });
        $grid.navButtonAdd('#pgridjemaat',{
            caption:"Delete&nbsp;&nbsp;",
            title : "Del",
            id:"deljemaat",
            buttonicon:"ui-icon-trash",
            onClickButton: function(){
                var recno = jQuery("#gridjemaat").jqGrid('getGridParam','selrow');
                if(recno != null){
                    del("del",recno,"formjemaat");
                }
                else{
                    alert("Pilih Row")
                }
            },
            position :'first'
        })
        .navButtonAdd('#pgridjemaat',{
            caption:"Edit&nbsp;&nbsp;",
            title:"Edit",
            id:"editjemaat",
            buttonicon:"ui-icon-pencil",
            onClickButton: function(){
                var recno = jQuery("#gridjemaat").jqGrid('getGridParam','selrow');
                if(recno != null){
                    save("edit",recno,"formjemaat",null);
                }
                else{
                    alert("Pilih Row")
                }
            },
            position :'first'
        })
        .navButtonAdd('#pgridjemaat',{
            caption:"Add&nbsp;&nbsp;",
            title:"Add",
            id:"addjemaat",
            buttonicon:"ui-icon-plus",
            onClickButton: function(){
                save("add",null,"formjemaat","<?php echo @$statusid ?>");
            },
            position :'first'
        })
        .navButtonAdd('#pgridjemaat',{
            caption:"View&nbsp;&nbsp;",
            title:"View",
            id:"viewjemaat",
            buttonicon:"ui-icon-document",
            onClickButton: function(){
                var recno = jQuery("#gridjemaat").jqGrid('getGridParam','selrow');
                if(recno != null){
                    view("view",recno,"formjemaat");
                }
                else{
                    alert("Pilih Row")
                }
            },
            position :'first'
        })
        .navButtonAdd('#pgridjemaat',{
           caption:"Excel&nbsp;&nbsp;",
           title : "Excel",
           id: "exceljemaat",
           buttonicon:"ui-icon-shuffle",
           onClickButton: function(){
                excel();
           }
        })
        .navButtonAdd('#pgridjemaat',{
           caption:"Hp Excel&nbsp;&nbsp;",
           title : "Excel",
           id: "hpexceljemaat",
           buttonicon:"ui-icon-shuffle",
           onClickButton: function(){
                hpexcel();
           }
        })
        .navButtonAdd('#pgridjemaat',{
           caption:"Hp Text&nbsp;&nbsp;",
           title : "Excel",
           id: "hptextjemaat",
           buttonicon:"ui-icon-shuffle",
           onClickButton: function(){
                hptext();
           }
        })
        .navButtonAdd('#pgridjemaat',{
           caption:"Report per Rayon&nbsp;&nbsp;",
           title : "Report per Rayon",
           id: "exceljemaat",
           buttonicon:"ui-icon-shuffle",
           onClickButton: function(){
                excel();
           }
        })

        .navButtonAdd('#pgridjemaat',{
           caption:"Crt R",
           title : "Creat Relation",
           id: "creatrelasijemaat",
           buttonicon:"ui-icon-arrowthick-2-e-w",
           onClickButton: function(){
                $.ajax({
                    url:"<?php echo base_url(); ?>jemaat/creatrelation/",
                    success:function(data)
                    {
                        $('#gridjemaat').trigger('reloadGrid');
                        alert("Silahkan Pilih Jemaat Untuk Membuat Relasi");
                    }
                });
           }
        });



        $("#resetFilterOptions").click(function(){
            $("#searchText").val("");
            $('input[id*="gs_"]').val("");
            $('select[id*="gs_"]').val("ALL");
            $("#gridjemaat").jqGrid('setGridParam', { search: false, postData: { "filters": ""} }).trigger("reloadGrid");
        });
    });

    $(document).ready(function(){

        datacreatrelasi();

        $("#selectboxid").live('click',function(){
            if($(this).is(":checked")){
                var recno = ($(this).val());
                return $.ajax({
                    url:"<?php echo base_url(); ?>jemaat/simpan_relation/"+recno,
                    success:function(data)
                    {
                        $('#gridcreatrelasi').trigger('reloadGrid');
                    }
                 }).responseText
            }
        });
        $(".btnview").live('click',function(){
            recno = $(this).attr("id");
            view("view",recno,"formjemaat");
        });
        $(".btnedit").live('click',function(){
            recno = $(this).attr("id");
            save("edit",recno,"formjemaat");
        });
        $(".btndel").live('click',function(){
            recno = $(this).attr("id");
            del("del",recno,"formjemaat");
        });
        $("#btnzoom").live('click',function(){
            photofile=$(this).attr("fimage");
            $('#foto').html('<img width="200" src="<?php echo base_url(); ?>libraries/img/loading.gif">');
            $('#foto').html('<img width="200" src="<?php echo base_url(); ?>uploads/medium_'+photofile+'">');
            $("#foto").dialog({
                top:50,
                height: 'auto',
                width: 'auto',
                modal:false
            });
        });
    });

    function view(form,id,formname){
        page="<?php echo base_url(); ?>jemaat/form/"+form+"/"+id+"/"+formname;
        $('#formInput').html('<img src="<?php echo base_url(); ?>libraries/img/loading.gif">').load(page);
        $("#formInput").dialog({
            top:10,
            width:'auto',
            height:500,
            modal:false,
            title:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/24x24/edit.png'><ul class='title'>View Data</ul>",
            buttons:[{
                html:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/cancel.png'>Cancel",
                click:function(){
                    $(this).dialog('close');
                }
            }]
        });
    }

    function save(form,id,formname,status){
        page="<?php echo base_url(); ?>jemaat/form/"+form+"/"+id+"/"+formname+"/"+status;
        $('#formInput').html('<img src="<?php echo base_url(); ?>libraries/img/loading.gif">').load(page);
        var opr = form;
        if(opr=="add"){
            var oprtr = "<img class='icon' src='<?php echo base_url(); ?>libraries/icon/24x24/add.png'><ul class='title'>Add Data</ul>";
        }
        else{
            var oprtr = "<img class='icon' src='<?php echo base_url(); ?>libraries/icon/24x24/edit.png'><ul class='title'>Edit Data</ul>";
        }
        $("#formInput").dialog({
            top:10,
            width:'auto',
            height:500,
            modal:false,
            title:oprtr,
            buttons:[{
                html:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/ok.png'>Save",
                click:function(){
                    var membername = $("#"+formname+" input[name=membername]").val();
                    if(membername==""){
                        $("#"+formname+" input[name=membername]").css("background-color","rgb(255,128,192)");
                        $("#"+formname+" input[name=membername]").focus();
                        $("#"+formname+" span[id=tip]").html("<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/warning.png'>");
                        return false;
                    }
                    return $.ajax({
                        type: $("#"+formname).attr("method"),
                        url: $("#"+formname).attr("action"),
                        enctype: 'multipart/form-data',
                        data : $("#"+formname).serialize(),
                        dataType: "json",
                        async: true,
                        success: function(data) {
                            if(data.status=='sukses' && data.photofile!="") {
                                $('#loading').html('<img src="<?php echo base_url(); ?>libraries/img/loading.gif">');
                                $.ajaxFileUpload({
                                    url: "<?php echo base_url(); ?>jemaat/upload/"+data.photofile,
                                    secureuri: false,
                                    fileElementId: "photofile",
                                    dataType: "json",
                                    success: function (status){
                                        $("#formInput").dialog('close');
                                        $('#gridjemaat').trigger('reloadGrid');
                                        $('#gridrelasi').trigger('reloadGrid');
                                        $('#gridbesuk').trigger('reloadGrid');
                                    }
                                });
                            }else {
                                $("#formInput").dialog('close');
                                $('#gridjemaat').trigger('reloadGrid');
                                $('#gridrelasi').trigger('reloadGrid');
                                $('#gridbesuk').trigger('reloadGrid');
                            }
                        }
                    }).responseText
                }
            },{
                html:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/cancel.png'>Cancel",
                click:function(){
                    $(this).dialog('close');
                }
            }]
        });
    }

    function del(form,id,formname){
        page="<?php echo base_url(); ?>jemaat/form/"+form+"/"+id+"/"+formname;
        $('#formInput').html('<img src="<?php echo base_url(); ?>libraries/img/loading.gif">').load(page);
        $("#formInput").dialog({
            top:10,
            width:'auto',
            height:500,
            modal:false,
            title:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/24x24/delete.png'><ul class='title'>Delete Data</ul>",
            buttons:[{
                html:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/delete.png'>Delete",
                click:function(){
                    var jwb = confirm('Anda Yakin ?');
                    if (jwb==1){
                        return $.ajax({
                            type: $("#"+formname).attr("method"),
                            url: $("#"+formname).attr("action"),
                            enctype: 'multipart/form-data',
                            data : $("#"+formname).serialize(),
                            dataType: "json",
                            async: true,
                            success: function(data) {
                                $("#formInput").dialog('close');
                                $('#gridjemaat').trigger('reloadGrid');
                                $('#gridrelasi').trigger('reloadGrid');
                                $('#gridbesuk').trigger('reloadGrid');
                            }
                        }).responseText
                    }
                }
            },{
                html:"<img class='icon' src='<?php echo base_url(); ?>libraries/icon/16x16/cancel.png'>Cancel",
                click:function(){
                    $(this).dialog('close');
                }
            }]
        });
    }

    function relasi(relationno){
        page="<?php echo base_url()?>relasi/index/?relationno="+relationno;
        console.log(page);
            $('#datarelasi').html('<img src="<?php echo base_url()?>libraries/img/loading.gif">').load(page);
    }

    function datacreatrelasi(){
        page="<?php echo base_url()?>create_relasi/view";
        $('#datacreatrelasi').html('<img src="<?php echo base_url()?>libraries/img/loading.gif">').load(page);

    }

    function besuk(recno){
        $.ajax({
            url:"<?php echo base_url(); ?>besuk/set/?recno="+recno,
            success:function(data){
                //alert(data);
            }
        });
       // alert(recno);
        //page="<?php echo base_url()?>besuk/index/?recno="+recno;
           // $('#databesuk').html('<img src="<?php echo base_url()?>libraries/img/loading.gif">').load(page);
    }



    function excel(){
        window.open("<?php echo base_url(); ?>jemaat/export/excel");
    }

    function hpexcel(){
        window.open("<?php echo base_url(); ?>jemaat/export/hpexcel");
    }

    function hptext(){
        window.open("<?php echo base_url(); ?>jemaat/export/hptext");
    }

    /*keyboard navigasi */
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();

    $(function(){
        $("#searchText").keyup(function() {
            delay(function(){
                var postData = $grid.jqGrid("getGridParam", "postData"),
                    colModel = $grid.jqGrid("getGridParam", "colModel"),
                    rules = [],
                    searchText = $("#searchText").val(),
                    l = colModel.length,
                    i,
                    cm;
                for (i = 0; i < l; i++) {
                    cm = colModel[i];
                    if (cm.search !== false && (cm.stype === undefined || cm.stype === "text")) {
                        rules.push({
                            field: cm.name,
                            op: "cn",
                            data: searchText
                        });
                    }
                }
                postData.filters = JSON.stringify({
                    groupOp: "OR",
                    rules: rules
                });
                $grid.jqGrid("setGridParam", { search: true });
                $grid.trigger("reloadGrid", [{page: 1, current: true}]);
                return false;
            }, 500 );
        });
    });

</script>

<div id="tt" class="easyui-tabs">
    <div data-options="selected:true" title="Data Jemaat" style="padding:10px">
        <div id="titlesearch">Search : <input type="text" placeHolder="Search" id="searchText"></div>
        <table id="gridjemaat"></table>
        <div id="pgridjemaat"></div>
        <div id="formInput"></div>
        <div id="foto"></div>
        <div id="datarelasi"></div>
    </div>
    <div data-options="closable:false,cache:false,href:'<?php echo base_url(); ?>besuk/?op=jemaat'" title="Data Besuk" style="padding:10px" ></div>

</div>
