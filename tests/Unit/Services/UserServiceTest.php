<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\UserService;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class UserServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker; // Reset the database after each test and use fake data

     /**
     * Test retrieving a paginated list of users through UserService.
     *
     * @return void
     */
    public function test_it_can_return_a_paginated_list_of_users()
    {
        // Create mock users for testing pagination
        Users::factory()->count(20)->create();

        $userService = new UserService();

        // Get paginated users (default perPage = 10)
        $paginatedUsers = $userService->list();

        // Assert pagination meta data
        $this->assertEquals(10, $paginatedUsers->perPage()); // Check default perPage
        $this->assertEquals(20, $paginatedUsers->total()); // Total count of users
        // Add more assertions as needed based on your pagination configuration
    }
    
    /**
     * Test creating a new user through UserService.
     *
     * @return void
     */
    public function test_it_can_store_a_user_to_database()
    {
        $userService = new UserService();

        $userData = [
            'firstname' => 'John',
            'lastname' => fake()->lastname(),
            'suffixname' => 'Mr',
            'username' => 'john.doe@example.com',
            'email' => 'john.doe@example.com',
            'password' => 'password', // Note: bcrypt() is not used in tests
            // Add other fields as needed
        ];

        $user = $userService->store($userData);

        // Assert that the user was created and persisted in the database
        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);

        // Optionally, assert that the returned user object matches expectations
        $this->assertInstanceOf(Users::class, $user);
        $this->assertEquals('John', $user->firstname);
        // Add more assertions as needed
    }
    /**
     * Test finding a user by ID through UserService.
     *
     * @return void
     */
    public function test_it_can_find_and_return_an_existing_user()
    {
        // Create a mock user
        $user = Users::factory()->create();

        $userService = new UserService();

        // Retrieve the user by ID
        $foundUser = $userService->find($user->id);

        // Assert the user is found and matches the created user
        $this->assertInstanceOf(Users::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
        $this->assertEquals($user->email, $foundUser->email);
        // Add more assertions as needed
    }
    /**
     * Test updating a user through UserService.
     *
     * @return void
     */
    public function test_UpdateUser()
    {
        // Create a mock user
        $user = Users::factory()->create();

        $userService = new UserService();

        // Update user information
        $updatedData = [
            'firstname' => 'Updated Firstname',
            'email' => 'updated.email@example.com',
        ];

        $updatedUser = $userService->update($user->id, $updatedData);

        // Assert the user is updated and matches the updated data
        $this->assertInstanceOf(Users::class, $updatedUser);
        $this->assertEquals($user->id, $updatedUser->id);
        $this->assertEquals($updatedData['firstname'], $updatedUser->firstname);
        $this->assertEquals($updatedData['email'], $updatedUser->email);
        // Add more assertions as needed
    }
     /**
     * Test deleting a user through UserService.
     *
     * @return void
     */
    public function test_it_can_soft_delete_an_existing_user()
    {
        // Create a mock user
        $user = Users::factory()->create();

        $userService = new UserService();

        // Delete the user
        $result = $userService->destroy($user->id);

        // Assert that the deletion was successful
        $this->assertTrue($result);

        // Assert that the user no longer exists in the database
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
   
}