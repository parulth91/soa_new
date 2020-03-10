<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($stateList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($stateList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Country List') ?></td>
            <td><?= $stateList->has('country_list') ? $this->Html->link($stateList->country_list->description, ['controller' => 'CountryLists', 'action' => 'view', $stateList->country_list->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($stateList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($stateList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($stateList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($stateList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($stateList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Active') ?></td>
            <td><?= $stateList->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related DistrictLists') ?></h3>
    </div>
    <?php if (!empty($stateList->district_lists)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('state_list_id'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($stateList->district_lists as $districtLists): ?>
                <tr>
                    <td><?= h($districtLists->id) ?></td>
                    <td><?= h($districtLists->description) ?></td>
                    <td><?= h($districtLists->state_list_id) ?></td>
                    <td><?= h($districtLists->is_active) ?></td>
                    <td><?= h($districtLists->action_by) ?></td>
                    <td><?= h($districtLists->created) ?></td>
                    <td><?= h($districtLists->action_ip) ?></td>
                    <td><?= h($districtLists->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'DistrictLists', 'action' => 'view', $districtLists->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'DistrictLists', 'action' => 'edit', $districtLists->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'DistrictLists', 'action' => 'delete', $districtLists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districtLists->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related DistrictLists</p>
    <?php endif; ?>
</div>
