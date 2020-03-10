<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($countryList->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= h($countryList->description) ?></td>
        </tr>
        <tr>
            <td><?= __('Country Code') ?></td>
            <td><?= h($countryList->country_code) ?></td>
        </tr>
        <tr>
            <td><?= __('Flag Code') ?></td>
            <td><?= h($countryList->flag_code) ?></td>
        </tr>
        <tr>
            <td><?= __('Telephone Code') ?></td>
            <td><?= h($countryList->telephone_code) ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($countryList->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($countryList->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($countryList->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($countryList->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($countryList->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $countryList->active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related StateLists') ?></h3>
    </div>
    <?php if (!empty($countryList->state_lists)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('country_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($countryList->state_lists as $stateLists): ?>
                <tr>
                    <td><?= h($stateLists->id) ?></td>
                    <td><?= h($stateLists->description) ?></td>
                    <td><?= h($stateLists->country_list_id) ?></td>
                    <td><?= h($stateLists->active) ?></td>
                    <td><?= h($stateLists->action_by) ?></td>
                    <td><?= h($stateLists->created) ?></td>
                    <td><?= h($stateLists->action_ip) ?></td>
                    <td><?= h($stateLists->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'StateLists', 'action' => 'view', $stateLists->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'StateLists', 'action' => 'edit', $stateLists->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'StateLists', 'action' => 'delete', $stateLists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stateLists->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related StateLists</p>
    <?php endif; ?>
</div>
