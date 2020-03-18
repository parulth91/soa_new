<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlayerTieSheet $playerTieSheet
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($playerTieSheet);
?>
<fieldset>
    <legend><?= __('Edit {0}', ['Player Tie Sheet']) ?></legend>

      <div class=col-md-2>
                <?php
                echo $this->Form->input('event_activity_list_id', ['type'=>'select','empty'=>'Select','options' => $eventActivityLists]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('round_number');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('round_description');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('player1_score');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('player2_score');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('winner_register_candidate_event_activity_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('match_number');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('player1_register_candidate_event_activity_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('player2_register_candidate_event_activity_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
