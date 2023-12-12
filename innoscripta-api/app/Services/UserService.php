<?php


namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use App\Models\UserPreference;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{

    /**
     * @inheritDoc
     */
    public function preferences()
    {
        return resolve(UserRepositoryInterface::class)->preferences();
    }

    /**
     * @inheritDoc
     */
    public function sources()
    {
        return resolve(UserRepositoryInterface::class)->sources();
    }

    /**
     * @param string $type
     * @param string $preference
     * @return mixed
     */
    public function addPreferences(string $type,string $preference)
    {
        return resolve(UserRepositoryInterface::class)->addPreferences($type,$preference);
    }

    /**
     * @return UserPreference
     */
    public function deletePreferences($id)
    {
        return resolve(UserRepositoryInterface::class)->deletePreferences($id);
    }

    /**
     * @inheritDoc
     */
    public function news($requests)
    {
        return resolve(UserRepositoryInterface::class)->news($requests);
    }

}
