<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Manuals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tasks
 * @property \Cake\ORM\Association\HasMany $ManualsRequests
 *
 * @method \App\Model\Entity\Manual get($primaryKey, $options = [])
 * @method \App\Model\Entity\Manual newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Manual[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Manual|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manual patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Manual[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Manual findOrCreate($search, callable $callback = null)
 */
class ManualsTable extends Table
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

        $this->table('manuals');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Tasks', [
            'foreignKey' => 'task_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ManualsRequests', [
            'foreignKey' => 'manual_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name');

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
        $rules->add($rules->existsIn(['task_id'], 'Tasks'));

        return $rules;
    }
}
