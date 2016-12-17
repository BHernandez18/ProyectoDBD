<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Call Entity
 *
 * @property int $id
 * @property int $manager_id
 * @property int $volunteer_id
 * @property int $task_id
 * @property \Cake\I18n\Time $date
 * @property int $state
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Task $task
 */
class Call extends Entity
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
