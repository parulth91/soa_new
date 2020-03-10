<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('point_assigned'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($msGenders as $msGender): ?>
        <tr>
            <td><?= $this->Number->format($msGender->id) ?></td>
            <td><?= h($msGender->description) ?></td>
            <td><?= $this->Number->format($msGender->point_assigned) ?></td>
                        <td><?= $msGender->is_active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($msGender->action_by) ?></td>
            <td><?= h($msGender->created) ?></td>
            <td><?= h($msGender->modified) ?></td>
            <td><?= h($msGender->action_ip) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $msGender->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $msGender->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $msGender->id], ['confirm' => __('Are you sure you want to delete # {0}?', $msGender->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add msGenders', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/msGenders/add') . "'"));
    ?>
</div>