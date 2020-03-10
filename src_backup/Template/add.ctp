<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeInformation $employeeInformation
 */
?>
<?php
$this->extend('../Layout/TwitterBootstrap/dashboard');
?>
<?php
echo $this->Form->create($employeeInformation);
?>
<fieldset>
    <legend><?= __('Add {0}', ['label' => false, 'JEB Information of Employee']) ?></legend>
    <table class="table table-bordered">
        <tr>
            <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                Select Branch of Employee
            </th>
        </tr>
        <tr>
            <td colspan="2">

            </td>
            <td>
                <?php
                echo $this->Form->input('ms_name_of_branch_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msNameOfBranches]);
                ?>
            </td>
            <td colspan="2">

            </td>
        </tr>
        <tr class="complete_data_row">
            <td colspan="6">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            Employee Informations
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Regimental Number
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('regimental_number', ['label' => false, 'type' => 'numeric', 'maxlength' => "9", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>
                            Name
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('name', ['label' => false, 'type' => 'text', 'maxlength' => "100", 'onkeypress' => "return (alphachar(event, alphabetWithSpace));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>
                            Gender
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('ms_gender_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msGenders]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Date Of Birth
                        </th>
                        <td>

                            <?php
                            echo $this->Form->control('date_of_birth', ['label' => false, 'autocomplete' => "off"]);
                            ?>

                        </td>
                        <th>
                            Date Of Appointment
                        </th>
                        <td>

                            <?php
                            echo $this->Form->control('date_of_appointment', ['label' => false, 'autocomplete' => "off"]);
                            ?>

                        </td>
                        <th>

                        </th>
                        <td>


                        </td>
                    </tr>
                    <tr>
                        <th>
                            Frontier
                        </th>
                        <td>

                            <?php
                            echo $this->Form->input('ms_frontier_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msFrontiers]);
                            ?>

                        </td>
                        <th>
                            Current Unit
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('ms_current_unit_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msUnits]);
                            ?>
                        </td>

                        <th>
                            Date Of Reporting In current Unit
                        </th>
                        <td>

                            <?php
                            echo $this->Form->control('date_of_reporting_in_current_unit', ['label' => false, 'autocomplete' => "off"]);
                            ?>

                        </td>

                    </tr>
                    <tr>
                        <th>
                            Rank
                        </th>
                        <td>

                            <?php
                            echo $this->Form->input('ms_rank_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msRanks]);
                            ?>

                        </td>
                        <th>
                            Cadre
                        </th>
                        <td>

                            <?php
                            echo $this->Form->input('ms_cadre_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msCadres]);
                            ?>

                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            Mode Of Appointment
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('ms_mode_of_appointment_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msModeOfAppointments]);
                            ?>
                        </td>
                        <th>
                            Name Of Sports appointed against sport quota
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('name_of_sports_appointed_against_sport_quota', ['label' => false, 'type' => 'text', 'maxlength' => '60']);
                            ?>
                        </td>
                        <th>
                            If sports quota attached unit
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('if_sports_quota_attached_unit_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msUnits]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Period of Total Service Rendered in HA
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('period_of_total_service_rendered_in_ha', ['label' => false, 'type' => 'numeric', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>
                            Period of Total Service Rendered in SA
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('period_of_total_service_rendered_in_sa', ['label' => false, 'type' => 'numeric', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>
                            Period of Total Service Rendered in EHA
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('period_of_total_service_rendered_in_eha', ['label' => false, 'type' => 'numeric', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Continuous Unit Category
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('continuous_ms_unit_category_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msUnitCategories]);
                            ?>

                        </td>
                        <th>
                            Number of months completed continuously in EHA/HA/SA
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('number_of_months_completed_continuously_in_eha_ha_sa', ['label' => false, 'type' => 'numeric', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            <?php
                            echo $this->Form->control('is_presently_posted_in_home_state');
                            ?>
                        </th>
                    </tr>
                    <tr>

                        <th>
                            Home State
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('home_ms_state_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msStates]);
                            ?>
                        </td>
                        <th>
                            No of Months Served In Home State

                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('no_of_months_served_in_home_state', ['label' => false, 'type' => 'numeric', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            <?php
                            echo $this->Form->control('whether_terminal_case');
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Type of grievance
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('type_of_grievance_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msTypeOfGrievances]);
                            ?>
                        </td>

                        <th>
                            Remarks Of Grievance
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('remarks_of_grievances', ['label' => false, 'type' => 'text', 'maxlength' => "3", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                            ?>
                        </td>
                        <th>
                            Date Of Retirement
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('date_of_retirement', ['label' => false]);
                            ?>
                        </td>
                    </tr>



                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            <?php
                            echo $this->Form->control('whether_unfit_for_haa_or_cold_climate_weather');
                            ?>
                        </th>
                    </tr>

                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            <?php
                            echo $this->Form->control('whether_medical_ground_case');
                            ?>
                        </th>

                    </tr>
                    <tr class="couple_case_row">
                        <td colspan="6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>
                                        Medical Category
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->input('ms_medical_category_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msMedicalCategories]);
                                        ?>
                                    </td>
                                    <th>
                                        Name of disease suffering from if LMC
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->control('name_of_disease_suffering_from_if_lmc', ['label' => false, 'type' => 'text', 'maxlength' => "300", 'onkeypress' => "return (alphachar(event, alphabetWithSpace));", 'autocomplete' => "off"]);
                                        ?>
                                    </td>


                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="6" style="text-align:center; background-color: lightcyan; ">
                            <?php
                            echo $this->Form->control('whether_couple_case');
                            ?>
                        </th>
                    </tr>
                    <tr class="couple_case_row">
                        <td colspan="6">
                            <table class="table table-bordered" style= "background-color: lightcoral" >
                                <tr>
                                    <th>
                                        Spouse Regimental Number
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->control('spouse_regimental_number', ['label' => false, 'type' => 'numeric', 'maxlength' => "9", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                                        ?>
                                    </td>
                                    <th>
                                        Spouse Name
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->control('spouse_name', ['label' => false, 'type' => 'text', 'maxlength' => "50", 'onkeypress' => "return (alphachar(event, numeric));", 'autocomplete' => "off"]);
                                        ?>
                                    </td>
                                    <th>
                                        Spouse date of reporting in present unit
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->control('spouse_date_of_reporting_in_unit', ['label' => false]);
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <th>
                                        Spouse Rank
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->input('spouse_rank_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msRanks]);
                                        ?>
                                    </td>
                                    <th>
                                        Spouse Cadre
                                    </th>
                                    <td>
                                        <?php
                                        echo $this->Form->input('spouse_cadre_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msCadres]);
                                        ?>
                                    </td>

                                    <th>

                                    </th>
                                    <td>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <th>
                            Recommended By
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('ms_recommended_by_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msRecommendedBy]);
                            ?>
                        </td>
                        <th>
                            Reecommended For
                        </th>
                        <td>
                            <?php
                            echo $this->Form->input('ms_recommended_for_id', ['label' => false, 'type' => 'select', 'empty' => 'Select', 'options' => $msRecommendedFor]);
                            ?>
                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                    </tr>

                    <tr>
                        <th>
                            Is Active
                        </th>
                        <td>
                            <?php
                            echo $this->Form->control('is_active');
                            ?>
                        </td>
                        <th>
                            Remarks
                        </th>
                        <td colspan="3">
                            <?php
                            echo $this->Form->control('remarks', ['label' => false, 'type' => 'textArea', 'maxlength' => "300", 'onkeypress' => "return (alphachar(event, alphabetWithSpace));", 'autocomplete' => "off"]);
                            ?>
                        </td>

                    </tr>
                    <tr>
                        <th>

                        </th>
                        <td>

                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                        <th>

                        </th>
                        <td>

                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</fieldset>
<?=
$this->Form->button(__("Add"));
?>
<?= $this->Form->end() ?>
