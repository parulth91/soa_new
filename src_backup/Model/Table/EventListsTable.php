<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventLists Model
 *
 * @method \App\Model\Entity\EventList get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventListsTable extends Table
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

        $this->setTable('event_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('event_year')
            ->requirePresence('event_year', 'create')
            ->notEmpty('event_year');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('description', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('registration_start_date')
            ->requirePresence('registration_start_date', 'create')
            ->notEmpty('registration_start_date');

        $validator
            ->dateTime('registration_end_date')
            ->requirePresence('registration_end_date', 'create')
            ->notEmpty('registration_end_date');

        $validator
            ->dateTime('event_start_date')
            ->requirePresence('event_start_date', 'create')
            ->notEmpty('event_start_date');

        $validator
            ->dateTime('event_end_date')
            ->requirePresence('event_end_date', 'create')
            ->notEmpty('event_end_date');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

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
        $rules->add($rules->isUnique(['description']));

        return $rules;
    }
}
