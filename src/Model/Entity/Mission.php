<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Mission Entity
 *
 * @property int $id
 * @property int $emergency_id
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $finish_date
 * @property string $region_mission
 * @property string $name
 * @property string $description
 * @property int $volunteers_quantity
 *
 * @property \App\Model\Entity\Emergency $emergency
 * @property \App\Model\Entity\Task[] $tasks
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Ability[] $abilities
 */
class Mission extends Entity
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
        '*' => true,
        'id' => false
    ];
}
