<?php
namespace Stock\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \Stock\Model\Table\StockTable&\Cake\ORM\Association\HasMany $Stock
 * @property \Stock\Model\Table\StockInTable&\Cake\ORM\Association\HasMany $StockIn
 * @property \Stock\Model\Table\StockOutTable&\Cake\ORM\Association\HasMany $StockOut
 * @property \Stock\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsToMany $Categories
 *
 * @method \Stock\Model\Entity\Product get($primaryKey, $options = [])
 * @method \Stock\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \Stock\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \Stock\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Stock\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Stock\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Stock\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \Stock\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('Stock.Stock', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->hasMany('Stock.StockIn', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->hasMany('Stock.StockOut', [
            'foreignKey' => 'product_id',
            'dependent' => true
        ]);
        $this->belongsToMany('Stock.Categories', [
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_products'
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
            ->scalar('title')
            ->maxLength('title', 100)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->decimal('cost')
            ->requirePresence('cost', 'create')
            ->notEmptyString('cost');

        $validator
            ->integer('status')
            ->notEmptyString('status');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('alert_quantity')
            ->notEmptyString('alert_quantity');

        return $validator;
    }
}
