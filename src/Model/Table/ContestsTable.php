<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contests Model
 *
 * @property \App\Model\Table\WorkoutsTable|\Cake\ORM\Association\HasMany $Workouts
 *
 * @method \App\Model\Entity\Contest get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Contest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contest findOrCreate($search, callable $callback = null, $options = [])
 */
class ContestsTable extends Table
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

        $this->setTable('contests');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Workouts', [
            'foreignKey' => 'contest_id',
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
            ->scalar('name')
            ->maxLength('name', 45)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('type')
            ->maxLength('type', 45)
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->scalar('description')
            ->maxLength('description', 45)
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
