<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Missions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Emergencies
 * @property \Cake\ORM\Association\HasMany $Tasks
 * @property \Cake\ORM\Association\HasMany $Users
 * @property \Cake\ORM\Association\BelongsToMany $Abilities
 *
 * @method \App\Model\Entity\Mission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mission findOrCreate($search, callable $callback = null)
 */
class MissionsTable extends Table
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

        $this->table('missions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Emergencies', [
            'foreignKey' => 'emergency_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Tasks', [
            'foreignKey' => 'mission_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'mission_id'
        ]);
        $this->belongsToMany('Abilities', [
            'foreignKey' => 'mission_id',
            'targetForeignKey' => 'ability_id',
            'joinTable' => 'abilities_missions'
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
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('finish_date')
            ->allowEmpty('finish_date');

        $validator
            ->allowEmpty('region_mission');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('volunteers_quantity')
            ->allowEmpty('volunteers_quantity');

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
        $rules->add($rules->existsIn(['emergency_id'], 'Emergencies'));

        return $rules;
    }
}
