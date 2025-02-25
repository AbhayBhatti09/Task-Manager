<?php
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase; // Ensures the database is reset before each test

    /** @test */
    public function test_user_can_login_with_correct_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Attempt to login
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Assert the user is authenticated and redirected
        $this->assertAuthenticated();
        $response->assertRedirect('/home'); 
    }

    /** @test */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Attempt to login with wrong password
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert the user is not authenticated
        $this->assertGuest();
        $response->assertSessionHasErrors('email'); // Laravel returns errors in session
    }

    /** @test */
    public function test_user_cannot_login_with_non_existing_email()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password1234'),
        ]);
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }
}
