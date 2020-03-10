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
                <div class="form-group row">
                        <div class=col-md-2>
                        <?php
                        echo $this->Form->control('description');
                        ?>
                    </div>
               </div>    
                   <div class="form-group row">          
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
                    </div>  
                  <div class="form-group row">
                      <div class=col-md-2 >
                        <?php
                        echo $this->Form->control('is_weight_category');
                        ?>
                      </div>

                       <div class=col-md-2 id="weight-div">
                            <?php
                            echo $this->Form->input('minimum_weight', ['type'=>'select','empty'=>'Select','options' => $weightCategoryLists1]);
                            ?>
                        </div>
                        <div class=col-md-2 id="weight-div1">
                            <?php
                            echo $this->Form->input('maximum_weight', ['type'=>'select','empty'=>'Select','options' => $weightCategoryLists]);
                            ?>
                        </div>
                  </div>    
                  <div class="form-group row">  
                       <div class=col-md-2>
                            <?php
                            echo $this->Form->input('gender_list_id', ['type'=>'select','empty'=>'Select','options' => $genderLists]);
                            ?>
                        </div>
                       <div class=col-md-2>
                            <?php
                            echo $this->Form->input('game_types_lists_id', ['type'=>'select','empty'=>'Select','options' => $gameTypesLists]);
                            ?>
                        </div>
                  </div> 
                       <div class=col-md-2>
                            <?php
                            echo $this->Form->input('minimum_age', ['type'=>'select','empty'=>'Select','options' => $ageGroupLists1]);
                            ?>
                        </div>
                        <div class=col-md-2>
                            <?php
                            echo $this->Form->input('maximum_age', ['type'=>'select','empty'=>'Select','options' => $ageGroupLists]);
                            ?>
                        </div>
                        <br/>
                       <div class="form-group row">
                              <div class=col-md-2>
                                 <?php
                                     echo $this->Form->control('is_active'); ?>
                             </div> 
                       </div>    
     </fieldset>
<div align="center">
<?=
    $this->Form->button("Add",['class'=>'btn btn-primary']);
?>
    </div>
<?= $this->Form->end() ?>

<script type="text/javascript">
    alert('sds');
    $('#weight-div').hide();
      $('#weight-div1').hide();
   $("#is-weight-category"). click(function(){
        $('#weight-div').show();
        $('#weight-div1').show();
    });
</script>