<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlayerTieSheet $teamTieSheet
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($teamTieSheet);
?>
<fieldset>
    <legend><?= __('Update {0}', ['Match Result']) ?></legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Event Activity Name
                </th>
                <th>
                    Round Name
                </th>
                <th>
                    Match Number
                </th>
                <th>
                    Team 1
                </th>
                <th>
                    Team 2
                </th>
                <th>
                    Team 1 score
                </th>
                <th>
                    Team 2 score
                </th>
                <th>
                    Winner Team
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo h($teamTieSheet->event_activity_list->description); ?>
                </td>
                <td>
                    <?php echo h($teamTieSheet->round_description); ?>
                </td>
                <td>
                    <?php echo h($teamTieSheet->match_number); ?>
                </td>
                <td>
                    <?php echo h($teamTieSheet->team1_event_team_detail->description); ?>
                </td>
                <td>
                    <?php echo h($teamTieSheet->team2_event_team_detail->description); ?>
                </td>
                <td>
                    <?php
                            echo $this->Form->input('team1_score', [
                                'label' => false,
                                'type' => 'number',
                                 'id' => 'team1_score',
                                'min'=> 0
                            ]);
                            ?>
                 
                </td>
                <td>
                     <?php
                            echo $this->Form->input('team2_score', [
                                'label' => false,
                                'type' => 'number',
                                 'id' => 'team2_score',
                                'min'=> 0
                            ]);
                            ?>
                    
                </td>
                <td>
                    <?php
                    if (!empty($teamTieSheet->winner_event_team_detail)) {
                        echo h($teamTieSheet->winner_event_team_detail->description);
                    } else {
                        echo "Result Awaited";
                    }
                    //debug($teamTieSheet);
                    ?>
                </td>
            </tr>

        </tbody>
    </table>


</fieldset>
<?=
$this->Form->button(__("Save"));
?>
<?= $this->Form->end() ?>
