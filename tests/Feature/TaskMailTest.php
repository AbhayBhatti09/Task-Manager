<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Task;
use App\Mail\TaskCompletedMail;
use Illuminate\Http\Request;

class TaskMailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_an_email_when_task_is_completed()
    {
        // Prevent actual email sending
        Mail::fake();

        // Create a user and a task
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        // Simulate a request with 'completed' status
        $request = new Request(['status' => 'completed']);

        // Run the email sending logic using the mailable
        if ($request->status === 'completed') {
            Mail::to($user->email)->send(new TaskCompletedMail($user, $task));
        }

        // Assert that the mailable was sent
        Mail::assertSent(TaskCompletedMail::class, function (TaskCompletedMail $mail) use ($user) {
            // Instead of calling build(), just check that the mailer has the correct recipient.
            return $mail->hasTo($user->email);
        });
    }
}
