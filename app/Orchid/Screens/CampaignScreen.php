<?php

namespace App\Orchid\Screens;

use App\Models\Campaign;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CampaignScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'campaigns' => Campaign::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Campaigns';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Create')
                ->icon('bs.plus')
                ->route('platform.campaign.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('campaigns', [
                TD::make('name', 'Campaign Name'),
                TD::make('category'),
                TD::make('contact'),
                TD::make('description'),
                TD::make('media'),
                TD::make('start_date'),
                TD::make('end_date'),
                TD::make('goal_amount'),
                TD::make('raise_amount'),
                TD::make('Edit')
                    ->render(fn(Campaign $test) => Link::make('')
                    ->icon('bs.pencil')
                    ->route('platform.campaign.edit', $test->id)
                    )
            ])
        ];
    }
}
