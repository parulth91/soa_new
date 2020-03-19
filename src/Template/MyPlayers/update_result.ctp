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
                    Player 1
                </th>
                <th>
                    Player 2
                </th>
                <th>
                    Player 1 score
                </th>
                <th>
                    Player 2 score
                </th>
                <th>
                    Winner Player
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo h($playerTieSheet->event_activity_list->description); ?>
                </td>
                <td>
                    <?php echo h($playerTieSheet->round_description); ?>
                </td>
                <td>
                    <?php echo h($playerTieSheet->match_number); ?>
                </td>
                <td>
                    <?php echo h($playerTieSheet->player1->full_name); ?>(
                    <?php echo h($playerTieSheet->player1->registration_number); ?>)
                </td>
                <td>
                    <?php echo h($playerTieSheet->player2->full_name); ?>(
                    <?php echo h($playerTieSheet->player2->registration_number); ?>)
                </td>
                <td>
                    <?php
                    echo $this->Form->control('player1_score',['label'=>false]);
                    ?>
                </td>
                <td>
                    <?php
                   echo $this->Form->control('player2_score',['label'=>false]);
                    ?>
                </td>
                <td>
                    <?php 
                    if(!empty($playerTieSheet->winner_player)){
                    echo h($playerTieSheet->winner_player->full_name); 
                    echo '('.h($playerTieSheet->winner_player->registration_number).')'; 
                    }else{
                        echo "Result Awaited";
                    }
                    //debug($playerTieSheet);
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
