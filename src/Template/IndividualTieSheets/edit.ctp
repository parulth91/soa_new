<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IndividualTieSheet $individualTieSheet
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($individualTieSheet);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Individual Tie Sheet']) ?></legend>

            <div class=col-md-2>
            <?php
            echo $this->Form->control('register_candidate_event_activity_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('opponent_register_candidate_event_activity_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('match_number');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('winner_register_candidate_event_activity_id', ['type'=>'select','empty'=>'Select','options' => $registerCandidateEventActivities]);
                ?>
            </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('event_activity_list_id', ['type'=>'select','empty'=>'Select','options' => $eventActivityLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('result_status_list_id');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
