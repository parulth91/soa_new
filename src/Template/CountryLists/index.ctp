<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('country_code'); ?></th>
            <th><?= $this->Paginator->sort('flag_code'); ?></th>
            <th><?= $this->Paginator->sort('telephone_code'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($countryLists as $countryList): ?>
        <tr>
            <td><?= $this->Number->format($countryList->id) ?></td>
            <td><?= h($countryList->description) ?></td>
            <td><?= h($countryList->country_code) ?></td>
            <td><?= h($countryList->flag_code) ?></td>
            <td><?= h($countryList->telephone_code) ?></td>
                        <td><?= $countryList->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($countryList->action_by) ?></td>
            <td><?= h($countryList->created) ?></td>
            <td><?= h($countryList->action_ip) ?></td>
            <td><?= h($countryList->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $countryList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $countryList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $countryList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $countryList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
          <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
      
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>

<div>
    <?php
    echo $this->Form->submit('Add countryLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/countryLists/add') . "'"));
    ?>
</div>