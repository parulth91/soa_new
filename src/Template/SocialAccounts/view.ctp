<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($socialAccount->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('User') ?></td>
            <td><?= $socialAccount->has('user') ? $this->Html->link($socialAccount->user->description, ['controller' => 'Users', 'action' => 'view', $socialAccount->user->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Provider') ?></td>
            <td><?= h($socialAccount->provider) ?></td>
        </tr>
        <tr>
            <td><?= __('Username') ?></td>
            <td><?= h($socialAccount->username) ?></td>
        </tr>
        <tr>
            <td><?= __('Reference') ?></td>
            <td><?= h($socialAccount->reference) ?></td>
        </tr>
        <tr>
            <td><?= __('Avatar') ?></td>
            <td><?= h($socialAccount->avatar) ?></td>
        </tr>
        <tr>
            <td><?= __('Link') ?></td>
            <td><?= h($socialAccount->link) ?></td>
        </tr>
        <tr>
            <td><?= __('Token') ?></td>
            <td><?= h($socialAccount->token) ?></td>
        </tr>
        <tr>
            <td><?= __('Token Secret') ?></td>
            <td><?= h($socialAccount->token_secret) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($socialAccount->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Token Expires') ?></td>
            <td><?= h($socialAccount->token_expires) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($socialAccount->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($socialAccount->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $socialAccount->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= $this->Text->autoParagraph(h($socialAccount->description)); ?></td>
        </tr>
        <tr>
            <td><?= __('Data') ?></td>
            <td><?= $this->Text->autoParagraph(h($socialAccount->data)); ?></td>
        </tr>
    </table>
</div>

