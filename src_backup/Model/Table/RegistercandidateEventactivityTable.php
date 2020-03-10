<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegistercandidateEventactivity Model
 *
 * @property \App\Model\Table\EventActivityListsTable|\Cake\ORM\Association\BelongsTo $EventActivityLists
 *
 * @method \App\Model\Entity\RegistercandidateEventactivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegistercandidateEventactivity findOrCreate($search, callable $callback = null, $options = [])
 */
class RegistercandidateEventactivityTable extends Table
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

        $this->setTable('registercandidate_eventactivity');
        $this->setDisplayField('registration_id');
        $this->setPrimaryKey('registration_id');

        $this->belongsTo('EventActivityLists', [
            'foreignKey' => 'event_activity_list_id',
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
            ->integer('registration_id')
            ->allowEmpty('registration_id', 'create');

        $validator
            ->integer('weight')
            ->allowEmpty('weight');

        $validator
            ->integer('age')
            ->allowEmpty('age');

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

        return $rules;
    }
}
