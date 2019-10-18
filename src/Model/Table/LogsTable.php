<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Logs Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 *
 * @method \App\Model\Entity\Log get($primaryKey, $options = [])
 * @method \App\Model\Entity\Log newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Log[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Log|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Log saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Log patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Log[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Log findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogsTable extends Table
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

        $this->setTable('logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUsers', [
            'foreignKey' => 'm_user_id',
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->allowEmptyString('type');

        $validator
            ->scalar('content')
            ->allowEmptyString('content');

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
        // order
        $order = $query->clause('order');
        if ($order === null || !count($order))
        {
            $query->order([$this->alias().'.created' => 'DESC']);
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
        // 半角数字8文字ならOKとする

        // FROM
        if (isset($options['created_from']) && !empty($options['created_from']))
        {
            $from = $options['created_from'];
            if (preg_match("/^[0-9]+$/", $from))
            {
                if (strlen($from) == 8) $query->where([$this->alias().'.created >=' => $from. '000000']);
                if (strlen($from) == 12) $query->where([$this->alias().'.created >=' => $from. '00']);
            }
        }
        // TO
        if (isset($options['created_to']) && !empty($options['created_to']))
        {
            $to = $options['created_to'];
            if (preg_match("/^[0-9]+$/", $to))
            {
                if (strlen($to) == 8) $query->where([$this->alias().'.created <=' => $to. '235959']);
                if (strlen($to) == 12) $query->where([$this->alias().'.created <=' => $to. '59']);
            }
        }
        
        return $query;
    }
}
