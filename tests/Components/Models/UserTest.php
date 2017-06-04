<?php

namespace Tests\Components\Models;

use App\Models\Reply;
use App\Models\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_can_return_the_amount_of_solutions_that_were_given()
    {
        $user = factory(User::class)->create();
        $this->seedTwoSolutionReplies($user);

        $this->assertEquals(2, $user->countSolutions());
    }

    private function seedTwoSolutionReplies(User $user)
    {
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create(['replyable_id' => $thread->id(), 'author_id' => $user->id()]);
        $thread->markSolution($reply);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create(['replyable_id' => $thread->id(), 'author_id' => $user->id()]);
        $thread->markSolution($reply);
    }
}