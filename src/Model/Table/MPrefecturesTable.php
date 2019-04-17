<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * MPrefectures Model
 *
 * @property \App\Model\Table\MAreasTable|\Cake\ORM\Association\BelongsTo $MAreas
 * @property \App\Model\Table\CentersTable|\Cake\ORM\Association\HasMany $Centers
 *
 * @method \App\Model\Entity\MPrefecture get($primaryKey, $options = [])
 * @method \App\Model\Entity\MPrefecture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MPrefecture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MPrefecture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MPrefecture saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MPrefecture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MPrefecture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MPrefecture findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MPrefecturesTable extends Table
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

        $this->setTable('m_prefectures');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MAreas', [
            'foreignKey' => 'm_area_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Centers', [
            'foreignKey' => 'm_prefecture_id'
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
            ->maxLength('name', 10)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

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
        $rules->add($rules->existsIn(['m_area_id'], 'MAreas'));

        return $rules;
    }
    
    public function beforeFind(Event $event ,Query $query, $options, $primary)
    {
        // where
        if(!isset($query->order)){
            $query->where(['MPrefectures.delete_flag' => 0]);
        }
        // order
        if(!isset($query->order)){
            $query->order(['MPrefectures.id' => 'ASC']);
        }
        
        return $query;
    }
}
