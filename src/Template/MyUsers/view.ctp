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
            <td><?= __('Ms Country') ?></td>
            <td><?= $user->has('ms_country') ? $this->Html->link($user->ms_country->description, ['controller' => 'MsCountries', 'action' => 'view', $user->ms_country->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Ms State') ?></td>
            <td><?= $user->has('ms_state') ? $this->Html->link($user->ms_state->description, ['controller' => 'MsStates', 'action' => 'view', $user->ms_state->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Ms District') ?></td>
            <td><?= $user->has('ms_district') ? $this->Html->link($user->ms_district->description, ['controller' => 'MsDistricts', 'action' => 'view', $user->ms_district->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Availability') ?></td>
            <td><?= $user->has('availability') ? $this->Html->link($user->availability->description, ['controller' => 'Availabilities', 'action' => 'view', $user->availability->id]) : '' ?></td>
        </tr>
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($user->action_ip) ?></td>
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
    </table>
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
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related UserContributionTypes') ?></h3>
    </div>
    <?php if (!empty($user->user_contribution_types)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('description'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('contribution_type_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->user_contribution_types as $userContributionTypes): ?>
                <tr>
                    <td><?= h($userContributionTypes->id) ?></td>
                    <td><?= h($userContributionTypes->description) ?></td>
                    <td><?= h($userContributionTypes->user_id) ?></td>
                    <td><?= h($userContributionTypes->contribution_type_id) ?></td>
                    <td><?= h($userContributionTypes->active) ?></td>
                    <td><?= h($userContributionTypes->created) ?></td>
                    <td><?= h($userContributionTypes->modified) ?></td>
                    <td><?= h($userContributionTypes->action_by) ?></td>
                    <td><?= h($userContributionTypes->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'UserContributionTypes', 'action' => 'view', $userContributionTypes->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'UserContributionTypes', 'action' => 'edit', $userContributionTypes->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'UserContributionTypes', 'action' => 'delete', $userContributionTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userContributionTypes->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related UserContributionTypes</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related UserGroupRoles') ?></h3>
    </div>
    <?php if (!empty($user->user_group_roles)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('group_id'); ?></th>
            <th><?= $this->Paginator->sort('role_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->user_group_roles as $userGroupRoles): ?>
                <tr>
                    <td><?= h($userGroupRoles->id) ?></td>
                    <td><?= h($userGroupRoles->user_id) ?></td>
                    <td><?= h($userGroupRoles->group_id) ?></td>
                    <td><?= h($userGroupRoles->role_id) ?></td>
                    <td><?= h($userGroupRoles->active) ?></td>
                    <td><?= h($userGroupRoles->created) ?></td>
                    <td><?= h($userGroupRoles->modified) ?></td>
                    <td><?= h($userGroupRoles->action_by) ?></td>
                    <td><?= h($userGroupRoles->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'UserGroupRoles', 'action' => 'view', $userGroupRoles->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'UserGroupRoles', 'action' => 'edit', $userGroupRoles->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'UserGroupRoles', 'action' => 'delete', $userGroupRoles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userGroupRoles->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related UserGroupRoles</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related UserRoles') ?></h3>
    </div>
    <?php if (!empty($user->user_roles)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('role_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->user_roles as $userRoles): ?>
                <tr>
                    <td><?= h($userRoles->id) ?></td>
                    <td><?= h($userRoles->user_id) ?></td>
                    <td><?= h($userRoles->role_id) ?></td>
                    <td><?= h($userRoles->active) ?></td>
                    <td><?= h($userRoles->created) ?></td>
                    <td><?= h($userRoles->modified) ?></td>
                    <td><?= h($userRoles->action_by) ?></td>
                    <td><?= h($userRoles->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'UserRoles', 'action' => 'view', $userRoles->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'UserRoles', 'action' => 'edit', $userRoles->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'UserRoles', 'action' => 'delete', $userRoles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userRoles->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related UserRoles</p>
    <?php endif; ?>
</div>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related UserTasks') ?></h3>
    </div>
    <?php if (!empty($user->user_tasks)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('user_id'); ?></th>
            <th><?= $this->Paginator->sort('task_id'); ?></th>
            <th><?= $this->Paginator->sort('user_task_data_id'); ?></th>
            <th><?= $this->Paginator->sort('active'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($user->user_tasks as $userTasks): ?>
                <tr>
                    <td><?= h($userTasks->id) ?></td>
                    <td><?= h($userTasks->user_id) ?></td>
                    <td><?= h($userTasks->task_id) ?></td>
                    <td><?= h($userTasks->user_task_data_id) ?></td>
                    <td><?= h($userTasks->active) ?></td>
                    <td><?= h($userTasks->created) ?></td>
                    <td><?= h($userTasks->modified) ?></td>
                    <td><?= h($userTasks->action_by) ?></td>
                    <td><?= h($userTasks->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'UserTasks', 'action' => 'view', $userTasks->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'UserTasks', 'action' => 'edit', $userTasks->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'UserTasks', 'action' => 'delete', $userTasks->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userTasks->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related UserTasks</p>
    <?php endif; ?>
</div>
