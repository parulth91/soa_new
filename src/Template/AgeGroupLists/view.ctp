<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($ageGroupList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($ageGroupList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($ageGroupList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($ageGroupList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Minimum Age') ?></td>
            <td><?= $this->Number->format($ageGroupList->minimum_age) ?></td>
        </tr>
        <tr>
            <td><?= __('Maximum Age') ?></td>
            <td><?= $this->Number->format($ageGroupList->maximum_age) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($ageGroupList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($ageGroupList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($ageGroupList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $ageGroupList->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related ActivityLists') ?></h3>
    </div>
    <?php if (!empty($ageGroupList->activity_lists)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('minimum_player_participating'); ?></th>
            <th><?= $this->Paginator->sort('maximum_player_participating'); ?></th>
            <th><?= $this->Paginator->sort('is_weight_category'); ?></th>
            <th><?= $this->Paginator->sort('weight_category_list_id'); ?></th>
            <th><?= $this->Paginator->sort('iactive'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('gender_list_id'); ?></th>
            <th><?= $this->Paginator->sort('game_types_lists_id'); ?></th>
            <th><?= $this->Paginator->sort('age_group_list_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($ageGroupList->activity_lists as $activityLists): ?>
                <tr>
                    <td><?= h($activityLists->id) ?></td>
                    <td><?= h($activityLists->description) ?></td>
                    <td><?= h($activityLists->minimum_player_participating) ?></td>
                    <td><?= h($activityLists->maximum_player_participating) ?></td>
                    <td><?= h($activityLists->is_weight_category) ?></td>
                    <td><?= h($activityLists->weight_category_list_id) ?></td>
                    <td><?= h($activityLists->iactive) ?></td>
                    <td><?= h($activityLists->action_by) ?></td>
                    <td><?= h($activityLists->created) ?></td>
                    <td><?= h($activityLists->action_ip) ?></td>
                    <td><?= h($activityLists->modified) ?></td>
                    <td><?= h($activityLists->gender_list_id) ?></td>
                    <td><?= h($activityLists->game_types_lists_id) ?></td>
                    <td><?= h($activityLists->age_group_list_id) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'ActivityLists', 'action' => 'view', $activityLists->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'ActivityLists', 'action' => 'edit', $activityLists->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'ActivityLists', 'action' => 'delete', $activityLists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityLists->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related ActivityLists</p>
    <?php endif; ?>
</div>
