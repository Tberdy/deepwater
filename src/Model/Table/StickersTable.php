<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stickers Model
 *
 * @property \App\Model\Table\EarningsTable|\Cake\ORM\Association\HasMany $Earnings
 *
 * @method \App\Model\Entity\Sticker get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sticker newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Sticker[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sticker|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sticker patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sticker[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sticker findOrCreate($search, callable $callback = null, $options = [])
 */
class StickersTable extends Table
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

        $this->setTable('stickers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Earnings', [
            'foreignKey' => 'sticker_id'
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
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        return $validator;
    }
}
