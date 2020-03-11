<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $RegistercandidateEventactivity
 * @property |\Cake\ORM\Association\HasMany $ReportingLists
 * @property \App\Model\Table\SocialAccountsTable|\Cake\ORM\Association\HasMany $SocialAccounts
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ReportingLists', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id'
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
            ->scalar('username')
            ->allowEmpty('username');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('password')
            ->allowEmpty('password');

        $validator
            ->scalar('first_name')
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('token')
            ->allowEmpty('token');

        $validator
            ->dateTime('token_expires')
            ->allowEmpty('token_expires');

        $validator
            ->scalar('api_token')
            ->allowEmpty('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmpty('activation_date');

        $validator
            ->dateTime('tos_date')
            ->allowEmpty('tos_date');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->boolean('is_superuser')
            ->allowEmpty('is_superuser');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        $validator
            ->scalar('secret')
            ->allowEmpty('secret');

        $validator
            ->boolean('secret_verified')
            ->allowEmpty('secret_verified');

        $validator
            ->date('dob')
            ->allowEmpty('dob');

        $validator
            ->decimal('phone_no')
            ->allowEmpty('phone_no');

        $validator
            ->integer('action_by')
            ->allowEmpty('action_by');

        $validator
            ->scalar('action_ip')
            ->allowEmpty('action_ip');

        $validator
            ->boolean('password_changed')
            ->allowEmpty('password_changed');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
