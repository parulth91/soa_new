<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CountryLists Model
 *
 * @property \App\Model\Table\StateListsTable|\Cake\ORM\Association\HasMany $StateLists
 *
 * @method \App\Model\Entity\CountryList get($primaryKey, $options = [])
 * @method \App\Model\Entity\CountryList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CountryList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CountryList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CountryList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CountryList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CountryList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountryListsTable extends Table
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

        $this->setTable('country_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('StateLists', [
            'foreignKey' => 'country_list_id'
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
            ->notEmpty('description');

        $validator
            ->scalar('country_code')
            ->requirePresence('country_code', 'create')
            ->notEmpty('country_code');

        $validator
            ->scalar('flag_code')
            ->requirePresence('flag_code', 'create')
            ->notEmpty('flag_code');

        $validator
            ->scalar('telephone_code')
            ->requirePresence('telephone_code', 'create')
            ->notEmpty('telephone_code');

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
}
