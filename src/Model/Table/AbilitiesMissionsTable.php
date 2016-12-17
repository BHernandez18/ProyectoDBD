<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AbilitiesMissions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Missions
 * @property \Cake\ORM\Association\BelongsTo $Abilities
 *
 * @method \App\Model\Entity\AbilitiesMission get($primaryKey, $options = [])
 * @method \App\Model\Entity\AbilitiesMission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AbilitiesMission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AbilitiesMission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AbilitiesMission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AbilitiesMission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AbilitiesMission findOrCreate($search, callable $callback = null)
 */
class AbilitiesMissionsTable extends Table
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

        $this->table('abilities_missions');
        $this->displayField('mission_id');
        $this->primaryKey(['mission_id', 'ability_id']);

        $this->belongsTo('Missions', [
            'foreignKey' => 'mission_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Abilities', [
            'foreignKey' => 'ability_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['mission_id'], 'Missions'));
        $rules->add($rules->existsIn(['ability_id'], 'Abilities'));

        return $rules;
    }
}
