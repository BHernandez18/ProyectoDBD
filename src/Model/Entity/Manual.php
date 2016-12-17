<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Manual Entity
 *
 * @property int $id
 * @property int $task_id
 * @property string $name
 *
 * @property \App\Model\Entity\Task $task
 * @property \App\Model\Entity\ManualsRequest[] $manuals_requests
 */
class Manual extends Entity
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
