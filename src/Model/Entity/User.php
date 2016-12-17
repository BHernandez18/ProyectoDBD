<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property int $mission_id
 * @property int $adm_enc_id
 * @property string $name
 * @property int $age
 * @property string $address
 * @property string $run
 * @property string $genre
 * @property string $phone
 * @property string $region
 * @property string $mail
 * @property int $score
 * @property int $volunteer_state
 * @property string $user_type
 * @property string $password
 * @property string $username
 *
 * @property \App\Model\Entity\Mission $mission
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ManualsRequest[] $manuals_requests
 * @property \App\Model\Entity\Report[] $reports
 * @property \App\Model\Entity\Ability[] $abilities
 */
class User extends Entity
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
    protected $_accessible = ['*' => true];
    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
