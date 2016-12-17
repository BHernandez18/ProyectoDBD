<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Task Entity
 *
 * @property int $id
 * @property int $mission_id
 * @property string $state
 * @property string $name
 * @property string $description
 *
 * @property \App\Model\Entity\Mission $mission
 * @property \App\Model\Entity\Call[] $calls
 * @property \App\Model\Entity\Manual[] $manuals
 * @property \App\Model\Entity\Report[] $reports
 */
class Task extends Entity
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
