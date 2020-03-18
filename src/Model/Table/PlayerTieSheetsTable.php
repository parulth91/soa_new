<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlayerTieSheets Model
 *
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 * @property \App\Model\Table\WinnerRegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $WinnerRegisterCandidateEventActivities
 * @property \App\Model\Table\Player1RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $Player1RegisterCandidateEventActivities
 * @property \App\Model\Table\Player2RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\BelongsTo $Player2RegisterCandidateEventActivities
 *
 * @method \App\Model\Entity\PlayerTieSheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlayerTieSheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlayerTieSheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlayerTieSheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlayerTieSheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlayerTieSheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlayerTieSheet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlayerTieSheetsTable extends Table
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

        $this->setTable('player_tie_sheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->belongsTo('WinnerRegisterCandidateEventActivities', [
            'foreignKey' => 'winner_register_candidate_event_activity_id'
        ]);
        $this->belongsTo('Player1RegisterCandidateEventActivities', [
            'foreignKey' => 'player1_register_candidate_event_activity_id'
        ]);
        $this->belongsTo('Player2RegisterCandidateEventActivities', [
            'foreignKey' => 'player2_register_candidate_event_activity_id'
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
            ->integer('round_number')
            ->allowEmpty('round_number');

        $validator
            ->scalar('round_description')
            ->requirePresence('round_description', 'create')
            ->notEmpty('round_description');

        $validator
            ->integer('player1_score')
            ->allowEmpty('player1_score');

        $validator
            ->integer('player2_score')
            ->allowEmpty('player2_score');

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
        $rules->add($rules->existsIn(['event_activity_list_id'], 'EventActivityLists'));
        $rules->add($rules->existsIn(['winner_register_candidate_event_activity_id'], 'WinnerRegisterCandidateEventActivities'));
        $rules->add($rules->existsIn(['player1_register_candidate_event_activity_id'], 'Player1RegisterCandidateEventActivities'));
        $rules->add($rules->existsIn(['player2_register_candidate_event_activity_id'], 'Player2RegisterCandidateEventActivities'));

        return $rules;
    }
}
