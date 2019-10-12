<?php

namespace Tests\Feature;

use App\User;
use App\Topic;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function cant_show_topics_if_dont_login()
    {
        // $this->withoutExceptionHandling();

        $response = $this->get('/topics');

        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function user_authenticated_should_show_his_topics()
    {
        $user = factory(User::class, 1)->create()->first();

        $this->actingAs($user);

        $response = $this->get('/topics');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function user_authenticated_should_create_topics()
    {
        $user = factory(User::class, 1)->create()->first();

        $this->actingAs($user);

        $this->assertCount(0, $user->topics()->get());

        $this->post(route('topics.index'), [
            'body' => 'Topic body'
        ]);

        $this->assertCount(1, $user->topics()->get());
    }

    /**
     * @test
     */
    public function topic_title_should_be_required()
    {
        $user = factory(User::class, 1)->create()->first();
        
        $this->actingAs($user);

        $response = $this->post(route('topics.store'));

        $response->assertSessionHasErrors(['body']);
    }

    /**
     * @test
     */
    public function user_authenticated_only_can_view_topics_make_by_itself_or_follows()
    {
        [$user1, $user2] = factory(User::class, 2)->create();

        $user1->topics()->saveMany(factory(Topic::class, 3)->make());
        $user2->topics()->saveMany(factory(Topic::class, 5)->make());

        $this->actingAs($user1);

        $response = $this->get(route('topics.index'));

        // TODO: Improve assert
        $response->assertDontSee($user2->name);

        $user1->follows()->attach($user2, ['is_active' => 1]);

        $response = $this->get(route('topics.index'));

        $response->assertSee($user2->name);
    }

    /**
     * @test
     */
    public function follow_id_should_by_required_in_follow_action()
    {
        $user1 = factory(User::class)->create();

        $this->actingAs($user1);

        $response = $this->post(route('users.follow.store', ['user' => $user1]));

        $response->assertSessionHasErrors('follow_id');
    }

    /**
     * @test
     */
    public function user_authenticated_can_follows_other_users()
    {
        [$user1, $user2] = factory(User::class, 2)->create();

        $this->actingAs($user1);

        $response = $this->post(route('users.follow.store', ['user' => $user1]), ['follow_id' => $user2->id]);

        $response->assertRedirect(route('follows.index'));

        $this->assertCount(1, $user1->follows()->get());

        return [$user1, $user2];
    }

    /**
     * @test
     * @depends user_authenticated_can_follows_other_users
     * 
     * ----- peding test
     * 
     */
    public function user_can_unfollow_other_user($users)
    {
        [$user1, $user2] = $users;

        $this->actingAs($user1);

        $response = $this->delete(route('users.follow.destroy', ['user' => $user1]), ['follow_id' => $user2->id]);

        $response->assertRedirect(route('follows.index'));

        $this->assertCount(0, $user1->follows()->get());
    }
}
