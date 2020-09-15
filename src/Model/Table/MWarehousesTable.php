<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MWarehouses Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 *
 * @method \App\Model\Entity\MWarehouse get($primaryKey, $options = [])
 * @method \App\Model\Entity\MWarehouse newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MWarehouse[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MWarehouse|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MWarehouse saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MWarehouse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MWarehouse[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MWarehouse findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MWarehousesTable extends Table
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

        $this->setTable('m_warehouses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUsers', [
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
            ->scalar('icon')
            ->maxLength('icon', 5)
            ->allowEmptyString('icon');

        $validator
            ->allowEmptyString('center_id_1');

        $validator
            ->allowEmptyString('center_id_2');

        $validator
            ->allowEmptyString('center_id_3');

        $validator
            ->allowEmptyString('center_id_4');

        $validator
            ->allowEmptyString('center_id_5');

        $validator
            ->allowEmptyString('center_id_6');

        $validator
            ->allowEmptyString('center_id_7');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

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
        $rules->add($rules->existsIn(['m_user_id'], 'MUsers'));

        return $rules;
    }
}
