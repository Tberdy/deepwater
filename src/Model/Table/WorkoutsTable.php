<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workouts Model
 *
 * @property \App\Model\Table\MembersTable|\Cake\ORM\Association\BelongsTo $Members
 * @property \App\Model\Table\ContestsTable|\Cake\ORM\Association\BelongsTo $Contests
 * @property \App\Model\Table\LogsTable|\Cake\ORM\Association\HasMany $Logs
 *
 * @method \App\Model\Entity\Workout get($primaryKey, $options = [])
 * @method \App\Model\Entity\Workout newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Workout[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Workout|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Workout patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Workout[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Workout findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkoutsTable extends Table
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

        $this->setTable('workouts');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Contests', [
            'foreignKey' => 'contest_id'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'workout_id'
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
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->scalar('location_name')
            ->maxLength('location_name', 45)
            ->requirePresence('location_name', 'create')
            ->notEmpty('location_name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->scalar('sport')
            ->maxLength('sport', 45)
            ->requirePresence('sport', 'create')
            ->notEmpty('sport');

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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['contest_id'], 'Contests'));

        return $rules;
    }
}
