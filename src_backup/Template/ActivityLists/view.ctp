<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($activityList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($activityList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Weight Category List') ?></td>
            <td><?= $activityList->has('weight_category_list') ? $this->Html->link($activityList->weight_category_list->description, ['controller' => 'WeightCategoryLists', 'action' => 'view', $activityList->weight_category_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($activityList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Gender List') ?></td>
            <td><?= $activityList->has('gender_list') ? $this->Html->link($activityList->gender_list->description, ['controller' => 'GenderLists', 'action' => 'view', $activityList->gender_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Game Types List') ?></td>
            <td><?= $activityList->has('game_types_list') ? $this->Html->link($activityList->game_types_list->description, ['controller' => 'GameTypesLists', 'action' => 'view', $activityList->game_types_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Age Group List') ?></td>
            <td><?= $activityList->has('age_group_list') ? $this->Html->link($activityList->age_group_list->description, ['controller' => 'AgeGroupLists', 'action' => 'view', $activityList->age_group_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($activityList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Minimum Player Participating') ?></td>
            <td><?= $this->Number->format($activityList->minimum_player_participating) ?></td>
        </tr>
        <tr>
            <td><?= __('Maximum Player Participating') ?></td>
            <td><?= $this->Number->format($activityList->maximum_player_participating) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($activityList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($activityList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($activityList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Weight Category') ?></td>
            <td><?= $activityList->is_weight_category ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Is Active') ?></td>
            <td><?= $activityList->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

