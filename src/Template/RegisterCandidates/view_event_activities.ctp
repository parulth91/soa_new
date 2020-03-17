<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('S.N.O'); ?></th>
            <th><?= $this->Paginator->sort('Event'); ?></th>
            <th><?= $this->Paginator->sort('Activity'); ?></th>
            <th><?= $this->Paginator->sort('Game type'); ?></th>
            <th><?= $this->Paginator->sort('Event Start Date'); ?></th>
            <th><?= $this->Paginator->sort('Event End Date'); ?></th>
            <th><?= $this->Paginator->sort('Registration Start Date'); ?></th>
            <th><?= $this->Paginator->sort('Registration End Date'); ?></th>

            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($nameResult as $List):
            //debug($List);
            ?>
            <tr>
                <td><?= $this->Number->format($List->id) ?></td>
                <td><?= h($List['event_list']['description']) ?></td>
                <td><?= h($List['activity_list']['description']) ?></td>
                <td><?= h($List['activity_list']['game_type_list']['description']) ?></td>
                <td><?= h($List['event_list']['event_start_date']) ?></td>
                <td><?= h($List['event_list']['event_end_date']) ?></td>
                <td><?= h($List['event_list']['registration_start_date']) ?></td>
                <td><?= h($List['event_list']['registration_end_date']) ?></td>





                <td class="actions">

                    <?= $this->Html->link('Register', ['controller' => 'RegisterCandidates', 'action' => 'eventActivitiesStudentRegister', $List->id], ['Register Now', 'type' => 'button', 'class' => 'btn  btn-info']) ?>
                    <?= $this->Html->link('Attendance', ['action' => 'eventActivtiesAttendance', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-warning']) ?>
                    <?= $this->Html->link('Tie Sheet', ['controller' => 'TieSheets', 'action' => 'tieSheet', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-danger']) ?>
                    <?= $this->Html->link('Result', ['action' => 'result', $List->id], ['Mark Atendance', 'type' => 'button', 'class' => 'btn  btn-success']) ?>

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
    // echo $this->Form->submit('Add weightCategoryLists', array('type' => 'button',
    //     'class' => 'btn  btn-info',
    //    'onclick' => "location.href='" . $this->Url->build('/weightCategoryLists/add') . "'"));
    ?>
</div>