<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WeightCategoryLists Model
 *
 * @property \App\Model\Table\ActivityListsTable|\Cake\ORM\Association\HasMany $ActivityLists
 *
 * @method \App\Model\Entity\WeightCategoryList get($primaryKey, $options = [])
 * @method \App\Model\Entity\WeightCategoryList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WeightCategoryList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WeightCategoryList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WeightCategoryList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WeightCategoryList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WeightCategoryList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WeightCategoryListsTable extends Table
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

        $this->setTable('weight_category_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ActivityLists', [
            'foreignKey' => 'weight_category_list_id'
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

        $validator
            ->integer('maximum_weight')
            ->requirePresence('maximum_weight', 'create')
            ->notEmpty('maximum_weight');

        $validator
            ->integer('minimum_weight')
            ->requirePresence('minimum_weight', 'create')
            ->notEmpty('minimum_weight');

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
