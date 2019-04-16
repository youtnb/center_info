<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MUsers Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\CentersTable|\Cake\ORM\Association\HasMany $Centers
 * @property \App\Model\Table\CommentsTable|\Cake\ORM\Association\HasMany $Comments
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\HasMany $Devices
 * @property \App\Model\Table\MCustomersTable|\Cake\ORM\Association\HasMany $MCustomers
 * @property \App\Model\Table\MDeviceTypesTable|\Cake\ORM\Association\HasMany $MDeviceTypes
 * @property \App\Model\Table\MOperationSystemsTable|\Cake\ORM\Association\HasMany $MOperationSystems
 * @property \App\Model\Table\MProductsTable|\Cake\ORM\Association\HasMany $MProducts
 * @property \App\Model\Table\MSqlserversTable|\Cake\ORM\Association\HasMany $MSqlservers
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\HasMany $MUsers
 * @property \App\Model\Table\MVersionsTable|\Cake\ORM\Association\HasMany $MVersions
 *
 * @method \App\Model\Entity\MUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\MUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MUsersTable extends Table
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

        $this->setTable('m_users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Centers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MCustomers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MDeviceTypes', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MOperationSystems', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MProducts', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MSqlservers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('MVersions', [
            'foreignKey' => 'm_user_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('login')
            ->maxLength('login', 256)
            ->requirePresence('login', 'create')
            ->allowEmptyString('login', false);

        $validator
            ->scalar('password')
            ->maxLength('password', 256)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->boolean('delete_flag')
            ->requirePresence('delete_flag', 'create')
            ->allowEmptyString('delete_flag', false);

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
        $rules->add($rules->isUnique(['login']));
        $rules->add($rules->existsIn(['m_user_id'], 'MUsers'));

        return $rules;
    }
}
