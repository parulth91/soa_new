<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Volunteer $volunteer
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

$this->start('tb_actions');
?>
    <li><?= $this->Html->link(__('List Volunteer'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Ms Countries'), ['controller' => 'MsCountries', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms Country'), ['controller' => 'MsCountries', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Ms States'), ['controller' => 'MsStates', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms State'), ['controller' => 'MsStates', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Ms Districts'), ['controller' => 'MsDistricts', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms District'), ['controller' => 'MsDistricts', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Contribution Types'), ['controller' => 'ContributionTypes', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Contribution Type'), ['controller' => 'ContributionTypes', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Availability'), ['controller' => 'Availability', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Availability'), ['controller' => 'Availability', 'action' => 'add']) ?> </li>
<?php
$this->end();

$this->start('tb_sidebar');
?>
<ul class="nav nav-sidebar">
    <li><?= $this->Html->link(__('List Volunteer'), ['action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('List Ms Countries'), ['controller' => 'MsCountries', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms Country'), ['controller' => 'MsCountries', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Ms States'), ['controller' => 'MsStates', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms State'), ['controller' => 'MsStates', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Ms Districts'), ['controller' => 'MsDistricts', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Ms District'), ['controller' => 'MsDistricts', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Contribution Types'), ['controller' => 'ContributionTypes', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Contribution Type'), ['controller' => 'ContributionTypes', 'action' => 'add']) ?> </li>
    <li><?= $this->Html->link(__('List Availability'), ['controller' => 'Availability', 'action' => 'index']) ?> </li>
    <li><?= $this->Html->link(__('New Availability'), ['controller' => 'Availability', 'action' => 'add']) ?> </li>
</ul>
<?php
$this->end();
?>