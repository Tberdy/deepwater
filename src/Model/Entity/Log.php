<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Log Entity
 *
 * @property int $id
 * @property string $member_id
 * @property int $workout_id
 * @property int $device_id
 * @property \Cake\I18n\FrozenTime $date
 * @property float $location_latitude
 * @property float $location_logitude
 * @property string $log_type
 * @property int $log_value
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Workout $workout
 * @property \App\Model\Entity\Device $device
 */
class Log extends Entity
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
        'workout_id' => true,
        'device_id' => true,
        'date' => true,
        'location_latitude' => true,
        'location_logitude' => true,
        'log_type' => true,
        'log_value' => true,
        'member' => true,
        'workout' => true,
        'device' => true
    ];
}
