<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property int $id
 * @property string $member_id
 * @property string $member2_id
 * @property \Cake\I18n\FrozenTime $date
 * @property string $name
 * @property string $description
 * @property bool $read
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Member2 $member2
 */
class Message extends Entity
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
        'member2_id' => true,
        'date' => true,
        'name' => true,
        'description' => true,
        'read' => true,
        'member' => true,
        'member2' => true
    ];
}
