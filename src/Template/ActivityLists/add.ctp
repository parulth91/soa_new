<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityList $activityList
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($activityList);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Activity List']) ?></legend>
    <div class="row">
        <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>


        <div class=col-md-2>
                <?php
                echo $this->Form->input('gender_list_id', ['type'=>'select','empty'=>'Select','options' => $genderLists]);
                ?>
        </div>
        <div class=col-md-2>
                <?php
                echo $this->Form->input('age_group_list_id', ['type'=>'select','empty'=>'Select','options' => $ageGroupLists]);
                ?>
        </div>
        <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
    </div>

    <div class="row"> 
        <div class=col-md-2>
                <?php
                echo $this->Form->input('game_type_list_id', ['type'=>'select','empty'=>'Select','options' => $gameTypeLists]);
                ?>
        </div>

        <div class=col-md-4 id="min_playerdiv">
            <?php
            echo $this->Form->control('minimum_player_participating',['label'=>'Minimum player in Team','type'=>"number"]);
            ?>
        </div>
        <div class=col-md-4 id="max_playerdiv">
            <?php
            echo $this->Form->control('maximum_player_participating',['label'=>'Maximum player in Team','type'=>"number"]);
            ?>
        </div>
    </div>

    <dvi class="row">
        <div class=col-md-4>
            <?php
            echo $this->Form->control('is_weight_category');
            ?>
        </div>
        <div class=col-md-4 id="weightcategorydiv">
                <?php
                echo $this->Form->input('weight_category_list_id', ['id'=>'weight_category_field','type'=>'select','empty'=>'Select','options' => $weightCategoryLists]);
                ?>
        </div>
        </div>
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
<script type="text/javascript">
    //             for datepicker

    $(document).ready(function () {
            $("minimum-player-participating").keypress(function(){  
              var maxplayer = document.getElementById("maximum-player-participating").value;
              var minplayer = document.getElementById("minimum-player-participating").value;
              if ($(this).val() > maxplayer){
                $(this).val() == '';
              }
              else{
                $(this).val() == minplayer;
              }
                });


        $("#weightcategorydiv").hide();
        $("#min_playerdiv").hide();
        $("#max_playerdiv").hide();
        $("#is-weight-category").click(function () {
            // alert('hh');
            if ($(this).is(":checked")) {
                $("#weightcategorydiv").show();
            } else {
                $("#weightcategorydiv").hide();
            }
        });
        $("#game-type-list-id").change(function () {

            if ($(this).val() == '')
            {
                //alert('2');    
                $("#min_playerdiv").hide();
                $("#max_playerdiv").hide();

                document.getElementById("maximum-player-participating").defaultValue = "";
                document.getElementById("minimum-player-participating").defaultValue = "";
            }
            if ($(this).val() == '1')// for team
            {
                //alert('2');    
                $("#min_playerdiv").show();
                $("#max_playerdiv").show();
               
                document.getElementById("maximum-player-participating").Value = "";
                document.getElementById("minimum-player-participating").Value = "";
            }
            if ($(this).val() == '2')//for individual
            {
                $("#min_playerdiv").hide();
                $("#max_playerdiv").hide();
                document.getElementById("maximum-player-participating").defaultValue = 1;
                document.getElementById("minimum-player-participating").defaultValue = 1;
               // $("#maximum-player-participating").prop("readonly", true);
               // $("#minimum-player-participating").prop("readonly", true);
               
            }
        });
    });


</script>
