<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<fieldset>

    <div class="row">
        <div class=col-md-3>
            <b>Select Activity</b>
        </div>
        <div class=col-md-3>
            <b>Select State</b>
        </div>

        <div class=col-md-2>
            <b>STEP:I</b>
        </div>


    </div>

    <div class="row">

        <div class=col-md-3>
            <?php
            echo $this->Form->input('event_activity_lists_id', ['id' => 'event_activity_lists_id', 'label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $eventActivitiyList]);
            ?>
        </div>

        <div class="col-md-3" id="showMsCadres">

            <?php
            echo $this->Form->input('state_list_id', [
                'id' => 'state_list_id',
                'label' => false,
                'autocomplete' => 'off',
                'empty' => 'Select'
                    //,'options' => $stateList
            ]);
            ?>
        </div>

        <div class="col-md-1">
            <?php
            echo $this->Form->button('Show Attendance List', array(
                'type' => 'button',
                'id' => 'attendanceList',
                'class' => 'attendanceList btn  btn-primary',
            ));
            ?>
        </div>
    </div>


    <div class="col-md-12" id="coverScreen" style="display:none">
        <p><h4>Please wait we are fetching you request......</h4></p>
        <div class="loader" id="loader"></div>

    </div>


    <div class="col-md-12" id="ajaxdiv" style="display:none" >

        <div class="box-inner">
            <div class="panel panel-primary">

                <div class="panel-heading"><b><?php echo strtoupper(__('Attendance List')) ?></b></div>

                <div class="panel-body">
                    <siv class="row">
                        <div class="col-md-11">
                            <?php
                            echo $this->Form->submit('Print List', array('type' => 'button', 'class' => 'btn  btn-success', 'onclick' => "printInfo('dvApplicationPrintContents')"));
                            ?>

                        </div>
                        <div class="col-md-1">
                        </div>

                        <div class="animate-bottom" class="col-md-12" style="display:none;" id="show_attendence_list"></div>


                </div>
            </div>
        </div>
    </div>
</fieldset>



<script type="text/javascript">



    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 3000);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("ajaxdiv").style.display = "block";
    }

    $('#event_activity_lists_id').change(function () {
        var event_activity_lists_id = $('#event_activity_lists_id').val();
        $.ajax({
            type: "GET",
            url: "<?php echo $this->Url->build(array('controller' => 'EventLists', 'action' => 'EventActivityStateList')); ?>",
            data: {event_activity_lists_id: event_activity_lists_id},
            success: function (data) {
                $('#state_list_id').html(data);
                $("#showMsCadres").show();
            }
        });
    });
</script>


<script>
    $(window).on('load', function () {
        $("#coverScreen").hide();
    });

    function showTable() {
        $('#topTable').show();
    }
    ;
    function hideTable() {
        $('#topTable').hide();
    }
    ;


    $('.attendanceList').on('click', function () {
        var event_activity_lists_id = document.getElementById("event_activity_lists_id").value;
        var state_list_id = document.getElementById("state_list_id").value;
        //alert(event_activity_lists_id);
        if (event_activity_lists_id == '' && state_list_id == '') {
            alert("Please Select one event activity.");
            return false;
        }
        $("#coverScreen").show();
        $.ajax({
            type: "GET",
            url: "<?php echo $this->Url->build(array('controller' => 'EventLists', 'action' => 'ajax_attendance_list')); ?>",
            data: {event_activity_lists_id: event_activity_lists_id, state_list_id: state_list_id},
            success: function (data) {
                if (data != 0) {

                    $('#ajaxdiv').show();
                    $('#show_attendence_list').show();
                    $('#show_attendence_list').html(data);
                } else {
                    $('#ajaxdiv').hide();
                    $('#show_attendence_list').hide();
                    $('#show_attendence_list').html('');
                }
                $("#coverScreen").hide();
            }
        });
    });

</script>


<style>
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid orange;
        border-right: 16px solid white;
        border-bottom: 16px solid green;

        width: 300px;
        height: 300px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        top: 50%;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 2s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
    }

    #ajaxdiv {
        display: none;
        text-align: center;
    }


    img {
        position: absolute;
        top: 25px;
        left: 25px;
    }
    .imgA1 {
        z-index: 1;
    }
    .imgB1 {
        z-index: 3;
    }
</style>


