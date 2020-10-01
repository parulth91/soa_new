<?php

/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;

$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php echo $this->Form->create('submit_form', ['id' => 'submit_form', 'type' => 'post']); ?>
<?php foreach ($eventActivityLists as $eventActivityListValue) { 
    
    //debug($eventActivityListValue);
    ?>
<div class = "pen-title">
    <h3 style="align:center">Registration for <?php echo $eventActivityListValue->event_list->description; //die;              
    ?> 
    </h3>
</div>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>Gender</th>
                <?php if ($eventActivityListValue->activity_list->weight_category_list != null) { ?>
            <th id="weightminlabel">Minimum Weight</th>
            <th id="weightmaxlabel">Maximum Weight</th>
                <?php } ?>
            <th>Minimum Age</th>
            <th>Maximum Age</th>
            <th>Minimum No. Of Players</th>          
            <th>Maximum No. Of Players</th>          
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                    <?php echo $genderValue = $eventActivityListValue->activity_list->gender_list->description; ?>
            </th>
                <?php
                $weightFlag = $eventActivityListValue->activity_list->weight_category_list;
                if ($eventActivityListValue->activity_list->weight_category_list != null) {
                    ?>
            <th id="weightminlabel">
                        <?php echo $minimum_weight = $eventActivityListValue->activity_list->weight_category_list->minimum_weight; ?>
            </th>
            <th id="weightmaxlabel">
                        <?php echo $maximum_weight = $eventActivityListValue->activity_list->weight_category_list->maximum_weight; ?>
            </th>
                <?php } ?>
            <th>
                    <?php echo $minimumage=$eventActivityListValue->activity_list->age_group_list->minimum_age; ?>
            </th>
            <th>
                    <?php echo $maximumage=$eventActivityListValue->activity_list->age_group_list->maximum_age; ?>
            </th>          

            <th>
                    <?php 
                    
                    echo $minimum_player_participating = $eventActivityListValue->activity_list->minimum_player_participating; 
                   
                    
                    ?>
            </th>          
            <th>
                    <?php 
                    
                    echo $maximum_player_participating = $eventActivityListValue->activity_list->maximum_player_participating; 
                   
                    
                    ?>
            </th>          
        </tr>
    <p style="color: red">
        Note: Date for calculating age is registration start date i.e.
            <?php
            $registration_start_date =$eventActivityListValue->event_list->registration_start_date;
             echo date_format($eventActivityListValue->event_list->registration_start_date,'d-m-Y'); 
             ?>
    </p>

</tbody>
        <?php
        //debug($eventActivityListValue->activity_list->game_type_list->description); 
    }
    ?>
</table>
<legend><?= __('Add {0}', ['Candidate For ' . $eventActivityListValue->activity_list->description]) ?></legend>
<div class="row">
    <?php
    if ($eventActivityListValue->activity_list->game_type_list->description != 'Individual') {
        echo $this->Form->input('EventTeamDetails.description', [
            'label' => 'Team Name',
            'type' => 'text',
            'id' => 'team_description',
            'required' => 'true',
            'autocomplete' => "off",
        ]);
        //echo $this->Form->control('name');
    }
    ?>
</div>
<fieldset>

    <table class="table table-striped">
        <thead>
        <th>Player No.</th>
        <th>Full Name</th>
        <th>Date Of Birth</th>
        <?php if ($weightFlag != null) { ?>
        <th>Weight</th>
        <?php } ?>
        <th>Gender</th>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= $maximum_player_participating; $i++) {
                ?>
            <tr>
                <td>
                        <?php echo $i; ?>
                </td>
                <td>

                    <?php
                        echo $this->Form->input('', [
                            'label' => false,
                            'type' => 'hidden',
                            'id' => 'registration_start_date',
                            'value' => $registration_start_date,
                        ]);
                      
                    
                        echo $this->Form->input('', [
                            'label' => false,
                            'type' => 'hidden',
                            'id' => 'maximum_age',
                            'value' => $maximumage,
                        ]);
                     
                        echo $this->Form->input('', [
                            'label' => false,
                            'type' => 'hidden',
                            'id' => 'minimum_age',
                            'value' => $minimumage,
                        ]);
                       
                          echo $this->Form->input('', [
                            'label' => false,
                            'type' => 'hidden',
                            'id' => 'minimum_player_participating',
                            'value' => $minimum_player_participating,
                        ]);
                        
                        echo $this->Form->input('', [
                            'label' => false,
                            'type' => 'hidden',
                            'id' => 'maximum_player_participating',
                            'value' => $maximum_player_participating,
                        ]);

                        ?>
                        <?php
                        echo $this->Form->input('RegisterCandidate_' . $i . '[full_name]', [
                            'label' => false,
                            'type' => 'text',
                           'id' => 'full_name_' . $i,
                            'autocomplete' => "off",
                        ]);
                        //echo $this->Form->control('name');
                        ?>
                </td>
                <td>
                        <?php
                        echo $this->Form->input('RegisterCandidate_' . $i . '[dob]', ['label' => false,
                            'id' => 'dob_' . $i,
                            //'class' => 'dob',
                            'type' => 'text',
                            'maxlength' => 10,
                            'oninput' => "setCustomValidity('')",
                            'placeholder' => "dd-mm-yyyy", "onkeyup" => "calAge();",
                            //'required' => 'true',
                            'autocomplete' => "off",
                        ]);
                        ?>

                    <p id="validateage"></p>
                </td>
                    <?php
                  
                    if ($weightFlag != null) {
                        ?>
                <td>
                            <?php
                            echo $this->Form->input('RegisterCandidate_' . $i . '[weight]', [
                                'label' => false,
                                'type' => 'number',
                                 'id' => 'weight_' . $i,
                                'min'=> $minimum_weight,
                                'max'=> $maximum_weight,
                            ]);
                            ?>
                </td>
                    <?php } ?>   
                <td>



                        <?php
                        echo $this->Form->input('RegisterCandidate_' . $i . '[gender_list_id]', [
                            'id' => 'gender_list_id_' . $i,
                            'type' => 'select',
                            'label' => false,
                            'empty' => 'Select',
                            'options' => $genderLists]);
                        ?>

                </td>
            </tr>

                <?php
            }
            ?>
    </table>
</fieldset>
<p style="color: red">
    Note: After saving team their is no provision of modifying team. So kindly enter data after confirmation only.

</p>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

<script>
    //             for datepicker
    $(document).ready(function () {
        // alert('sctipy');

        var team_description = "<?php echo $eventActivityListValue->activity_list->game_type_list->description;  ?>";
        // alert(team_description);
        var maximum_weight = "<?php 
                if(isset($weightFlag->maximum_weight)){
                     echo $weightFlag->maximum_weight;
                }
         ?>";
        var minimum_weight = "<?php 
                if(isset($weightFlag->minimum_weight)){
                     echo $weightFlag->minimum_weight;
                }
         ?>";
      


        var d = new Date();
        var year = d.getFullYear() - 10;
        d.setFullYear(year);
        // 'id' => 'dob_' . $i,
        var minimum_player_participating = document.getElementById('minimum_player_participating').value;
        //alert(minimum_player_participating);
        var maximum_player_participating = document.getElementById('maximum_player_participating').value;
        var registration_start_date = document.getElementById('registration_start_date').value;
        var minimum_age = document.getElementById('minimum_age').value;
        var maximum_age = document.getElementById('maximum_age').value;


        var maximum_date = new Date(registration_start_date);
        maximum_date.setFullYear(maximum_date.getFullYear() - minimum_age);


        var mimimum_date = new Date(registration_start_date);
        mimimum_date.setFullYear(mimimum_date.getFullYear() - maximum_age);
        for (var i = 1; i <= minimum_player_participating; i++) {

            $("#dob_" + i).prop('required', true);
            $("#full_name_" + i).prop('required', true);
            $("#gender_list_id_" + i).prop('required', true);
            if (maximum_weight != "" && minimum_weight != "") {
                $("#weight_" + i).prop('required', true);
            }

        }



        for (var i = 1; i <= maximum_player_participating; i++) {
            //alert(i);
            $("#dob_" + i).datepicker({
                dateFormat: 'dd-mm-yy',
                autoPick: false,
                changeMonth: true,
                changeYear: true,
                minDate: mimimum_date,
                maxDate: maximum_date
            });
            // defaultDate: d,
            //  maxYear: d,
            // maxDate: new Date(),
            // yearRange: '1900:2150',

//                onSelect: function () {
//                    var age = getAge(this);
//
//                    //to check given age within range or not
//                    //  var candidateage= document.getElementById('msg').value;
//
//                    //$("#validateage").html(age + ' candidate is eligible');

//alert($("#dob_" + i).val());
////                    alert(minimumage);
////                    alert(maximumage);
////                    alert(age);
//                    //$("#validateage").html(age+ 'candidate is not eligible');
//                    if (age < minimumage)
//                    {
//                        //$("#dob_" + i).val()='';
//                        alert("Entered DOB is less than minimum allowed age.");
//                        return false;
//                        //$("#validateage").html(age+ 'candidate is eligible');
//                    } else if(age > maximumage){
//                        //$("#dob_" + i).val()='';
//                        alert("Entered DOB is greater than maximum allowed age.");
//                         return false;
//                        //alert("Entered DOB is out of range for minimum and maximum allowed age.");
//                    }
//                }
//            });
//        }
//        function calAge() {
//            //alert('cal');
//            //$('.error, .msg').text('');
//            var dob = $("#dob_" + i).val();
//           // alert(dob);
//            $("#dob_" + i).change(function () {
//                //alert('ee');
//                if (dob == '') {
//                    //$('.error').text('Select DOB!');
//                } else {
//                    dobDate = new Date(dob);
//                    nowDate = new Date();
//
//                    var diff = nowDate.getTime() - dobDate.getTime();
//
//                    var ageDate = new Date(diff); // miliseconds from epoch
//                    var age = Math.abs(ageDate.getUTCFullYear() - 1970);
//
//                    //$("#msg").html(age+ ' Years');
//                }
//            });
//        }
//
//        function getAge(dateVal) {
//
//            var birthday = new Date(dateVal.value),
//                    today = new Date(),
//                    ageInMilliseconds = new Date(today - birthday),
//                    years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25),
//                    months = 12 * (years % 1),
//                    days = Math.floor(30 * (months % 1));
//            return Math.floor(years);
//            // return Math.floor(years) + ' years ' + Math.floor(months) + ' months ' + days + ' days';
//
//
        }
    });

</script>