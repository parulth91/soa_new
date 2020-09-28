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

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2 id="min_playerdiv">
            <?php
            echo $this->Form->control('minimum_player_participating');
            ?>
        </div>
                <div class=col-md-2 id="max_playerdiv">
            <?php
            echo $this->Form->control('maximum_player_participating');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('is_weight_category');
            ?>
        </div>
          <div class=col-md-2 id="weightcategorydiv">
                <?php
                echo $this->Form->input('weight_category_list_id', ['id'=>'weight_category_field','type'=>'select','empty'=>'Select','options' => $weightCategoryLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('gender_list_id', ['type'=>'select','empty'=>'Select','options' => $genderLists]);
                ?>
            </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('game_type_list_id', ['type'=>'select','empty'=>'Select','options' => $gameTypeLists]);
                ?>
            </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('age_group_list_id', ['type'=>'select','empty'=>'Select','options' => $ageGroupLists]);
                ?>
            </div>
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
<script type="text/javascript">
    //             for datepicker
  
    $(document).ready(function () {
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
 $("#game-type-list-id").change(function() {

        if ($(this).val() == '1')
        {
            //alert('2');    
                $("#min_playerdiv").show();
                $("#max_playerdiv").show();
                $("#maximum-player-participating").prop("readonly", false); 
                $("#minimum-player-participating").prop("readonly", false); 
                document.getElementById("maximum-player-participating").defaultValue = "";
                document.getElementById("minimum-player-participating").defaultValue = "";
        }
        if ($(this).val() == '2')
        {
                $("#min_playerdiv").show();
                $("#max_playerdiv").show();
                $("#maximum-player-participating").prop("readonly", true); 
                $("#minimum-player-participating").prop("readonly", true); 
                document.getElementById("maximum-player-participating").defaultValue = "1";
                document.getElementById("minimum-player-participating").defaultValue = "1";
        }
});
});
  

</script>
