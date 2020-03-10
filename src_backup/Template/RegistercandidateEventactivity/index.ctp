<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('registration_id'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('weight'); ?></th>
            <th><?= $this->Paginator->sort('age'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registercandidateEventactivity as $registercandidateEventactivity): ?>
        <tr>
            <td><?= $this->Number->format($registercandidateEventactivity->registration_id) ?></td>
            <td>
                <?= $registercandidateEventactivity->has('event_activity_list') ? $this->Html->link($registercandidateEventactivity->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $registercandidateEventactivity->event_activity_list->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($registercandidateEventactivity->weight) ?></td>
            <td><?= $this->Number->format($registercandidateEventactivity->age) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $registercandidateEventactivity->registration_id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $registercandidateEventactivity->registration_id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $registercandidateEventactivity->registration_id], ['confirm' => __('Are you sure you want to delete # {0}?', $registercandidateEventactivity->registration_id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add registercandidateEventactivity', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/registercandidateEventactivity/add') . "'"));
    ?>
</div>