<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StateLists Model
 *
 * @property \App\Model\Table\CountryListsTable|\Cake\ORM\Association\BelongsTo $CountryLists
 * @property \App\Model\Table\DistrictListsTable|\Cake\ORM\Association\HasMany $DistrictLists
 * @property \App\Model\Table\EventTeamDetailsTable|\Cake\ORM\Association\HasMany $EventTeamDetails
 * @property \App\Model\Table\RegisterCandidateEventActivitiesTable|\Cake\ORM\Association\HasMany $RegisterCandidateEventActivities
 * @property |\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\StateList get($primaryKey, $options = [])
 * @method \App\Model\Entity\StateList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StateList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StateList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StateList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StateList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StateList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StateListsTable extends Table
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

        $this->setTable('state_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CountryLists', [
            'foreignKey' => 'country_list_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('DistrictLists', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->hasMany('EventTeamDetails', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->hasMany('RegisterCandidateEventActivities', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->hasMany('RegisterCandidates', [
            'foreignKey' => 'state_list_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'state_list_id'
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
        $rules->add($rules->existsIn(['country_list_id'], 'CountryLists'));

        return $rules;
    }
}
