<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Missions
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $ManualsRequests
 * @property \Cake\ORM\Association\HasMany $Reports
 * @property \Cake\ORM\Association\BelongsToMany $Abilities
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Missions', [
            'foreignKey' => 'mission_id'
        ]);

        $this->belongsTo('Admins', [
            'className' => 'Users',
            'foreignKey' => 'adm_enc_id'
        ]);
        $this->hasMany('ManualsRequests', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Calls', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Abilities', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'ability_id',
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
            ->requirePresence('run', 'create')
            ->notEmpty('run')
            ->add('run', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('mail', 'create')
            ->notEmpty('mail');

        $validator
            ->allowEmpty('volunteer_state');

        $validator
            ->allowEmpty('user_type');

        $validator
            ->integer('age')
            ->requirePresence('age', 'create')
            ->notEmpty('age');

        $validator
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->requirePresence('genre', 'create')
            ->notEmpty('genre');

        $validator
            ->allowEmpty('phone');

        $validator
            ->requirePresence('region', 'create')
            ->notEmpty('region');

        $validator
            ->integer('score')
            ->allowEmpty('score');

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('user_type', 'inList', [
                'rule' => ['inList', ['admin', 'volunteer', 'manager']],
                'message' => 'Please enter a valid user type'
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
        $rules->add($rules->isUnique(['run']));
        $rules->add($rules->existsIn(['mission_id'], 'Missions'));
        $rules->add($rules->existsIn(['adm_enc_id'], 'Admins'));

        return $rules;
    }
}
