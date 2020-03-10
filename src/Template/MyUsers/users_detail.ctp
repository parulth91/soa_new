
<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <!--<th><?= $this->Paginator->sort('id'); ?></th>-->
            <th><?= $this->Paginator->sort('username'); ?></th>
            <th><?= $this->Paginator->sort('email'); ?></th>
<!--            <th><?= $this->Paginator->sort('password'); ?></th>-->
            <th><?= $this->Paginator->sort('first_name'); ?></th>
            <th><?= $this->Paginator->sort('last_name'); ?></th>
            <th><?= $this->Paginator->sort('role'); ?></th>
            <th>DOB</th>
            <th><?= $this->Paginator->sort('phone_no'); ?></th>
            <th><?= $this->Paginator->sort('regimental_number'); ?></th>
<!--            <th><?= $this->Paginator->sort('tos_date'); ?></th>-->
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <!--<td><?= $this->Number->format($user->id) ?></td>-->
            <td><?= h($user->username) ?></td>
            <td><?= h($user->email) ?></td>
            <!--<td><?= h($user->password) ?></td>-->
            <td><?= h($user->first_name) ?></td>
            <td><?= h($user->last_name) ?></td>
            <td><?= h($user->role) ?></td>
            <td><?php
                if($user->dob == NULL){
                    echo "-";
                }else{
                    echo date_format($user->dob, "d-m-Y");
                }
                 ?></td>
            <td><?= h($user->phone_no) ?></td>
            <td><?= h($user->regimental_number) ?></td>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
            <td>   <?=
                        $this->Html->link(__d('CakeDC/Users', 'Edit'), ['action' => 'editUsers', $user->id],
                            ['title' => __('Edit'),
                            'class' => 'btn btn-default glyphicon glyphicon-pencil'])
                        ?></td>
            
<!--            <td><?= h($user->tos_date) ?></td>-->
                        
<!--                                    <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $user->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $user->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
            </td>-->
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
