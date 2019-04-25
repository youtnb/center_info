<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Devices Model
 *
 * @property \App\Model\Table\CentersTable|\Cake\ORM\Association\BelongsTo $Centers
 * @property \App\Model\Table\MDeviceTypesTable|\Cake\ORM\Association\BelongsTo $MDeviceTypes
 * @property \App\Model\Table\MOperationSystemsTable|\Cake\ORM\Association\BelongsTo $MOperationSystems
 * @property \App\Model\Table\MSqlserversTable|\Cake\ORM\Association\BelongsTo $MSqlservers
 * @property \App\Model\Table\MProductsTable|\Cake\ORM\Association\BelongsTo $MProducts
 * @property \App\Model\Table\MVersionsTable|\Cake\ORM\Association\BelongsTo $MVersions
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\CommentsTable|\Cake\ORM\Association\HasMany $Comments
 *
 * @method \App\Model\Entity\Device get($primaryKey, $options = [])
 * @method \App\Model\Entity\Device newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Device[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Device|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Device saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Device patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Device[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Device findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DevicesTable extends Table
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

        $this->setTable('devices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Centers', [
            'foreignKey' => 'center_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MDeviceTypes', [
            'foreignKey' => 'm_device_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MOperationSystems', [
            'foreignKey' => 'm_operation_system_id'
        ]);
        $this->belongsTo('MSqlservers', [
            'foreignKey' => 'm_sqlserver_id'
        ]);
        $this->belongsTo('MProducts', [
            'foreignKey' => 'm_product_id'
        ]);
        $this->belongsTo('MVersions', [
            'foreignKey' => 'm_version_id'
        ]);
        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'device_id'
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
            ->scalar('accepted_no')
            ->maxLength('accepted_no', 15)
            ->allowEmptyString('accepted_no');
        
        $validator
            ->scalar('name')
            ->maxLength('name', 50)
            ->allowEmptyString('name');

        $validator
            ->scalar('ip_higher')
            ->maxLength('ip_higher', 15)
            ->allowEmptyString('ip_higher');

        $validator
            ->scalar('ip_lower')
            ->maxLength('ip_lower', 15)
            ->allowEmptyString('ip_lower');

        $validator
            ->boolean('reserve_flag')
            ->requirePresence('reserve_flag', 'create')
            ->allowEmptyString('reserve_flag', false);

        $validator
            ->boolean('security_flag')
            ->requirePresence('security_flag', 'create')
            ->allowEmptyString('security_flag', false);

        $validator
            ->scalar('model')
            ->maxLength('model', 50)
            ->allowEmptyString('model');

        $validator
            ->scalar('serial_no')
            ->maxLength('serial_no', 50)
            ->allowEmptyString('serial_no');

        $validator
            ->date('support_end_date')
            ->allowEmptyDate('support_end_date');

        $validator
            ->date('setup_date')
            ->allowEmptyDate('setup_date');

        $validator
            ->scalar('admin_pass')
            ->maxLength('admin_pass', 50)
            ->allowEmptyString('admin_pass');

        $validator
            ->scalar('custom')
            ->allowEmptyString('custom');

        $validator
            ->scalar('connect')
            ->maxLength('connect', 100)
            ->allowEmptyString('connect');

        $validator
            ->scalar('remote')
            ->maxLength('remote', 100)
            ->allowEmptyString('remote');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->boolean('running_flag')
            ->requirePresence('running_flag', 'create')
            ->allowEmptyString('running_flag', false);

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
        $rules->add($rules->existsIn(['center_id'], 'Centers'));
        $rules->add($rules->existsIn(['m_device_type_id'], 'MDeviceTypes'));
        $rules->add($rules->existsIn(['m_operation_system_id'], 'MOperationSystems'));
        $rules->add($rules->existsIn(['m_sqlserver_id'], 'MSqlservers'));
        $rules->add($rules->existsIn(['m_product_id'], 'MProducts'));
        $rules->add($rules->existsIn(['m_version_id'], 'MVersions'));
        $rules->add($rules->existsIn(['m_user_id'], 'MUsers'));

        return $rules;
    }
    
    public function beforeFind(Event $event ,Query $query, $options, $primary)
    {
        // where
        $where = $query->clause('where');
        if ($where === null || !count($where))
        {
            $query->where([$this->alias().'.delete_flag' => 0]);
        }
        // order
        $order = $query->clause('order');
        if ($order === null || !count($order))
        {
            $query->order([$this->alias().'.center_id' => 'ASC', $this->alias().'.m_device_type_id' => 'ASC', $this->alias().'.id' => 'ASC']);
        }
        
        return $query;
    }
}
