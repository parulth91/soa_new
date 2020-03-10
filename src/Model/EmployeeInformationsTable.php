<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmployeeInformations Model
 *
 * @property \App\Model\Table\MsNameOfBranchesTable|\Cake\ORM\Association\BelongsTo $MsNameOfBranches
 * @property \App\Model\Table\MsGendersTable|\Cake\ORM\Association\BelongsTo $MsGenders
 * @property \App\Model\Table\MsRanksTable|\Cake\ORM\Association\BelongsTo $MsRanks
 * @property \App\Model\Table\MsCadresTable|\Cake\ORM\Association\BelongsTo $MsCadres
 * @property \App\Model\Table\MsUnitsTable|\Cake\ORM\Association\BelongsTo $MsUnits
 * @property \App\Model\Table\MsFrontiersTable|\Cake\ORM\Association\BelongsTo $MsFrontiers
 * @property \App\Model\Table\MsModeOfAppointmentsTable|\Cake\ORM\Association\BelongsTo $MsModeOfAppointments
 * @property \App\Model\Table\MsUnitsTable|\Cake\ORM\Association\BelongsTo $MsUnits
 * @property \App\Model\Table\MsRecommendedByTable|\Cake\ORM\Association\BelongsTo $MsRecommendedBy
 * @property \App\Model\Table\MsRecommendedForTable|\Cake\ORM\Association\BelongsTo $MsRecommendedFor
 * @property \App\Model\Table\MsUnitCategoriesTable|\Cake\ORM\Association\BelongsTo $MsUnitCategories
 * @property \App\Model\Table\MsStatesTable|\Cake\ORM\Association\BelongsTo $MsStates
 * @property \App\Model\Table\MsMedicalCategoriesTable|\Cake\ORM\Association\BelongsTo $MsMedicalCategories
 * @property \App\Model\Table\MsTypeOfGrievancesTable|\Cake\ORM\Association\BelongsTo $MsTypeOfGrievances
 * @property \App\Model\Table\MsRanksTable|\Cake\ORM\Association\BelongsTo $MsRanks
 * @property \App\Model\Table\MsCadresTable|\Cake\ORM\Association\BelongsTo $MsCadres
 * @property \App\Model\Table\MsUnitsTable|\Cake\ORM\Association\BelongsTo $MsUnits
 *
 * @method \App\Model\Entity\EmployeeInformation get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmployeeInformation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmployeeInformation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmployeeInformation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeeInformationsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('employee_informations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MsNameOfBranches', [
            'foreignKey' => 'ms_name_of_branch_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsGenders', [
            'foreignKey' => 'ms_gender_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsRanks', [
            'foreignKey' => 'ms_rank_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsCadres', [
            'foreignKey' => 'ms_cadre_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsUnits', [
            'foreignKey' => 'ms_current_unit_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsFrontiers', [
            'foreignKey' => 'ms_frontier_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsModeOfAppointments', [
            'foreignKey' => 'ms_mode_of_appointment_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsUnits', [
            'foreignKey' => 'if_sports_quota_attached_unit_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsRecommendedBy', [
            'foreignKey' => 'ms_recommended_by_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsRecommendedFor', [
            'foreignKey' => 'ms_recommended_for_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsUnitCategories', [
            'foreignKey' => 'continuous_ms_unit_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsStates', [
            'foreignKey' => 'home_ms_state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsMedicalCategories', [
            'foreignKey' => 'ms_medical_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsTypeOfGrievances', [
            'foreignKey' => 'type_of_grievance_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsRanks', [
            'foreignKey' => 'spouse_rank_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsCadres', [
            'foreignKey' => 'spouse_cadre_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MsUnits', [
            'foreignKey' => 'spouse_current_unit_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('regimental_number')
            ->requirePresence('regimental_number', 'create')
            ->allowEmpty('regimental_number')
            ->add('regimental_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->allowEmpty('name');

        $validator
            ->date('date_of_birth')
           // ->requirePresence('date_of_birth', 'create')
            ->allowEmpty('date_of_birth');

        $validator
            ->date('date_of_appointment')
           // ->requirePresence('date_of_appointment', 'create')
            ->allowEmpty('date_of_appointment');

        $validator
            ->date('date_of_reporting_in_current_unit')
           // ->requirePresence('date_of_reporting_in_current_unit', 'create')
            ->allowEmpty('date_of_reporting_in_current_unit');

        $validator
            ->scalar('name_of_sports_appointed_against_sport_quota')
            ->requirePresence('name_of_sports_appointed_against_sport_quota', 'create')
            ->allowEmpty('name_of_sports_appointed_against_sport_quota');

        $validator
            ->integer('period_of_total_service_rendered_in_ha')
            ->requirePresence('period_of_total_service_rendered_in_ha', 'create')
            ->allowEmpty('period_of_total_service_rendered_in_ha');

        $validator
            ->integer('period_of_total_service_rendered_in_sa')
            ->requirePresence('period_of_total_service_rendered_in_sa', 'create')
            ->allowEmpty('period_of_total_service_rendered_in_sa');

        $validator
            ->integer('period_of_total_service_rendered_in_eha')
            ->requirePresence('period_of_total_service_rendered_in_eha', 'create')
            ->allowEmpty('period_of_total_service_rendered_in_eha');

        $validator
            ->integer('number_of_months_completed_continuously_in_eha_ha_sa')
            ->requirePresence('number_of_months_completed_continuously_in_eha_ha_sa', 'create')
            ->allowEmpty('number_of_months_completed_continuously_in_eha_ha_sa');

        $validator
            ->boolean('is_presently_posted_in_home_state')
            ->requirePresence('is_presently_posted_in_home_state', 'create')
            ->allowEmpty('is_presently_posted_in_home_state');

        $validator
            ->integer('no_of_months_served_in_home_state')
            ->requirePresence('no_of_months_served_in_home_state', 'create')
            ->allowEmpty('no_of_months_served_in_home_state');

        $validator
            ->boolean('whether_medical_ground_case')
            ->requirePresence('whether_medical_ground_case', 'create')
            ->allowEmpty('whether_medical_ground_case');

        $validator
            ->scalar('name_of_disease_suffering_from_if_lmc')
            ->requirePresence('name_of_disease_suffering_from_if_lmc', 'create')
            ->allowEmpty('name_of_disease_suffering_from_if_lmc');

        $validator
            ->boolean('whether_unfit_for_haa_or_cold_climate_weather')
            ->requirePresence('whether_unfit_for_haa_or_cold_climate_weather', 'create')
            ->allowEmpty('whether_unfit_for_haa_or_cold_climate_weather');

        $validator
            ->boolean('whether_terminal_case')
            ->requirePresence('whether_terminal_case', 'create')
            ->allowEmpty('whether_terminal_case');

        $validator
            ->date('date_of_retirement')
            //->requirePresence('date_of_retirement', 'create')
            ->allowEmpty('date_of_retirement');

        $validator
            ->scalar('remarks_of_grievances')
            ->requirePresence('remarks_of_grievances', 'create')
            ->allowEmpty('remarks_of_grievances');

        $validator
            ->boolean('whether_couple_case')
            ->requirePresence('whether_couple_case', 'create')
            ->allowEmpty('whether_couple_case');

        $validator
            ->integer('spouse_regimental_number')
            ->requirePresence('spouse_regimental_number', 'create')
            ->allowEmpty('spouse_regimental_number');

        $validator
            ->scalar('spouse_name')
            ->requirePresence('spouse_name', 'create')
            ->allowEmpty('spouse_name');

        $validator
            ->date('spouse_date_of_reporting_in_unit')
            //->requirePresence('spouse_date_of_reporting_in_unit', 'create')
            ->allowEmpty('spouse_date_of_reporting_in_unit');

        $validator
            ->scalar('remarks')
            ->requirePresence('remarks', 'create')
            ->allowEmpty('remarks');

        $validator
            ->integer('point_assigned')
            ->requirePresence('point_assigned', 'create')
            ->allowEmpty('point_assigned');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->allowEmpty('is_active');

        $validator
            ->requirePresence('action_by', 'create')
            ->allowEmpty('action_by');

        $validator
            ->scalar('action_ip')
            ->requirePresence('action_ip', 'create')
            ->allowEmpty('action_ip');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['regimental_number']));
        $rules->add($rules->existsIn(['ms_name_of_branch_id'], 'MsNameOfBranches'));
        $rules->add($rules->existsIn(['ms_gender_id'], 'MsGenders'));
        $rules->add($rules->existsIn(['ms_rank_id'], 'MsRanks'));
        $rules->add($rules->existsIn(['ms_cadre_id'], 'MsCadres'));
        $rules->add($rules->existsIn(['ms_current_unit_id'], 'MsUnits'));
        $rules->add($rules->existsIn(['ms_frontier_id'], 'MsFrontiers'));
        $rules->add($rules->existsIn(['ms_mode_of_appointment_id'], 'MsModeOfAppointments'));
        $rules->add($rules->existsIn(['if_sports_quota_attached_unit_id'], 'MsUnits'));
        $rules->add($rules->existsIn(['ms_recommended_by_id'], 'MsRecommendedBy'));
        $rules->add($rules->existsIn(['ms_recommended_for_id'], 'MsRecommendedFor'));
        $rules->add($rules->existsIn(['continuous_ms_unit_category_id'], 'MsUnitCategories'));
        $rules->add($rules->existsIn(['home_ms_state_id'], 'MsStates'));
        $rules->add($rules->existsIn(['ms_medical_category_id'], 'MsMedicalCategories'));
        $rules->add($rules->existsIn(['type_of_grievance_id'], 'MsTypeOfGrievances'));
        $rules->add($rules->existsIn(['spouse_rank_id'], 'MsRanks'));
        $rules->add($rules->existsIn(['spouse_cadre_id'], 'MsCadres'));
        $rules->add($rules->existsIn(['spouse_current_unit_id'], 'MsUnits'));

        return $rules;
    }
}
