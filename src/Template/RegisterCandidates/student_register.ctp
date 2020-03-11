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
<?php foreach ($eventActivityLists as $eventActivityListValue) { ?>
    <div class = "pen-title">
        <h3 align = "center">Registration for <?php echo $eventActivityListValue->event_list->description; //die;              
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
                        <?php echo $eventActivityListValue->activity_list->weight_category_list->minimum_weight; ?>
                    </th>
                    <th id="weightmaxlabel">
                        <?php echo $eventActivityListValue->activity_list->weight_category_list->maximum_weight; ?>
                    </th>
                <?php } ?>
                <th>
                    <?php echo $eventActivityListValue->activity_list->age_group_list->minimum_age; ?>
                </th>
                <th>
                    <?php echo $eventActivityListValue->activity_list->age_group_list->maximum_age; ?>
                </th>          
                <th>
                    <?php echo $eventActivityListValue->activity_list->minimum_player_participating; ?>
                </th>          
                <th>
                    <?php echo $maximum_player_participating = $eventActivityListValue->activity_list->maximum_player_participating; ?>
                </th>          
            </tr>

        </tbody>
        <?php
        //debug($eventActivityListValue); 
    }
    ?>
</table>
<fieldset>
    <legend><?= __('Add {0}', ['Register Candidate For Event Activity']) ?></legend>
    <table class="table table-striped">
        <thead>
        <th>Sln.no</th>
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
                            'id' => 'maximum_player_participating',
                            'value' => $maximum_player_participating,
                        ]);
                        //echo $this->Form->control('name');
                        ?>
                        <?php
                        echo $this->Form->input('full_name[]', [
                            'label' => false,
                            'type' => 'text',
                            'id' => 'full_name',
                            'required' => 'true',
                            'autocomplete' => "off",
                        ]);
                        //echo $this->Form->control('name');
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('dob[]', ['label' => false,
                            'id' => 'dob_' . $i,
                            //'class' => 'dob',
                            'type' => 'text',
                            'maxlength' => 10,
                            'oninput' => "setCustomValidity('')",
                            'placeholder' => "dd-mm-yyyy", "onkeyup" => "return validateDate(this);",
                            'required' => 'true',
                            'autocomplete' => "off",
                        ]);
                        ?>
                    </td>
                    <?php
                    if ($weightFlag != null) {
                        ?>
                        <td>
                            <?php
                            echo $this->Form->input('weight[]', [
                                'label' => false,
                                'type' => 'integer',
                                'id' => 'weight',
                            ]);
                            ?>
                        </td>
                    <?php } ?>   
                    <td>

                        <?php
                        if ($genderValue == 'Neutral') {
                            ?>

                            <?php
                            echo $this->Form->input('gender_list_id[]', [
                                'type' => 'select',
                                'label' => false,
                                'empty' => 'Select',
                                'options' => $genderLists]);
                            ?>

                            <?php
                        } else {

                            echo $genderValue;
                        }
                        ?>
                    </td>
                </tr>

                <?php
            }
            ?>
    </table>
</fieldset>
<?= $this->Form->button(__("Save")); ?>
<?= $this->Form->end() ?>

<script>
    //             for datepicker
    $(document).ready(function () {

        var d = new Date();
        var year = d.getFullYear() - 18;
        d.setFullYear(year);
      // 'id' => 'dob_' . $i,
        var maximum_player_participating = document.getElementById('maximum_player_participating').value;
        for (var i = 1; i <= maximum_player_participating; i++) {
            //alert(i);
            $("#dob_"+i).datepicker({
                dateFormat: 'dd-mm-yy',
                autoPick: false,
                changeMonth: true,
                changeYear: true,
                defaultDate: d,
                maxYear: d,
                maxDate: new Date(2019, 5, 30),
                yearRange: "c-60:c+19"
            });
        }
        


    });
</script>
