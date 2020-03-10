<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\MsCountriesTable|\Cake\ORM\Association\BelongsTo $MsCountries
 * @property \App\Model\Table\MsStatesTable|\Cake\ORM\Association\BelongsTo $MsStates
 * @property \App\Model\Table\MsDistrictsTable|\Cake\ORM\Association\BelongsTo $MsDistricts
 * @property \App\Model\Table\AvailabilitiesTable|\Cake\ORM\Association\BelongsTo $Availabilities
 * @property \App\Model\Table\SocialAccountsTable|\Cake\ORM\Association\HasMany $SocialAccounts
 * @property \App\Model\Table\UserContributionTypesTable|\Cake\ORM\Association\HasMany $UserContributionTypes
 * @property \App\Model\Table\UserGroupRolesTable|\Cake\ORM\Association\HasMany $UserGroupRoles
 * @property \App\Model\Table\UserRolesTable|\Cake\ORM\Association\HasMany $UserRoles
 * @property \App\Model\Table\UserTasksTable|\Cake\ORM\Association\HasMany $UserTasks
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

//        $this->belongsTo('MsCountries', [
//            'foreignKey' => 'ms_country_id'
//        ]);
//        $this->belongsTo('MsStates', [
//            'foreignKey' => 'ms_state_id'
//        ]);
//        $this->belongsTo('MsDistricts', [
//            'foreignKey' => 'ms_district_id'
//        ]);
//        $this->belongsTo('Availabilities', [
//            'foreignKey' => 'availability_id'
//        ]);
        $this->hasMany('SocialAccounts', [
            'foreignKey' => 'user_id'
        ]);
//        $this->hasMany('UserContributionTypes', [
//            'foreignKey' => 'user_id'
//        ]);
//        $this->hasMany('UserGroupRoles', [
//            'foreignKey' => 'user_id'
//        ]);
//        $this->hasMany('UserRoles', [
//            'foreignKey' => 'user_id'
//        ]);
//        $this->hasMany('UserTasks', [
//            'foreignKey' => 'user_id'
//        ]);
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
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password');

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
            ->requirePresence('token', 'create')
            ->notEmpty('token');

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
            ->integer('phone_no')
            ->allowEmpty('phone_no');

        $validator
            ->integer('action_by')
            ->allowEmpty('action_by');

        $validator
            ->scalar('action_ip')
            ->allowEmpty('action_ip');

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
        $rules->add($rules->existsIn(['ms_country_id'], 'MsCountries'));
        $rules->add($rules->existsIn(['ms_state_id'], 'MsStates'));
        $rules->add($rules->existsIn(['ms_district_id'], 'MsDistricts'));
        $rules->add($rules->existsIn(['availability_id'], 'Availabilities'));

        return $rules;
    }
}
