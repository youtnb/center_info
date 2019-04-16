<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MAreas Model
 *
 * @property \App\Model\Table\MPrefecturesTable|\Cake\ORM\Association\HasMany $MPrefectures
 *
 * @method \App\Model\Entity\MArea get($primaryKey, $options = [])
 * @method \App\Model\Entity\MArea newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MArea[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MArea|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MArea saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MArea patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MArea[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MArea findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MAreasTable extends Table
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

        $this->setTable('m_areas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MPrefectures', [
            'foreignKey' => 'm_area_id'
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
            ->boolean('delete_flag')
            ->requirePresence('delete_flag', 'create')
            ->allowEmptyString('delete_flag', false);

        return $validator;
    }
}
