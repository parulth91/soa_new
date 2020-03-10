<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('maximum_weight'); ?></th>
            <th><?= $this->Paginator->sort('minimum_weight'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($weightCategoryLists as $weightCategoryList): ?>
        <tr>
            <td><?= $this->Number->format($weightCategoryList->id) ?></td>
            <td><?= h($weightCategoryList->description) ?></td>
                        <td><?= $weightCategoryList->is_active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($weightCategoryList->action_by) ?></td>
            <td><?= h($weightCategoryList->created) ?></td>
            <td><?= h($weightCategoryList->action_ip) ?></td>
            <td><?= h($weightCategoryList->modified) ?></td>
            <td><?= $this->Number->format($weightCategoryList->maximum_weight) ?></td>
            <td><?= $this->Number->format($weightCategoryList->minimum_weight) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $weightCategoryList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $weightCategoryList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $weightCategoryList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weightCategoryList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add weightCategoryLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/weightCategoryLists/add') . "'"));
    ?>
</div>