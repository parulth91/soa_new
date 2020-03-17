<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeamTieSheets Model
 *
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\BelongsTo $EventTeamDetails
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\BelongsTo $EventTeamDetails
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\BelongsTo $EventTeamDetails
 *
 * @method \App\Model\Entity\TeamTieSheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\TeamTieSheet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TeamTieSheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeamTieSheet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeamTieSheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TeamTieSheet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeamTieSheet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeamTieSheetsTable extends Table
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

        $this->setTable('team_tie_sheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->belongsTo('EventTeamDetails', [
            'foreignKey' => 'team1_event_team_detail_id'
        ]);
        $this->belongsTo('EventTeamDetails', [
            'foreignKey' => 'team2_event_team_detail_id'
        ]);
        $this->belongsTo('EventTeamDetails', [
            'foreignKey' => 'winner_team_detail_id'
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
            ->integer('match_number')
            ->allowEmpty('match_number');

        $validator
            ->integer('team1_score')
            ->allowEmpty('team1_score');

        $validator
            ->integer('team2_score')
            ->allowEmpty('team2_score');

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
        $rules->add($rules->existsIn(['team1_event_team_detail_id'], 'EventTeamDetails'));
        $rules->add($rules->existsIn(['team2_event_team_detail_id'], 'EventTeamDetails'));
        $rules->add($rules->existsIn(['winner_team_detail_id'], 'EventTeamDetails'));

        return $rules;
    }
}
