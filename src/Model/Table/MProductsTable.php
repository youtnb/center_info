<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * MProducts Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\DevicesTable|\Cake\ORM\Association\HasMany $Devices
 *
 * @method \App\Model\Entity\MProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\MProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MProduct saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MProductsTable extends Table
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

        $this->setTable('m_products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'm_product_id'
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
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

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
            $query->order([$this->alias().'.sort' => 'ASC', $this->alias().'.id' => 'ASC']);
        }
        
        return $query;
    }
}
