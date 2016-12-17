<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ManualsRequest Entity
 *
 * @property int $request_id
 * @property int $user_id
 * @property int $manual_id
 * @property \Cake\I18n\Time $request_date
 * @property \Cake\I18n\Time $devolution_date
 *
 * @property \App\Model\Entity\User $request
 * @property \App\Model\Entity\Manual $manual
 */
class ManualsRequest extends Entity
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
        'request_id' => false
    ];
}
