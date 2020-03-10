<?php
/* @var $this \Cake\View\View */
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>

<table class="table table-striped" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('provider'); ?></th>
            <th><?= $this->Paginator->sort('username'); ?></th>
            <th><?= $this->Paginator->sort('reference'); ?></th>
            <th><?= $this->Paginator->sort('avatar'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('link'); ?></th>
            <th><?= $this->Paginator->sort('token'); ?></th>
            <th><?= $this->Paginator->sort('token_secret'); ?></th>
            <th><?= $this->Paginator->sort('token_expires'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($socialAccounts as $socialAccount): ?>
        <tr>
            <td><?= $this->Number->format($socialAccount->id) ?></td>
            <td>
                <?= $socialAccount->has('user') ? $this->Html->link($socialAccount->user->description, ['controller' => 'Users', 'action' => 'view', $socialAccount->user->id]) : '' ?>
            </td>
            <td><?= h($socialAccount->provider) ?></td>
            <td><?= h($socialAccount->username) ?></td>
            <td><?= h($socialAccount->reference) ?></td>
            <td><?= h($socialAccount->avatar) ?></td>
            <td><?= h($socialAccount->description) ?></td>
            <td><?= h($socialAccount->link) ?></td>
            <td><?= h($socialAccount->token) ?></td>
            <td><?= h($socialAccount->token_secret) ?></td>
            <td><?= h($socialAccount->token_expires) ?></td>
                        <td><?= $socialAccount->active ? __('Yes') : __('No'); ?></td>
                                    <td class="actions">
                <?= $this->Html->link('', ['action' => 'view', $socialAccount->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                <?= $this->Html->link('', ['action' => 'edit', $socialAccount->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                <?= $this->Form->postLink('', ['action' => 'delete', $socialAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialAccount->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
