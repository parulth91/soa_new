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

<!-- Mixins-->
<!-- Pen Title-->
<div class="pen-title">
    <h3 align="center">Registration for <?php print_r($Result[0]['event_list']->description); //die;             ?> 
    </h3>
</div>

<div class="container">
    <legend><?= __d('CakeDC/Users', '') ?></legend>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Gender</th>
                <th id="weightminlabel">Minimum Weight</th>
                <th id="weightmaxlabel">Maximum Weight</th>
                <th>Minimum Age</th>
                <th>Maximum Age</th>
                <th>Maximum No. Of Players</th>          
            </tr>
        </thead>
        <tbody>
            <?php
            // echo $created;
            foreach ($Result as $List) {
                $genderkey = $List['activity_list']['gender_list']['id'];
                $genderValue = $List['activity_list']['gender_list']['description'];
                $weightkey = $List['activity_list']['weight_category_list']['id'];
                $minweightvalue = $List['activity_list']['weight_category_list']['minimum_weight'];
                $maxweightvalue = $List['activity_list']['weight_category_list']['maximum_weight'];
                $agegroupkey = $List['activity_list']['age_group_list']['id'];
                $minagegroupvalue = $List['activity_list']['age_group_list']['minimum_age'];
                $maxagegroupvalue = $List['activity_list']['age_group_list']['maximum_age'];
                $minnoofplayers = $List['activity_list']['minimum_player_participating'];
                $maxNoOfPlayers = $List['activity_list']['maximum_player_participating'];
            }
            ?>
            <tr>
                <td>      
                    <?php
                    echo $this->Form->input('Gender', [
                        'label' => '',
                        'type' => 'text',
                        'id' => 'genderval',
                        'value' => [$genderValue],
                        'disabled' => true]);
                    ?>                       
                </td> 
                <td id="weightdiv">          
                    <?php
                    echo $this->Form->control('Minimum', ['label' => '',
                        'type' => 'text',
                        'id' => 'minweightcategory',
                        'value' => $minweightvalue,
                        'disabled' => true]);
                    ?>
                </td> 
                <td id="weightdiv1">
                    <?php
                    echo $this->Form->control('Maximum', ['label' => '',
                        'type' => 'text',
                        'id' => 'maxweightcategory',
                        'value' => $maxweightvalue,
                        'disabled' => true]);
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('Minimum', ['label' => '',
                        'type' => 'text',
                        'id' => 'minagegroup',
                        'value' => $minagegroupvalue,
                        'disabled' => true]);
                    ?>
                </td>   
                <td>          
                    <?php
                    echo $this->Form->control('Maximum', ['label' => '',
                        'type' => 'text',
                        'id' => 'maxagegroup',
                        'value' => $maxagegroupvalue,
                        'disabled' => true]);
                    ?>
                </td>   
                <td>
                    <?php
                    echo $this->Form->control('maximum', ['label' => '',
                        'type' => 'text',
                        'id' => 'maxnoplayers',
                        'value' => $maxNoOfPlayers,
                        'disabled' => true]);
                    ?>
                </td>           
            </tr> 
        </tbody> 
    </table>          
</div>
<span></span>
<?php
echo $this->Form->create('submit_form', ['id' => 'submit_form', 'type' => 'post']);
$this->Form->unlockField('first_name');
$this->Form->unlockField('last_name');
$this->Form->unlockField('gender');
$this->Form->unlockField('weight');
$this->Form->unlockField('age');
$this->Form->unlockField('created');
$this->Form->unlockField('action_by');
$this->Form->unlockField('action_by_ip');
$this->Form->unlockField('event_activity_list_id');
$this->Form->unlockField('modified');
$this->Form->unlockField('registration_id');
?>
<fieldset>
    <legend><?= __('Add {0}', ['Register Candidate For Event Activity']) ?></legend>
    <table class="table table-striped">
        <thead>
        <th>
            Sln.no
        </th>
        <th>
            Name
        </th>
        <th>
            Date Of Birth
        </th>
        <th>
            Weight
        </th>
        <th>
            Gender
        </th>
        </thead>
        <tbody>


            <?php for ($i = 1; $i <= $maxNoOfPlayers; $i++) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo $i;
                        ?>
                        </div>
                    <td>
                        <?php
                        echo $this->Form->input('name[]', [
                            'label' => '',
                            'type' => 'text',
                            'id' => 'name',
                        ]);
                        //echo $this->Form->control('name');
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('dob[]', [
                            'label' => '',
                            'type' => 'date',
                            'id' => 'dob',
                        ]);
                        //echo $this->Form->control('dob');
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Form->input('weight[]', [
                            'label' => '',
                            'type' => 'integer',
                            'id' => 'weight',
                        ]);
                        ?>
                    </td>

                    <td>

                        <?php
                        if ($genderValue == 'Neutral') {
                            ?>

                            <?php
                            echo $this->Form->input('gender_list_id[]', ['type' => 'select', 'empty' => 'Select', 'options' => $genderLists]);
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

        </tbody>
    </table>
</fieldset>

<div class="row" style="text-align:center;">
    <button class="btn btn-primary" id="add_button_id">Add New Candidate</button>
</div>

<div class="row">
    <div class="row" id="students_details_add">
    </div>
</div>
<div class="row" style="text-align:center;">
    <?= $this->Form->button("Submit", ['class' => 'btn btn-primary', 'id' => 'submit_button', 'name' => 'submit_button']); ?>
    <?= $this->Form->button("Submit all", ['class' => 'btn btn-primary', 'id' => 'submit_buttonall', 'name' => 'submit_buttonall']); ?>
</div>
<?= $this->Form->end() ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit_button').hide();
        $('#submit_buttonall').hide();
        $('#studentsdetailsadd').hide();
        $("#addbutton").click(function (e) {
            $('#studentsdetailsadd').show();
        })
        var minweight = document.getElementById('minweightcategory').value;
        var maxweight = document.getElementById('maxweightcategory').value;
        if (document.getElementById('minweightcategory').value == '' &&
                document.getElementById('maxweightcategory').value == '')
        {
            $('#weightdiv').hide();
            $('#weightdiv1').hide();
            $('#weightminlabel').hide();
            $('#weightmaxlabel').hide();
        }
    });
    /******************for new candidate registration by adding fields whenever click on adding new candidate button according to maximum no of players times****************************************************/
    var max_fields = document.getElementById('maxnoplayers').value; //maximum input boxes allowed
    var wrapper = $("#students_details_add");  //Fields wrapper
    var add_button = $("#add_button_id"); //Add button ID
    var x = 0; //initlal text box count
    $(add_button).click(function (e) {
        //on add input button click
        e.preventDefault();
        if (max_fields == 1 || max_fields == '')
        {
            alert('thifg');
            $('#studentsdetailsadd').prop('disabled', true);
            $('#add_button_id').prop('disabled', true)
            $('#submit_button').show();
            $('#submit_buttonall').hide();
        }
        if (x < max_fields) { //max input box allowed
            x++;
            if (x > 1)
            {
                $('#submit_button').hide();
                $('#submit_buttonall').show();
            } else {
                $('#submit_button').show();
                $('#submit_buttonall').hide();
            }
            //text box increment
            $(wrapper).append(
                    '<br/><div class=col-md-3><?=
$this->Form->input('first_name[]', ['type' => 'text',
    'label' => false,
    'placeholder' => 'First Name',
    'required' => true
        ]
)
?></div>'
                    ); //add input box
            $(wrapper).append('<div class=col-md-3><?=
$this->Form->input('last_name[]', ['type' => 'text',
    'label' => false,
    'placeholder' => 'Last Name',
    'required' => true]
)
?></div>'
                    );
            if (document.getElementById('minweightcategory').value != '' &&
                    document.getElementById('maxweightcategory').value != '')
            {
                var minweight = document.getElementById('minweightcategory').value;
                var maxweight = document.getElementById('maxweightcategory').value;
                $(wrapper).append('<div class=col-md-2><?=
$this->Form->input('weight[]', [
    'type' => 'number',
    'label' => false,
    'placeholder' => 'Weight',
    'required' => true
])
?> </div>');
            }
            $(wrapper).append('<div class=col-md-2><?=
$this->Form->input('age[]', [
    'type' => 'number',
    'label' => false, 'placeholder' => 'Age', 'required' => true
])
?></div>');

            $(wrapper).append(' <div class=col-md-2><?=
$this->Form->input('gender[]', array('empty' => 'Select',
    'label' => false,
    'placeholder' => 'Gender',
    'options' => array('1' => 'Male', '2' => 'Female', '3' => 'Neutral')
        )
);
?></div>');

            $(wrapper).append('<div class=col-md-2>  <?=
$this->Form->input('created[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => $created])
?></div>');

            $(wrapper).append(' <div class=col-md-2>  <?=
$this->Form->input('modified[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => $modified])
?></div>');

            $(wrapper).append('<div class=col-md-2> <?=
$this->Form->input('action_by[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => $action_by])
?></div>');

            $(wrapper).append(' <div class=col-md-2>  <?=
$this->Form->input('action_by_ip[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => $action_by_ip])
?></div>');

            $(wrapper).append('<div class=col-md-2> <?=
$this->Form->input('registration_id[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => rand(10, 100)])
?></div>');

            $(wrapper).append(' <div class=col-md-2><?=
$this->Form->input('event_activity_list_id[]', [
    'type' => 'hidden',
    'label' => false,
    'value' => $eventactid])
?></div>');

        }
        //********************************* to check min & max weight***********************************/                     
        var minweight = document.getElementById('minweightcategory').value;
        // alert(minweight);
        var maxweight = document.getElementById('maxweightcategory').value;
        $(function () {
            $("#weight").change(function () {
                // var max = parseInt($(this).attr('max'));
                // var min = parseInt($(this).attr('min'));
                if ($(this).val() > maxweight)
                {
                    $(this).val(maxweight);
                } else if ($(this).val() < minweight)
                {
                    $(this).val(minweight);
                }

            });
        });
        //********************************* to check min & max age***********************************/                     
        var minage = document.getElementById('minagegroup').value;
        var maxage = document.getElementById('maxagegroup').value;
        if (document.getElementById('minagegroup').value != '' && document.getElementById('maxagegroup').value != '') {
            $(function () {
                $("#age").change(function () {
                    // var max = parseInt($(this).attr('max'));
                    // var min = parseInt($(this).attr('min'));
                    if ($(this).val() > maxage)
                    {
                        $(this).val(maxage);
                    } else if ($(this).val() < minage)
                    {
                        $(this).val(minage);
                    }

                });
            });
        }
        //********************************* to check gender***********************************/                     

        var gendertextval = document.getElementById('genderval').value;
        // alert(gendertextval);
        $(function () {
            $("#gender").change(function () {
                var selectedText = $("#gender option:selected").html();
                // alert(selectedText);
                if (genderselval != gendertextval)
                {
                    $(".students_details_add").hide();
                    $("#submit_button").hide();
                    //     $('span').color("red");
                    $('span').text('only ' + gendertextval + ' candidate is allowed to register.');
                    // alert("only." +.gendertextval.+ "is allowed to register")
                }
            });

        });
    });

//*ends - number range validation

</script>
