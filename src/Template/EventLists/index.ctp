<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('event_year'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('registration_start_date'); ?></th>
            <th><?= $this->Paginator->sort('registration_end_date'); ?></th>
            <th><?= $this->Paginator->sort('event_start_date'); ?></th>
            <th><?= $this->Paginator->sort('event_end_date'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventLists as $eventList): ?>
            <tr>
                <td><?= $this->Number->format($eventList->event_year) ?></td>
                <td><?= h($eventList->description) ?></td>
                <td><?= h($eventList->registration_start_date) ?></td>
                <td><?= h($eventList->registration_end_date) ?></td>
                <td><?= h($eventList->event_start_date) ?></td>
                <td><?= h($eventList->event_end_date) ?></td>
                <td><?= $eventList->active ? __('Yes') : __('No'); ?></td>
                <td><?= $this->Number->format($eventList->action_by) ?></td>
                <td><?= h($eventList->created) ?></td>
                <td><?= h($eventList->action_ip) ?></td>
                <td><?= h($eventList->modified) ?></td>
                <td><?= $this->Number->format($eventList->id) ?></td>
                <td class="actions"> <?= $this->Html->link('Attendance', ['action' => 'eventActivtiesAttendance', $eventList->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-warning']) ?>
                    <?= $this->Html->link('Tie Sheet', ['action' => 'tieSheet', $eventList->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-danger']) ?>
                    <?= $this->Html->link('Result', ['action' => 'result', $eventList->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-success']) ?>
                    <?= $this->Html->link('', ['action' => 'view', $eventList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $eventList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', $eventList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $eventList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add eventLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/eventLists/add') . "'"));
    ?>
</div>