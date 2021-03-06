<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityLists Model
 *
 * @property \App\Model\Table\WeightCategoryListsTable|\Cake\ORM\Association\BelongsTo $WeightCategoryLists
 * @property \App\Model\Table\GenderListsTable|\Cake\ORM\Association\BelongsTo $GenderLists
 * @property \App\Model\Table\GameTypeListsTable|\Cake\ORM\Association\BelongsTo $GameTypeLists
 * @property \App\Model\Table\AgeGroupListsTable|\Cake\ORM\Association\BelongsTo $AgeGroupLists
 *
 * @method \App\Model\Entity\ActivityList get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityList newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityList[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityList|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityList patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityList[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityList findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActivityListsTable extends Table
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

        $this->setTable('activity_lists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('WeightCategoryLists', [
            'foreignKey' => 'weight_category_list_id'
        ]);
        $this->belongsTo('GenderLists', [
            'foreignKey' => 'gender_list_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('GameTypeLists', [
            'foreignKey' => 'game_type_list_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AgeGroupLists', [
            'foreignKey' => 'age_group_list_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description')
            ->add('description', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

            $validator
            ->integer('game_type_list_id')
            ->requirePresence('game_type_list_id', 'create')
            ->notEmpty('game_type_list_id');

        $validator
            ->integer('minimum_player_participating')
            ->requirePresence('minimum_player_participating', 'create')
            ->notEmpty('minimum_player_participating');

        $validator
            ->integer('maximum_player_participating')
            ->requirePresence('maximum_player_participating', 'create')
            ->notEmpty('maximum_player_participating');

        $validator
            ->boolean('is_weight_category')
            ->requirePresence('is_weight_category', 'create')
            ->notEmpty('is_weight_category');

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
        $rules->add($rules->existsIn(['weight_category_list_id'], 'WeightCategoryLists'));
        $rules->add($rules->existsIn(['gender_list_id'], 'GenderLists'));
        $rules->add($rules->existsIn(['game_type_list_id'], 'GameTypeLists'));
        $rules->add($rules->existsIn(['age_group_list_id'], 'AgeGroupLists'));

        return $rules;
    }
}
