<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');

?>
<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= h($msGender->id) ?></h3>
    </div>
    <table class="table table-striped" cellpadding="0" cellspacing="0">
        <tr>
            <td><?= __('Action Ip') ?></td>
            <td><?= h($msGender->action_ip) ?></td>
        </tr>
        <tr>
            <td><?= __('Id') ?></td>
            <td><?= $this->Number->format($msGender->id) ?></td>
        </tr>
        <tr>
            <td><?= __('Point Assigned') ?></td>
            <td><?= $this->Number->format($msGender->point_assigned) ?></td>
        </tr>
        <tr>
            <td><?= __('Action By') ?></td>
            <td><?= $this->Number->format($msGender->action_by) ?></td>
        </tr>
        <tr>
            <td><?= __('Created') ?></td>
            <td><?= h($msGender->created) ?></td>
        </tr>
        <tr>
            <td><?= __('Modified') ?></td>
            <td><?= h($msGender->modified) ?></td>
        </tr>
        <tr>
            <td><?= __('Is Active') ?></td>
            <td><?= $msGender->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <td><?= __('Description') ?></td>
            <td><?= $this->Text->autoParagraph(h($msGender->description)); ?></td>
        </tr>
    </table>
</div>

<div class="panel panel-default">
    <!-- Panel header -->
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Related EmployeeInformations') ?></h3>
    </div>
    <?php if (!empty($msGender->employee_informations)): ?>
        <table class="table table-striped">
               <thead>
        <tr>
            <th><?= $this->Paginator->sort('id'); ?></th>
            <th><?= $this->Paginator->sort('ms_name_of_branch_id'); ?></th>
            <th><?= $this->Paginator->sort('regimental_number'); ?></th>
            <th><?= $this->Paginator->sort('name'); ?></th>
            <th><?= $this->Paginator->sort('ms_gender_id'); ?></th>
            <th><?= $this->Paginator->sort('date_of_birth'); ?></th>
            <th><?= $this->Paginator->sort('ms_rank_id'); ?></th>
            <th><?= $this->Paginator->sort('ms_cadre_id'); ?></th>
            <th><?= $this->Paginator->sort('date_of_appointment'); ?></th>
            <th><?= $this->Paginator->sort('ms_current_unit_id'); ?></th>
            <th><?= $this->Paginator->sort('ms_frontier_id'); ?></th>
            <th><?= $this->Paginator->sort('date_of_reporting_in_current_unit'); ?></th>
            <th><?= $this->Paginator->sort('ms_mode_of_appointment_id'); ?></th>
            <th><?= $this->Paginator->sort('name_of_sports_appointed_against_sport_quota'); ?></th>
            <th><?= $this->Paginator->sort('if_sports_quota_attached_unit_id'); ?></th>
            <th><?= $this->Paginator->sort('ms_recommended_by_id'); ?></th>
            <th><?= $this->Paginator->sort('ms_recommended_for_id'); ?></th>
            <th><?= $this->Paginator->sort('period_of_total_service_rendered_in_ha'); ?></th>
            <th><?= $this->Paginator->sort('period_of_total_service_rendered_in_sa'); ?></th>
            <th><?= $this->Paginator->sort('period_of_total_service_rendered_in_eha'); ?></th>
            <th><?= $this->Paginator->sort('continuous_ms_unit_category_id'); ?></th>
            <th><?= $this->Paginator->sort('number_of_months_completed_continuously_in_eha_ha_sa'); ?></th>
            <th><?= $this->Paginator->sort('is_presently_posted_in_home_state'); ?></th>
            <th><?= $this->Paginator->sort('home_ms_state_id'); ?></th>
            <th><?= $this->Paginator->sort('no_of_months_served_in_home_state'); ?></th>
            <th><?= $this->Paginator->sort('whether_medical_ground_case'); ?></th>
            <th><?= $this->Paginator->sort('ms_medical_category_id'); ?></th>
            <th><?= $this->Paginator->sort('name_of_disease_suffering_from_if_lmc'); ?></th>
            <th><?= $this->Paginator->sort('whether_unfit_for_haa_or_cold_climate_weather'); ?></th>
            <th><?= $this->Paginator->sort('whether_terminal_case'); ?></th>
            <th><?= $this->Paginator->sort('date_of_retirement'); ?></th>
            <th><?= $this->Paginator->sort('type_of_grievance_id'); ?></th>
            <th><?= $this->Paginator->sort('remarks_of_grievances'); ?></th>
            <th><?= $this->Paginator->sort('whether_couple_case'); ?></th>
            <th><?= $this->Paginator->sort('spouse_regimental_number'); ?></th>
            <th><?= $this->Paginator->sort('spouse_name'); ?></th>
            <th><?= $this->Paginator->sort('spouse_rank_id'); ?></th>
            <th><?= $this->Paginator->sort('spouse_cadre_id'); ?></th>
            <th><?= $this->Paginator->sort('spouse_current_unit_id'); ?></th>
            <th><?= $this->Paginator->sort('spouse_date_of_reporting_in_unit'); ?></th>
            <th><?= $this->Paginator->sort('remarks'); ?></th>
            <th><?= $this->Paginator->sort('point_assigned'); ?></th>
            <th><?= $this->Paginator->sort('is_active'); ?></th>
            <th><?= $this->Paginator->sort('action_by'); ?></th>
            <th><?= $this->Paginator->sort('created'); ?></th>
            <th><?= $this->Paginator->sort('modified'); ?></th>
            <th><?= $this->Paginator->sort('action_ip'); ?></th>
            <th class="actions"><?= __('Actions'); ?></th>
        </tr>
    </thead>
           
            <tbody>
            <?php foreach ($msGender->employee_informations as $employeeInformations): ?>
                <tr>
                    <td><?= h($employeeInformations->id) ?></td>
                    <td><?= h($employeeInformations->ms_name_of_branch_id) ?></td>
                    <td><?= h($employeeInformations->regimental_number) ?></td>
                    <td><?= h($employeeInformations->name) ?></td>
                    <td><?= h($employeeInformations->ms_gender_id) ?></td>
                    <td><?= h($employeeInformations->date_of_birth) ?></td>
                    <td><?= h($employeeInformations->ms_rank_id) ?></td>
                    <td><?= h($employeeInformations->ms_cadre_id) ?></td>
                    <td><?= h($employeeInformations->date_of_appointment) ?></td>
                    <td><?= h($employeeInformations->ms_current_unit_id) ?></td>
                    <td><?= h($employeeInformations->ms_frontier_id) ?></td>
                    <td><?= h($employeeInformations->date_of_reporting_in_current_unit) ?></td>
                    <td><?= h($employeeInformations->ms_mode_of_appointment_id) ?></td>
                    <td><?= h($employeeInformations->name_of_sports_appointed_against_sport_quota) ?></td>
                    <td><?= h($employeeInformations->if_sports_quota_attached_unit_id) ?></td>
                    <td><?= h($employeeInformations->ms_recommended_by_id) ?></td>
                    <td><?= h($employeeInformations->ms_recommended_for_id) ?></td>
                    <td><?= h($employeeInformations->period_of_total_service_rendered_in_ha) ?></td>
                    <td><?= h($employeeInformations->period_of_total_service_rendered_in_sa) ?></td>
                    <td><?= h($employeeInformations->period_of_total_service_rendered_in_eha) ?></td>
                    <td><?= h($employeeInformations->continuous_ms_unit_category_id) ?></td>
                    <td><?= h($employeeInformations->number_of_months_completed_continuously_in_eha_ha_sa) ?></td>
                    <td><?= h($employeeInformations->is_presently_posted_in_home_state) ?></td>
                    <td><?= h($employeeInformations->home_ms_state_id) ?></td>
                    <td><?= h($employeeInformations->no_of_months_served_in_home_state) ?></td>
                    <td><?= h($employeeInformations->whether_medical_ground_case) ?></td>
                    <td><?= h($employeeInformations->ms_medical_category_id) ?></td>
                    <td><?= h($employeeInformations->name_of_disease_suffering_from_if_lmc) ?></td>
                    <td><?= h($employeeInformations->whether_unfit_for_haa_or_cold_climate_weather) ?></td>
                    <td><?= h($employeeInformations->whether_terminal_case) ?></td>
                    <td><?= h($employeeInformations->date_of_retirement) ?></td>
                    <td><?= h($employeeInformations->type_of_grievance_id) ?></td>
                    <td><?= h($employeeInformations->remarks_of_grievances) ?></td>
                    <td><?= h($employeeInformations->whether_couple_case) ?></td>
                    <td><?= h($employeeInformations->spouse_regimental_number) ?></td>
                    <td><?= h($employeeInformations->spouse_name) ?></td>
                    <td><?= h($employeeInformations->spouse_rank_id) ?></td>
                    <td><?= h($employeeInformations->spouse_cadre_id) ?></td>
                    <td><?= h($employeeInformations->spouse_current_unit_id) ?></td>
                    <td><?= h($employeeInformations->spouse_date_of_reporting_in_unit) ?></td>
                    <td><?= h($employeeInformations->remarks) ?></td>
                    <td><?= h($employeeInformations->point_assigned) ?></td>
                    <td><?= h($employeeInformations->is_active) ?></td>
                    <td><?= h($employeeInformations->action_by) ?></td>
                    <td><?= h($employeeInformations->created) ?></td>
                    <td><?= h($employeeInformations->modified) ?></td>
                    <td><?= h($employeeInformations->action_ip) ?></td>
                    <td class="actions">
                        <?= $this->Html->link('', ['controller' => 'EmployeeInformations', 'action' => 'view', $employeeInformations->id], ['title' => __('View'), 'class' => 'btn btn-default glyphicon glyphicon-eye-open']) ?>
                        <?= $this->Html->link('', ['controller' => 'EmployeeInformations', 'action' => 'edit', $employeeInformations->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
                        <?= $this->Form->postLink('', ['controller' => 'EmployeeInformations', 'action' => 'delete', $employeeInformations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeInformations->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="panel-body">no related EmployeeInformations</p>
    <?php endif; ?>
</div>
