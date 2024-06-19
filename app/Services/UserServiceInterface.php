<?php
namespace App\Services;

interface UserServiceInterface
{

	 /**
     * Get a paginated list of users.
     *
     * @param int $perPage
     */
    public function list($perPage = 10);
	 /**
     * Create a new user.
     *
     * @param array $userData
     */
    public function store(array $userData);
	
    /**
     * Find a user by ID.
     *
     * @param int $userId
     */
    public function find($userId);
	 /**
     * Update a user's information.
     *
     * @param int $userId
     * @param array $userData
     */
    public function update($userId, array $userData);
	 /**
     * Delete a user by ID.
     *
     * @param int $userId
     */
    public function destroy($userId);
}
