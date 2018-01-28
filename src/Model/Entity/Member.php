<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Member Entity
 *
 * @property string $id
 * @property string $email
 * @property string $password
 *
 * @property \App\Model\Entity\Bond[] $bonds
 * @property \App\Model\Entity\Device[] $devices
 * @property \App\Model\Entity\Earning[] $earnings
 * @property \App\Model\Entity\Log[] $logs
 * @property \App\Model\Entity\Message[] $messages
 * @property \App\Model\Entity\Workout[] $workouts
 */
class Member extends Entity {

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
        'email' => true,
        'password' => true,
        'bonds' => true,
        'devices' => true,
        'earnings' => true,
        'logs' => true,
        'messages' => true,
        'workouts' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value) {
        return (new DefaultPasswordHasher)->hash($value);
    }

}
