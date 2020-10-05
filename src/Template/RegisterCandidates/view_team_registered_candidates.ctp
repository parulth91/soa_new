
<?php

/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<?php echo $this->Form->create('false',['id'=>'team_list_form']); 

if (!empty($stateDetails)) 
{

?>

<div class="row">
    <?php
    if (isset($registeredCandidatePaginate)) {
      $registeredCandidatePaginate = $registeredCandidatePaginate;
    } else {
      $registeredCandidatePaginate = 0;
    }
    if (isset($eventTeamId)) {
      $eventTeamId = $eventTeamId;
    } else {
      $eventTeamId = 0;
    }
    ?>
    <fieldset>
        <p style="color: red">
            Note: View Your Team Details after submission.

        </p>
        <div class=col-md-5>
        <?php
        //  if ($eventActivityListValue->activity_list->game_type_list->description != 'Individual') {
?>
       
         <?php     
        echo $this->Form->input('state_list_id', ['id'=>'state_list_id',
        'type' => 'select',
        'label' => 'Select State',
        'empty' => "Select ",
        'options' => $stateDetails,
        'required' => 'true'
      
      ]);?>
       <?php     
        echo $this->Form->input('event_act_id', ['id'=>'event_act_id',
        'type' => 'hidden',
        'value'=>$id
      
      ]);?>
      <div id="teamlistdiv">
           
    </div>    
        </div>
    </fieldset>
    <?= $this->Form->button("View Registered Team", ['name' => 'view_registered_button', 'id' => 'view_registered_button', 'class' => 'btn btn-primary'
                                                    ]); ?>
  <?php } ?>
  </div>



      <?= $this->Form->end() ?>
<div id="teamlistdata">
</div>
</div> 
<script>  
function printDiv(divName) {
  //window.stop();
  //e.preventDefault();
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

    $("#paginator").empty(); 

   $('tr').children().eq(13).hide();
      $('table tr').find('td:eq(13)').hide();
     window.print();

     document.body.innerHTML = originalContents;
}

$(document).ready(function() {
 // alert('hh');
  if(document.getElementById("state_list_id").value =="" )
       {
         $("#teamlistdiv").hide();
       }

  else{
  
    $(".pen-title").show();
    $("#candidate_list").show();
  }

////////////////////////to display team wise and state wise data on button click using ajax//////////////////////////////
 $("#view_registered_button").click(function(e){
    e.preventDefault();
    if(document.getElementById("state_list_id").value =="" )
       {
         
          $(".pen-title").hide();
          $("#candidate_list").hide();
     }
     else{
            var id= $("#event_act_id").val();
            var stateid =  $("#state_list_id").val();
            var teamid =  $("#team_list_id").val();
            var baseUrl = "<?php echo $this->Url->build('/register-candidates', true);?>";
           // alert(baseUrl);
            $.ajax({
                type:'GET',
                'dataExpression':true,
               
                beforeSend: function(xhr){
            xhr.setRequestHeader("X-CSRF-Token", $('[name="_csrfToken"]').val());
        },
                async: true,
                cache: false,
                url: baseUrl + '/getRegisteredTeamList',
                data: {
                  event_actid:id,
                  state_id : stateid,
                  team_id : teamid,
                },
                success: function(data) {
               $("#teamlistdata").show();
              //  $(data).each(function () {
               // var opts = $.parseJSON(data);
              // alert(opts);
            //  $.each(opts, function(key, value) {
              //   $('#team_list_id').append('<option value="'+ key +'">'+ value +'</option>');
              $('#teamlistdata').html(data);    
              if(data==0){

              }  
   },
                error:function (){
                    alert('I am in Error');
                },
            });
     }
    });
  ///////////////////////////to fill team dropdown according to state select list using ajax///////////////////////////////////////////////  
  $("#state_list_id").change(function(){

            var stateid = $(this).val();
            var baseUrl = "<?php echo $this->Url->build('/register-candidates', true);?>";
           // alert(baseUrl);
            $.ajax({
                type:'GET',
                'dataExpression':true,
               
                beforeSend: function(xhr){
            xhr.setRequestHeader("X-CSRF-Token", $('[name="_csrfToken"]').val());
        },
                async: true,
                cache: false,
                url: baseUrl + '/getTeamList',
                data: {
                  state_id : stateid,
                },
                success: function(data) {
             alert(data);

               $("#teamlistdiv").show();
              //  $(data).each(function () {
               // var opts = $.parseJSON(data);
              // alert(opts);
            //  $.each(opts, function(key, value) {
              //   $('#team_list_id').append('<option value="'+ key +'">'+ value +'</option>');
              if(data==0){
                
                $("#teamlistdiv").hide();
                $(".pen-title").hide();
                $("#candidate_list").hide();
                $("#teamlistdata").hide();
                $("#view_registered_button").hide();
              }
              else{
                $('#teamlistdiv').show();
              $(".pen-title").show();
                $("#candidate_list").show();
                $("#teamlistdata").show();
                $("#view_registered_button").show();
                $('#teamlistdiv').html(data);
              
             }  
   },
                error:function (){
                    alert('I am in Error');
                },
            });
        })
 
 }); 


</script>