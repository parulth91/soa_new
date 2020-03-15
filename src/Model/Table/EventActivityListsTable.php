<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventActivityLists Model
 *
 * @property \App\Model\Table\EventListsTable|\Cake\ORM\Association\BelongsTo $EventLists
 * @property \App\Model\Table\ActivityListsTable|\Cake\ORM\Association\BelongsTo $ActivityLists
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\HasMany $EventTeamDetails
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\HasMany $RegisterCandidateEventActivities
 * @property \App\Model\Table\TeamTieSheetsTable|\Cake\ORM\Association\HasMany $TeamTieSheets
 *
 * @method \App\Model\Entity\EventActivityList get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventActivityList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventActivityList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventActivityList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventActivityList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventActivityList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventActivityList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventActivityListsTable extends Table
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

        $this->setTable('event_activity_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EventLists', [
            'foreignKey' => 'event_lists_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ActivityLists', [
            'foreignKey' => 'activity_lists_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EventTeamDetails', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->hasMany('RegisterCandidateEventActivities', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->hasMany('RegisterCandidates', [
            'foreignKey' => 'event_activity_list_id'
        ]);
        $this->hasMany('TeamTieSheets', [
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
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('description', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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

        $validator
            ->decimal('registration_fees')
            ->allowEmpty('registration_fees');

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
        $rules->add($rules->isUnique(['description']));
        $rules->add($rules->existsIn(['event_lists_id'], 'EventLists'));
        $rules->add($rules->existsIn(['activity_lists_id'], 'ActivityLists'));

        return $rules;
    }
}
