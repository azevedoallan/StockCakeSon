<?php
namespace Stock\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property float $cost
 * @property int $status
 * @property string|null $description
 * @property int $alert_quantity
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Stock[] $stock
 * @property \App\Model\Entity\StockIn[] $stock_in
 * @property \App\Model\Entity\StockOut[] $stock_out
 * @property \App\Model\Entity\Category[] $categories
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'price' => true,
        'cost' => true,
        'status' => true,
        'description' => true,
        'alert_quantity' => true,
        'created' => true,
        'modified' => true,
        'stock' => true,
        'stock_in' => true,
        'stock_out' => true,
        'categories' => true
    ];
}
