<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegisterCandidateEventActivities Model
 *
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 * @property \App\Model\Table\GenderListsTable|\Cake\ORM\Association\BelongsTo $GenderLists
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\BelongsTo $EventTeamDetails
 * @property \App\Model\Table\StateListsTable|\Cake\ORM\Association\BelongsTo $StateLists
 * @property \App\Model\Table\ResultStatusListsTable|\Cake\ORM\Association\BelongsTo $ResultStatusLists
 *
 * @method \App\Model\Entity\RegisterCandidateEventActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegisterCandidateEventActivity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RegisterCandidateEventActivitiesTable extends Table
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

        $this->setTable('register_candidate_event_activities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('GenderLists', [
            'foreignKey' => 'gender_list_id'
        ]);
        $this->belongsTo('EventTeamDetails', [
            'foreignKey' => 'event_team_detail_id'
        ]);
        $this->belongsTo('StateLists', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->belongsTo('ResultStatusLists', [
            'foreignKey' => 'result_status_list_id'
        ]);
             $this->hasMany('Player1s', [
            'foreignKey' => 'player1_id'
        ]);
         $this->hasMany('Player2s', [
            'foreignKey' => 'player2_id'
        ]);
         $this->hasMany('WinnerPlayers', [
            'foreignKey' => 'winner_player_id'
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
            ->scalar('full_name')
            ->allowEmpty('full_name');

        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            ->scalar('registration_number')
            ->allowEmpty('registration_number');

        $validator
            ->integer('weight')
            ->allowEmpty('weight');

        $validator
            ->integer('age')
            ->allowEmpty('age');

        $validator
            ->boolean('event_qualifying_status')
            ->requirePresence('event_qualifying_status', 'create')
            ->notEmpty('event_qualifying_status');

        $validator
            ->boolean('attendance_status')
            ->requirePresence('attendance_status', 'create')
            ->notEmpty('attendance_status');

        $validator
            ->boolean('certificate_download_status')
            ->requirePresence('certificate_download_status', 'create')
            ->notEmpty('certificate_download_status');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->requirePresence('action_by', 'create')
            ->notEmpty('action_by');

        $validator
            ->scalar('action_ip')
            ->requirePresence('action_ip', 'create')
            ->notEmpty('action_ip');

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
        $rules->add($rules->existsIn(['event_activity_list_id'], 'EventActivityLists'));
        $rules->add($rules->existsIn(['gender_list_id'], 'GenderLists'));
        $rules->add($rules->existsIn(['event_team_detail_id'], 'EventTeamDetails'));
        $rules->add($rules->existsIn(['state_list_id'], 'StateLists'));
        $rules->add($rules->existsIn(['result_status_list_id'], 'ResultStatusLists'));

        return $rules;
    }
}
