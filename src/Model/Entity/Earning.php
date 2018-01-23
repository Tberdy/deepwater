<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Earning Entity
 *
 * @property int $id
 * @property string $member_id
 * @property int $sticker_id
 * @property \Cake\I18n\FrozenTime $date
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Sticker $sticker
 */
class Earning extends Entity
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
        'member_id' => true,
        'sticker_id' => true,
        'date' => true,
        'member' => true,
        'sticker' => true
    ];
}
