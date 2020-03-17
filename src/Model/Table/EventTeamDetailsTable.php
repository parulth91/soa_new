<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventTeamDetails Model
 *
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 * @property \App\Model\Table\StateListsTable|\Cake\ORM\Association\BelongsTo $StateLists
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\HasMany $RegisterCandidateEventActivities
 * @property \App\Model\Table\TeamTieSheetsTable|\Cake\ORM\Association\HasMany $TeamTieSheets
 *
 * @method \App\Model\Entity\EventTeamDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventTeamDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventTeamDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventTeamDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventTeamDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventTeamDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventTeamDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventTeamDetailsTable extends Table
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

        $this->setTable('event_team_details');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->belongsTo('StateLists', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->hasMany('RegisterCandidateEventActivities', [
            'foreignKey' => 'event_team_detail_id'
        ]);
        $this->hasMany('TeamTieSheets', [
            'foreignKey' => 'event_team_detail_id'
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
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->requirePresence('action_by', 'create')
            ->notEmpty('action_by');

        $validator
            ->scalar('action_ip')
            ->requirePresence('action_ip', 'create')
            ->notEmpty('action_ip');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['state_list_id'], 'StateLists'));

        return $rules;
    }
}
