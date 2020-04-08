<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * MOperationSystems Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\HasMany $Devices
 *
 * @method \App\Model\Entity\MOperationSystem get($primaryKey, $options = [])
 * @method \App\Model\Entity\MOperationSystem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MOperationSystem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MOperationSystem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MOperationSystem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MOperationSystem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MOperationSystem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MOperationSystem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MOperationSystemsTable extends Table
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

        $this->setTable('m_operation_systems');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'm_operation_system_id'
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
            ->boolean('server_flag')
            ->requirePresence('server_flag', 'create')
            ->allowEmptyString('server_flag', false);

        $validator
            ->scalar('background_color')
            ->maxLength('background_color', 7)
            ->requirePresence('background_color', 'create')
            ->allowEmptyString('background_color', false);

        $validator
            ->allowEmptyString('sort');

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
            $query->order([$this->alias().'.server_flag' => 'DESC', $this->alias().'.sort' => 'ASC', $this->alias().'.id' => 'ASC']);
        }
        
        return $query;
    }
}
