<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Device Entity
 *
 * @property int $id
 * @property string $member_id
 * @property string $serial
 * @property string $description
 * @property bool $trusted
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Log[] $logs
 */
class Device extends Entity
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
        'serial' => true,
        'description' => true,
        'trusted' => true,
        'member' => true,
        'logs' => true
    ];
}
