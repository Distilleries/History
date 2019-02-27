<?php

namespace Tests;

use Distilleries\History\Models\History;
use Illuminate\Http\Response;
use Tests\Models\Item;

class HistoryTest extends HistoryTestCase
{
    /** @test */
    public function can_log_created_with_author()
    {
        $this->assertThat(
            History::count(),
            $this->equalTo(0)
        );

        $response = $this->actingAs($this->user)
            ->call('POST', 'items', [
                'title' => 'Item title',
            ]);

        $this->assertThat(
            $response->getStatusCode(),
            $this->equalTo(Response::HTTP_OK)
        );

        $item = Item::query()
            ->where('title', '=', 'Item title')
            ->first();


        $this->assertThat(
            History::count(),
            $this->equalTo(1)
        );

        /** @var \Distilleries\History\Models\History $history */
        $history = History::first();

        $this->assertThat(
            $history->type,
            $this->equalTo('created')
        );

        $this->assertThat(
            $history->model_id,
            $this->equalTo($item->getKey())
        );

        $this->assertThat(
            $history->model_type,
            $this->equalTo(get_class($item))
        );

        $this->assertThat(
            $history->author_id,
            $this->equalTo($this->user->getKey())
        );

        $this->assertThat(
            $history->author_type,
            $this->equalTo(get_class($this->user))
        );
    }

    /** @test */
    public function can_log_created_without_author()
    {
        $this->assertThat(
            History::count(),
            $this->equalTo(0)
        );

        $item = Item::create([
            'title' => 'Without author',
        ]);

        $this->assertThat(
            History::count(),
            $this->equalTo(1)
        );

        /** @var \Distilleries\History\Models\History $history */
        $history = History::first();

        $this->assertThat(
            $history->type,
            $this->equalTo('created')
        );

        $this->assertThat(
            $history->model_id,
            $this->equalTo($item->getKey())
        );

        $this->assertThat(
            $history->model_type,
            $this->equalTo(get_class($item))
        );

        $this->assertThat(
            $history->author_id,
            $this->isNull()
        );

        $this->assertThat(
            $history->author_type,
            $this->isNull()
        );
    }
}
