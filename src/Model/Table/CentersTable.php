<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Event\Event;

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
            'foreignKey' => 'center_id',
            'conditions' => ['delete_flag' => 0]
        ]);
        $this->hasMany('Documents', [
            'foreignKey' => 'center_id',
            'conditions' => ['device_id' => 0, 'delete_flag' => 0]
        ]);
        $this->hasMany('Photos', [
            'foreignKey' => 'center_id',
            'conditions' => ['device_id' => 0, 'delete_flag' => 0]
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
            ->scalar('map')
            ->maxLength('map', 256)
            ->allowEmptyString('map');

        $validator
            ->scalar('knowledge')
            ->maxLength('knowledge', 256)
            ->allowEmptyString('knowledge');

        $validator
            ->scalar('job')
            ->allowEmptyString('job');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->boolean('thermo_dry_flag')
            ->requirePresence('thermo_dry_flag', 'create')
            ->allowEmptyString('thermo_dry_flag', false);

        $validator
            ->boolean('thermo_chilled_flag')
            ->requirePresence('thermo_chilled_flag', 'create')
            ->allowEmptyString('thermo_chilled_flag', false);

        $validator
            ->boolean('thermo_frozen_flag')
            ->requirePresence('thermo_frozen_flag', 'create')
            ->allowEmptyString('thermo_frozen_flag', false);

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
    
    /**
     * 検索初期条件
     * @param Event $event
     * @param Query $query
     * @param type $options
     * @param type $primary
     * @return Query
     */
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
            $query->order([
                $this->alias().'.m_prefecture_id' => 'ASC',
                $this->alias().'.m_customer_id' => 'ASC',
                $this->alias().'.address' => 'ASC',
                "CASE WHEN ".$this->alias().".id = 88 THEN 0 ELSE 1 END" => 'ASC', // 埼玉チルドTPLだけ特別扱い（建屋で揃えるため）
                $this->alias().'.name' => 'ASC']);
        }
        
        return $query;
    }
    
    /**
     * 一覧検索finder
     * @param Query $query
     * @param type $options
     * @return Query
     */
    public function findSearch(Query $query, $options)
    {
        // 顧客
        if (isset($options['m_customer_id']) && !empty($options['m_customer_id']))
        {
            $query->where(['m_customer_id' => $options['m_customer_id']]);
        }
        // 都道府県
        if (isset($options['m_prefecture_id']) && !empty($options['m_prefecture_id']))
        {
            $query->where(['m_prefecture_id' => $options['m_prefecture_id']]);
        }
        else
        {
            // 地域
            if (isset($options['m_area_id']) && !empty($options['m_area_id']))
            {
                $sub = $this->MPrefectures->find()->where(['m_area_id' => $options['m_area_id']])->select('id');
                $query->where([$this->alias().'.m_prefecture_id IN' => $sub]);
            }
        }
        // 拠点名
        if (isset($options['name']) && !empty($options['name']))
        {
            // 建屋も考慮
            $tableMWarehouses = TableRegistry::getTableLocator()->get('MWarehouses');
            $mWarehouses = $tableMWarehouses->find()->where(['name LIKE' => '%'. $options['name']. '%']);
            $list = [];
            foreach($mWarehouses as $warehouse)
            {
                if ($warehouse->center_id_1) $list[] = $warehouse->center_id_1;
                if ($warehouse->center_id_2) $list[] = $warehouse->center_id_2;
                if ($warehouse->center_id_3) $list[] = $warehouse->center_id_3;
                if ($warehouse->center_id_4) $list[] = $warehouse->center_id_4;
                if ($warehouse->center_id_5) $list[] = $warehouse->center_id_5;
                if ($warehouse->center_id_6) $list[] = $warehouse->center_id_6;
                if ($warehouse->center_id_7) $list[] = $warehouse->center_id_7;
            }

            if ($list) 
            {
                $query->where(['OR' => [
                    [$this->alias().'.id IN' => $list],
                    ['Centers.name LIKE' => '%'. $options['name']. '%']
                    ]]);
            }
            else
            {
                $query->where(['Centers.name LIKE' => '%'. $options['name']. '%']);
            }
        }
        
        // 建屋
        if (isset($options['m_warehouse_id']) && !empty($options['m_warehouse_id']))
        {
            $tableMWarehouses = TableRegistry::getTableLocator()->get('MWarehouses');
            $warehouse = $tableMWarehouses->get(intval($options['m_warehouse_id']));
            $list = [];
            if ($warehouse->center_id_1) $list[] = $warehouse->center_id_1;
            if ($warehouse->center_id_2) $list[] = $warehouse->center_id_2;
            if ($warehouse->center_id_3) $list[] = $warehouse->center_id_3;
            if ($warehouse->center_id_4) $list[] = $warehouse->center_id_4;
            if ($warehouse->center_id_5) $list[] = $warehouse->center_id_5;
            if ($warehouse->center_id_6) $list[] = $warehouse->center_id_6;
            if ($warehouse->center_id_7) $list[] = $warehouse->center_id_7;
            
            if ($list) $query->where([$this->alias().'.id IN' => $list]);
        }
        
        // 削除フラグ
        if (isset($options['delete_flag']) && !empty($options['delete_flag']))
        {
            $query->where(['Centers.delete_flag >=' => '0']);
        }
        else
        {
            $query->where(['Centers.delete_flag =' => '0']);
        }
        
        return $query;
    }
}
