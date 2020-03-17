<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TeamTieSheet $teamTieSheet
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($teamTieSheet);
?>
<fieldset>
    <legend><?= __('Add {0}', ['Team Tie Sheet']) ?></legend>

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
            echo $this->Form->control('match_number');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('team1_event_team_detail_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('team2_event_team_detail_id');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('team1_score');
            ?>
        </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('team2_score');
            ?>
        </div>
          <div class=col-md-2>
                <?php
                echo $this->Form->input('winner_team_detail_id', ['type'=>'select','empty'=>'Select','options' => $eventTeamDetails]);
                ?>
            </div>
                <div class=col-md-2>
            <?php
            echo $this->Form->control('active');
            ?>
        </div>
            
</fieldset>
<?=
    $this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
