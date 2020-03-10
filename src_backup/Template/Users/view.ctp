<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($user->username) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Username') ?></td>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <td><?= __('Email') ?></td>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <td><?= __('Password') ?></td>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <td><?= __('First Name') ?></td>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Last Name') ?></td>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <td><?= __('Token') ?></td>
            <td><?= h($user->token) ?></td>
        </tr>
        <tr>
            <td><?= __('Api Token') ?></td>
            <td><?= h($user->api_token) ?></td>
        </tr>
        <tr>
            <td><?= __('Role') ?></td>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <td><?= __('Secret') ?></td>
            <td><?= h($user->secret) ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($user->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Registercandidate Eventactivity') ?></td>
            <td><?= $user->has('registercandidate_eventactivity') ? $this->Html->link($user->registercandidate_eventactivity->description, ['controller' => 'RegistercandidateEventactivity', 'action' => 'view', $user->registercandidate_eventactivity->registration_id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Phone No') ?></td>
            <td><?= $this->Number->format($user->phone_no) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($user->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Token Expires') ?></td>
            <td><?= h($user->token_expires) ?></td>
        </tr>
        <tr>
            <td><?= __('Activation Date') ?></td>
            <td><?= h($user->activation_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Tos Date') ?></td>
            <td><?= h($user->tos_date) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Dob') ?></td>
            <td><?= h($user->dob) ?></td>
        </tr>
        <tr>
            <td><?= __('Active') ?></td>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Is Superuser') ?></td>
            <td><?= $user->is_superuser ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Secret Verified') ?></td>
            <td><?= $user->secret_verified ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Password Changed') ?></td>
            <td><?= $user->password_changed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related ReportingLists') ?></h3>
    </div>
    <?php if (!empty($user->reporting_lists)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->reporting_lists as $reportingLists): ?>
                <tr>
                    <td><?= h($reportingLists->id) ?></td>
                    <td><?= h($reportingLists->user_id) ?></td>
                    <td><?= h($reportingLists->is_active) ?></td>
                    <td><?= h($reportingLists->action_by) ?></td>
                    <td><?= h($reportingLists->created) ?></td>
                    <td><?= h($reportingLists->modified) ?></td>
                    <td><?= h($reportingLists->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'ReportingLists', 'action' => 'view', $reportingLists->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'ReportingLists', 'action' => 'edit', $reportingLists->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'ReportingLists', 'action' => 'delete', $reportingLists->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reportingLists->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related ReportingLists</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related SocialAccounts') ?></h3>
    </div>
    <?php if (!empty($user->social_accounts)): ?>
        <table class="table table-striped">
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
            <th><?= $this->Paginator->sort('data'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->social_accounts as $socialAccounts): ?>
                <tr>
                    <td><?= h($socialAccounts->id) ?></td>
                    <td><?= h($socialAccounts->user_id) ?></td>
                    <td><?= h($socialAccounts->provider) ?></td>
                    <td><?= h($socialAccounts->username) ?></td>
                    <td><?= h($socialAccounts->reference) ?></td>
                    <td><?= h($socialAccounts->avatar) ?></td>
                    <td><?= h($socialAccounts->description) ?></td>
                    <td><?= h($socialAccounts->link) ?></td>
                    <td><?= h($socialAccounts->token) ?></td>
                    <td><?= h($socialAccounts->token_secret) ?></td>
                    <td><?= h($socialAccounts->token_expires) ?></td>
                    <td><?= h($socialAccounts->active) ?></td>
                    <td><?= h($socialAccounts->data) ?></td>
                    <td><?= h($socialAccounts->created) ?></td>
                    <td><?= h($socialAccounts->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccounts->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccounts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $socialAccounts->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related SocialAccounts</p>
    <?php endif; ?>
</div>
