<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>S.NO </th>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('minimum_player_participating'); ?></th>
            <th><?= $this->Paginator->sort('maximum_player_participating'); ?></th>
            <th><?= $this->Paginator->sort('game_type_list_id'); ?></th>
            <th><?= $this->Paginator->sort('is_weight_category'); ?></th>
            <th><?= $this->Paginator->sort('weight_category_list_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('gender_list_id'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1;
        foreach ($activityLists as $activityList): //debug($activityList);?>
        <tr>
             <td><?php echo $i; ?></td>
            <td><?= $this->Number->format($activityList->id) ?></td>
            <td><?= h($activityList->description) ?></td>
            <td><?= $this->Number->format($activityList->minimum_player_participating) ?></td>
            <td><?= $this->Number->format($activityList->maximum_player_participating) ?></td>
            <td><?= h($activityList['game_type_list']['description']) ?></td>
                        <td><?= $activityList->is_weight_category ? __('Yes') : __('No'); ?></td>
                                    <td>
                <?= $activityList->has('weight_category_list') ? $this->Html->link($activityList->weight_category_list->description, ['controller' => 'WeightCategoryLists', 'action' => 'view', $activityList->weight_category_list->id]) : '' ?>
            </td>
                        <td><?= $activityList->active ? __('Yes') : __('No'); ?></td>
                                    <td><?= $this->Number->format($activityList->action_by) ?></td>
            <td><?php echo date_format($activityList->created,"d/m/Y h:i:A"); ?></td>
            <td><?= h($activityList->action_ip) ?></td>
            <td><?php echo date_format($activityList->modified,"d/m/Y h:i:A");?></td>
            <td>
                <?= $activityList->has('gender_list') ? $this->Html->link($activityList->gender_list->description, ['controller' => 'GenderLists', 'action' => 'view', $activityList->gender_list->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $activityList->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $activityList->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $activityList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityList->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
    echo $this->Form->submit('Add activityLists', array('type' => 'button',
        'class' => 'btn  btn-info',
        'onclick' => "location.href='" . $this->Url->build('/activityLists/add') . "'"));
    ?>
</div>