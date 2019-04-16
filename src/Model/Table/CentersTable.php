<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Centers Model
 *
 * @property \App\Model\Table\MCustomersTable|\Cake\ORM\Association\BelongsTo $MCustomers
 * @property \App\Model\Table\MPrefecturesTable|\Cake\ORM\Association\BelongsTo $MPrefectures
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\HasMany $Devices
 *
 * @method \App\Model\Entity\Center get($primaryKey, $options = [])
 * @method \App\Model\Entity\Center newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Center[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Center|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Center saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Center patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Center[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Center findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CentersTable extends Table
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

        $this->setTable('centers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MCustomers', [
            'foreignKey' => 'm_customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MPrefectures', [
            'foreignKey' => 'm_prefecture_id'
        ]);
        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'center_id'
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
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 7)
            ->allowEmptyString('postcode');

        $validator
            ->scalar('address')
            ->maxLength('address', 200)
            ->allowEmptyString('address');

        $validator
            ->scalar('tel')
            ->maxLength('tel', 20)
            ->allowEmptyString('tel');

        $validator
            ->scalar('officer')
            ->maxLength('officer', 50)
            ->allowEmptyString('officer');

        $validator
            ->scalar('staff')
            ->maxLength('staff', 50)
            ->allowEmptyString('staff');

        $validator
            ->scalar('access')
            ->allowEmptyString('access');

        $validator
            ->scalar('job')
            ->allowEmptyString('job');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->boolean('shoes_flag')
            ->requirePresence('shoes_flag', 'create')
            ->allowEmptyString('shoes_flag', false);

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
        $rules->add($rules->existsIn(['m_customer_id'], 'MCustomers'));
        $rules->add($rules->existsIn(['m_prefecture_id'], 'MPrefectures'));
        $rules->add($rules->existsIn(['m_user_id'], 'MUsers'));

        return $rules;
    }
}
