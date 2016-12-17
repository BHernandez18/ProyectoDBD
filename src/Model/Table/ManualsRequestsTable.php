<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManualsRequests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Requests
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Manuals
 *
 * @method \App\Model\Entity\ManualsRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\ManualsRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ManualsRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ManualsRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManualsRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ManualsRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ManualsRequest findOrCreate($search, callable $callback = null)
 */
class ManualsRequestsTable extends Table
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

        $this->table('manuals_requests');
        $this->displayField('request_id');
        $this->primaryKey('request_id');


        $this->belongsTo('Requests', [
            'className' => 'Users',
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Manuals', [
            'foreignKey' => 'manual_id',
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
            ->dateTime('request_date')
            ->allowEmpty('request_date');

        $validator
            ->dateTime('devolution_date')
            ->allowEmpty('devolution_date');

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
        
        $rules->add($rules->existsIn(['user_id'], 'Requests'));
        $rules->add($rules->existsIn(['manual_id'], 'Manuals'));

        return $rules;
    }
}
