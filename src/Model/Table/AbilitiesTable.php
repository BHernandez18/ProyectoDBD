<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Abilities Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Missions
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Ability get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ability newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ability[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ability|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ability patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ability[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ability findOrCreate($search, callable $callback = null)
 */
class AbilitiesTable extends Table
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

        $this->table('abilities');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsToMany('Missions', [
            'foreignKey' => 'ability_id',
            'targetForeignKey' => 'mission_id',
            'joinTable' => 'abilities_missions'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'ability_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'abilities_users'
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
}
