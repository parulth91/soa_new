<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>S.NO </th>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('registration_number'); ?></th>
            <th><?= $this->Paginator->sort('full_name'); ?></th>
            <th><?= $this->Paginator->sort('event_activity_list_id'); ?></th>
            <th><?= $this->Paginator->sort('weight'); ?></th>
            <th><?= $this->Paginator->sort('age'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php  $i=1;
        foreach ($registerCandidateEventActivities as $registerCandidateEventActivity): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->id) ?></td>
            <td><?= h($registerCandidateEventActivity->registration_number) ?></td>
            <td><?= h($registerCandidateEventActivity->full_name) ?></td>
            <td>
                <?= $registerCandidateEventActivity->has('event_activity_list') ? $this->Html->link($registerCandidateEventActivity->event_activity_list->description, ['controller' => 'EventActivityLists', 'action' => 'view', $registerCandidateEventActivity->event_activity_list->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($registerCandidateEventActivity->weight) ?></td>
            <td><?= $this->Number->format($registerCandidateEventActivity->age) ?></td>
                        <td><?= $registerCandidateEventActivity->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($registerCandidateEventActivity->action_by) ?></td>
            <td><?= h($registerCandidateEventActivity->created) ?></td>
            <td><?= h($registerCandidateEventActivity->action_ip) ?></td>
            <td><?= h($registerCandidateEventActivity->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $registerCandidateEventActivity->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $registerCandidateEventActivity->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $registerCandidateEventActivity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $registerCandidateEventActivity->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>
        </tr>
        <?php $i++;
    endforeach; ?>
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
   // echo $this->Form->submit('Add registerCandidateEventActivities', array('type' => 'button',
   //     'class' => 'btn  btn-info',
      //  'onclick' => "location.href='" . $this->Url->build('/registerCandidateEventActivities/add') . "'"));
    ?>
</div>