<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * MDepartments Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\HasMany $MUsers
 *
 * @method \App\Model\Entity\MDepartment get($primaryKey, $options = [])
 * @method \App\Model\Entity\MDepartment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MDepartment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MDepartment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MDepartment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MDepartment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MDepartment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MDepartment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MDepartmentsTable extends Table
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

        $this->setTable('m_departments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MUsers', [
            'foreignKey' => 'm_department_id'
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
            ->allowEmptyString('sort');

        return $validator;
    }
    
    public function beforeFind(Event $event ,Query $query, $options, $primary)
    {
        // where
        if(!isset($query->where))
        {
            //$query->where(['MDepartments.delete_flag' => 0]);
        }
        // order
        if(!isset($query->order))
        {
            $query->order(['MDepartments.sort' => 'ASC', 'MDepartments.id' => 'ASC']);
        }
        
        return $query;
    }
}
