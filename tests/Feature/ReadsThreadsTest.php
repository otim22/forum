<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReadsThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /** @test  */
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads')
                ->assertSee($this->thread->title);
    }

    /** @test  */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get($this->thread->path())
                ->assertSee($this->thread->title);
    }

    /** @test  */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test  */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $ThreadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $ThreadNotInChannel = create('App\Thread');

        $this->get('/threads/' .$channel->slug)
            ->assertSee($ThreadInChannel->title)
            ->assertDontSee($ThreadNotInChannel->title);
    }
}
