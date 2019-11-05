<?php
namespace Stock\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StockOut Model
 *
 * @property \Stock\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \Stock\Model\Entity\StockOut get($primaryKey, $options = [])
 * @method \Stock\Model\Entity\StockOut newEntity($data = null, array $options = [])
 * @method \Stock\Model\Entity\StockOut[] newEntities(array $data, array $options = [])
 * @method \Stock\Model\Entity\StockOut|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Stock\Model\Entity\StockOut saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Stock\Model\Entity\StockOut patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Stock\Model\Entity\StockOut[] patchEntities($entities, array $data, array $options = [])
 * @method \Stock\Model\Entity\StockOut findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StockOutTable extends Table
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

        $this->setTable('stock_out');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Stock.StockManager');

        $this->belongsTo('Stock.Products', [
            'foreignKey' => 'product_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * Application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));

        return $rules;
    }
}
