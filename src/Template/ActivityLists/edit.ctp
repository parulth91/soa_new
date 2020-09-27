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
    <legend><?= __('Edit {0}', ['Activity List']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('minimum_player_participating');
            ?>
        </div>
                <div class=col-md-2>
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
                echo $this->Form->input('weight_category_list_id', ['type'=>'select','empty'=>'Select','options' => $weightCategoryLists]);
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
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
<script type="text/javascript">
    //             for datepicker
  
    $(document).ready(function () {
        //alert('in');
     //   $("#weightcategorydiv").hide();
        $("#is-weight-category").click(function () {
           // alert('hh');
            if ($(this).is(":checked")) {
                $("#weightcategorydiv").show();
            } else {
                $("#weightcategorydiv").hide();
            }
        });
    });

</script>