<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndividualTieSheets Model
 *
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $RegisterCandidateEventActivities
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $RegisterCandidateEventActivities
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $RegisterCandidateEventActivities
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 *
 * @method \App\Model\Entity\IndividualTieSheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndividualTieSheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndividualTieSheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndividualTieSheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndividualTieSheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndividualTieSheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndividualTieSheet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IndividualTieSheetsTable extends Table
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

        $this->setTable('individual_tie_sheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RegisterCandidateEventActivities', [
            'foreignKey' => 'register_candidate_event_activity_id'
        ]);
        $this->belongsTo('RegisterCandidateEventActivities', [
            'foreignKey' => 'opponent_register_candidate_event_activity_id'
        ]);
        $this->belongsTo('RegisterCandidateEventActivities', [
            'foreignKey' => 'winner_register_candidate_event_activity_id'
        ]);
        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id'
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
            ->integer('match_number')
            ->allowEmpty('match_number');

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
        $rules->add($rules->existsIn(['register_candidate_event_activity_id'], 'RegisterCandidateEventActivities'));
        $rules->add($rules->existsIn(['opponent_register_candidate_event_activity_id'], 'RegisterCandidateEventActivities'));
        $rules->add($rules->existsIn(['winner_register_candidate_event_activity_id'], 'RegisterCandidateEventActivities'));
        $rules->add($rules->existsIn(['event_activity_list_id'], 'EventActivityLists'));

        return $rules;
    }
}
