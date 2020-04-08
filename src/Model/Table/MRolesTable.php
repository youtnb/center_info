<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * MRoles Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\HasMany $MUsers
 *
 * @method \App\Model\Entity\MRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\MRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MRole saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MRole findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MRolesTable extends Table
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

        $this->setTable('m_roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MUsers', [
            'foreignKey' => 'm_role_id'
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

        return $validator;
    }
    
    public function beforeFind(Event $event ,Query $query, $options, $primary)
    {
        // where
        // delete_flag なし
        
        // order
        $order = $query->clause('order');
        if ($order === null || !count($order))
        {
            $query->order([$this->alias().'.id' => 'ASC']);
        }
        
        return $query;
    }
}
