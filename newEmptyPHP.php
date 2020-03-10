<?php
            session_start();
            require('../path_cfg.php');
            include_once(DIR_INC.'db_cfg.php');
            require (DIR_INC . 'gp_conn.php');
            ?>

<style>
      #buttons {
                    align:right;
                    background-color: #CFF4FF;
                    padding: 0px;
                    padding-left:94%;
                    margin-left:0.1%;
                    margin-right:0.1%;
                   border-top-left-radius: 4px;
                    border-top-right-radius: 4px;
                    border-top:1px solid #0096C8;
                     border-bottom:1px solid #0096C8;
                        border-left:1px solid #0096C8;
                     border-right:1px solid #0096C8;
                     
}

            .btn_v{
            border-radius: 7px;
            background-color: #0fab58;
            color: #fff;
            padding: 5px 7px;
            border: 1px solid #20711E;}

            .btn_c{
            border-radius: 7px;
            background-color: #e3290a;
            color: #fff;
            padding: 5px 21px;
            border: 1px solid #7A2D1C;}
    #tablehead {
                   
                    background-color: #CFF4FF;
                    padding: 0px;
                   
                   border-top-left-radius: 4px;
                    border-top-right-radius: 4px;
                    border-top:1px solid #0096C8;
                     border-bottom:1px solid #0096C8;
                        border-left:1px solid #0096C8;
                     border-right:1px solid #0096C8;
width:100%;
padding-left:20px;
                     
}
 
</style>
            <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
            <title>Report on Controller Wise Count DDO</title>
            <link  href=<?php echo DIR_INC.'csstyle.css'; ?> rel="stylesheet" type="text/css">
          <link  href=<?php echo DIR_INC.'csstyle.css'; ?> rel="stylesheet" type="text/css">
        <link  href=<?php echo DIR_INC.'global_main.css'; ?> rel="stylesheet" type="text/css">
        <link href=<?php echo DIR_INC.'jquery-ui.css'; ?> rel="stylesheet" type="text/css" >
        <link href=<?php echo DIR_INC.'dataTables.jqueryui.css'; ?> rel="stylesheet" type="text/css" >
        <script language="JavaScript" src=<?php echo DIR_INC.'xmlhttp.js'; ?> ></script>
        <script language="JavaScript" src=<?php echo DIR_INC.'field_validate.js'; ?>></script>
        <script language="Javascript" src="<?php echo(DIR_INC.'jquery.min.js');?>"> </script> 
        <script language="Javascript" src="<?php echo(DIR_INC.'jquery.dataTables.min.js');?>"> </script>
        <script language="Javascript" src="<?php echo(DIR_INC.'combofunctions.js');?>"> </script> 
        <script language="Javascript" src="<?php echo(DIR_INC.'knockout-2.js');?>"> </script> 
             <script language="Javascript" src="../inc/knockout-2.js"> </script>
            <script language="Javascript" src="../inc/jquery.dataTables.min.js"> </script>           
            <script language="Javascript" src="../inc/dataTables.buttons.min.js"> </script> 
            <script language="Javascript" src="../inc/jszip.min.js"> </script> 
            <script language="Javascript" src="../inc/vfs_fonts.js"> </script> 
            <script language="Javascript" src="../inc/buttons.html5.min.js"> </script> 
            <script language="JavaScript" >

             var qryfilename = "../mdc/qry_rpt_cont_wise_ddo_status.php";
            var tab_length;
            tab_length    = 0;
            var sentSTR   = '';
            var rowSelect = 0;
            var offName='';
            var off;

$(document).ready(function(){
//alert('hi');

       fun_window_onload();	
      
             } );
             
function fun_window_onload()
{    
     
                    fun_get_qry_sub('cont_cd',0);
   
}

function fun_get_qry_sub(qry_val,val)
{
  //  alert(qry_val);
	switch(qry_val)
	{				
		case 'ddo_status' :
			var data_list = xmlHTTP_send_post(qryfilename,"&action_code=ddo_status"+"&contcd="+document.frmngrecovery.cont_cd.value);
			//alert(data_list);//exit();	
			data_list = fun_remove_space(data_list);
			//alert(data_list);
			if(data_list=='ERROR')
			{
				alert("Error in fetching data !!!");
			}
			else if(data_list=="NORecord")
			{	
		
				document.getElementById('grid_table').style.display= 'none';
				alert("No records found for the given search criteria !!!");
                                document.getElementById('gridtable1_hide').style.display= 'none';
				  //function () {
                                var table = $(grid_table).DataTable();
                                table.buttons().disable();		
			}
                        
		else
			{
				document.getElementById('grid_table').style.display= '';
				$('#grid_table').html('');
				var retData = data_list;                            
				retData = $.parseJSON(retData);
                                // alert(retData);
				fun_fill_grid(retData);
			}
		     break;
                        case 'cont_cd' :			
                   var data_list = xmlHTTP_send_post(qryfilename,"&action_code=cont_cd");
			data_list = fun_remove_space(data_list);
			if(data_list=='NO_data')
			{
                                 document.getElementById('contr').style.display='none';
				alert("Controller is not available !!!");
			}
			else if(data_list=='ERROR')
				alert("Error in fetching record !!!");                           
                        
			else
			{
                                //document.getElementById('contr').style.display=''; 
				fun_fill_combo(data_list,document.frmngrecovery.cont_cd);
			}
			break;
		 
                       
		}
}



function fun_fill_grid(retData)
{
    
	$('#grid_table').dataTable( {
	//"scrollY":  200,
        //"scrollCollapse": true,
       
               "jQueryUI":  true,
		"info":  false,
		"searching":   false,
		"bAutoWidth": false,
		"bDestroy": true,
                "data": retData,
                "responsive": true,
              //  "sDom": '<"toolbar">frtip',
		//"processing": true,
"aoColumnDefs": [
            { "bVisible": false, "aTargets": [2] }
        ],
        "columns": [ 
            
                                 { "title": "S.N.O", "data": "srno","sWidth": "2%","sClass": "center" },
		                 { "title": "Controller Code & Name", "data": "fieldcodename","sWidth": "20%","sClass": "center" },
                                 { "title": "PAO Code & Name", "data": "paocode","sWidth": "5%","sClass": "center" },
		                 { "title": "DDO Code & Name", "data": "ddocodename","sWidth": "5%","sClass": "center" },
                                { "title": "DDO Type", "data": "ddo_type","sWidth": "5%","sClass": "center" },
                                { "title": "DDO City", "data": "city","sWidth": "5%","sClass": "center" },
                                { "title": "DDO State", "data": "state_name_eng","sWidth": "5%","sClass": "center" },
                                { "title": "Prepared Salary Bill Last Month", "data": "lastmonthsalaryprepared","sWidth": "5%","sClass": "center" },
                                 { "title": "Activated", "data": "IsActive","sWidth": "5%","sClass": "center" },
                                { "title": "Activation Date", "data": "ActiveOn","sWidth": "5%","sClass": "center" },
                                { "title": "E-Payment Status", "data": "cddo_isactive_pfms","sWidth": "5%","sClass": "center" },
                                { "title": "Merge DDO", "data": "merge_DDO","sWidth": "5%","sClass": "center" },
                                { "title": "GPF DDO", "data": "gpf_ddo","sWidth": "5%","sClass": "center" },
                                // { "title": "Total", "data": "totalnoactddo","sWidth": "5%","sClass": "center" }
		  ],
 
 /*"aoColumnDefs": [
            { "bVisible": false, "aTargets": [] }
        ],
*/
		"createdRow": function(row, data, index) {
                                                $(row).attr('data-srno',data.srno);
						$(row).attr('data-fieldcodename',data.fieldcodename);
						$(row).attr('data-paocode',data.paocode);
                                                $(row).attr('data-ddocodename',data.ddocodename); 
                                               $(row).attr('data-ddo_type',data.ddo_type);
                                               $(row).attr('data-city',data.city); 
                                               $(row).attr('data-state_name_eng',data.state_name_eng);
                                               $(row).attr('data-lastmonthsalaryprepared',data.lastmonthsalaryprepared); 
                                                $(row).attr('data-IsActive',data.IsActive); 
                                               $(row).attr('data-ActiveOn',data.ActiveOn);
                                               $(row).attr('data-cddo_isactive_pfms',data.cddo_isactive_pfms); 
                                               $(row).attr('data-merge_DDO',data.merge_DDO);
                                               $(row).attr('data-gpf_ddo',data.gpf_ddo); 
                                               // $(row).attr('data-totalnoactddo',data.totalnoactddo); 
                                               	$(row).addClass('js_displsy_row');
        }
        
        } );
        //$("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
 var table = $('#grid_table').DataTable();
 
 var buttons = new $.fn.dataTable.Buttons(table, {
     buttons: [
       'excelHtml5'
       // background-color: '#0fab58';

    ]
}).container().appendTo($('#buttons'));
}

function fun_on_brows()
{
            fun_get_qry_sub('ddo_status',0);
      
}


 

</script>

</head>
<body cellpadding="0" cellspacing="0" style="margin-left:1;margin-top:1 " onLoad="fun_window_onload();" bgcolor="">
           <div data-bind="nextFieldOnEnter:true"> 
                        <FORM name="frmngrecovery" >
                                <div class="combo_header_new" style="border:solid #000099 1px;" width='70%' id="form_fields_hide" >
                                      <table name="taboutermost"  width="100%" height="1%" cellpadding="0" cellspacing="0" style="BORDER-LEFT-COLOR: #003366;
                                        BORDER-BOTTOM-COLOR: #003366;
                                        BORDER-TOP-COLOR: #003366;
                                        BORDER-RIGHT-STYLE: solid;
                                        BORDER-LEFT-STYLE: solid;
                                        BORDER-RIGHT-COLOR: #003366;
                                        BORDER-BOTTOM-STYLE: solid;
                                        BORDER-TOP-STYLE: solid;
                                        border-color: #003366;" >
                                       
                                        <tr>
                                         <td class="cllabel" width="100%">
                                           <table name="tabpf" border="0" height="151" width="100%" >
                                                    <tr>
                                                           <td class="cllabel" style=" font-family : Arial; color:#660033; " height="147"  width="100%" >
                                                            <table name="table5" width="100%" height="30" border = '0'>
                                                              
                                
                                            <tr id="contr">  
                                              <td width="300" align="right"  class="cllabel">
                                                 <font size="2" face="Arial, Helvetica, sans-serif" color="#000080">
                                                  Controller <font size="2" face="Arial" color="red">                                               
                                                   </font> <strong>:</strong>
                                                  </font>
                                               </td>
                                              <td width="7" class="cllabel"></td> 
                                                 <td width="200"  class="cllabel">
                                                    <Select name="cont_cd"  id="cont_cd" class='clselect' tabIndex="2">
                                                     <option value=''>-------- ALL --------- </option>
                                                   </select>
                                                </td>       	
                                              <td width="125" class="cllabel">  
                                                <INPUT type="hidden" size="2" maxlength="2" name="hide1" id="hide1" class= "clinput">  
                                                
                                              </td> 
                                              <tr align="center">
		                                    <td class="cllabel" colspan="4" align="center">
                                                         <input title="Click for Search DDO" type="button" value="Go" name="butSearchDDO" id="butSearchDDO" 
					              tabIndex="21" onClick="fun_on_brows();" CLASS = 'btn_v' >
			                             <input  title="Click For Clear" type="button" value="  Clear  " name="butCancel" tabIndex="21"
					                onClick="fun_on_clear();"  CLASS = 'btn_c'> 
		                                  </td>
	                                        </tr>								   
	                                </table>
   	                              </td>
 	                             </tr>
                                  </table>
                                </td>
                                </tr>
                             </table>      
                    </div>                
            <div id="buttons" CLASS = 'btn_v'>
      
    </div>
   <!-- <table id="tablehead">
            <tbody><tr align="center" style=" padding-left:142px"><th style="margin-top: 58px;font-size: larger;padding-left: 435px!important;">Total Number of DDOs</th><th style="margin-top: 58px;font-size: larger;">Total Number of Activated DDO</th>
            </tr></tbody></table>-->
    <table>		
		<tr>
			<td style="width:2000px;" align="right">
				<table id="grid_table" cellpadding="0" cellspacing="10" border="0" class="display" style="width:100%; height:100%">
				</table>
			</td>
		</tr>
               
</table>                         
</form>
</body>
</html>
      