<?php

namespace App\Services;

use App\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    
    /**
     * Get a paginated list of users.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function list($perPage = 10): LengthAwarePaginator
    {
        return Users::paginate($perPage);
    }
    /**
     * Create a new user.
     *
     * @param array $userData
     * @return Users
     */
    public function store(array $userData): Users
    {
        // Validate or sanitize $userData as needed

        // Create a new user instance
        $user = new Users();
        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->suffixname = $userData['suffixname'];
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']); // Hash the password securely
        // Set other user attributes as needed

        // Save the user to the database
        $user->save();

        return $user;
    }


    /**
     * Find a user by ID.
     *
     * @param int $userId
     * @return User|null
     */
    public function find($userId): ?Users
    {
        return Users::find($userId);
    }
     /**
     * Update a user's information.
     *
     * @param int $userId
     * @param array $userData
     * @return User|null
     */
    public function update($userId, array $userData): ?Users
    {
        $user = Users::find($userId);

        if (!$user) {
            return null; // Or throw an exception if needed
        }

        $user->fill($userData);
        $user->save();

        return $user;
    }
     /**
     * Delete a user by ID.
     *
     * @param int $userId
     * @return bool|null
     */
    public function destroy($userId): ?bool
    {
        $user = Users::find($userId);

        if (!$user) {
            return null; // Or throw an exception if needed
        }

        return $user->delete();
    }
}