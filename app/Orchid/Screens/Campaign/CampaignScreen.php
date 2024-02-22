<?php

namespace App\Orchid\Screens\Campaign;

use App\Models\Campaign;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
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

    public function remove(Campaign $campaign)
    {
        $campaign->delete();
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
                TD::make('name'),
                TD::make('category'),
                TD::make('contact'),
                TD::make('description'),
                TD::make('media'),
                TD::make('start_date'),
                TD::make('end_date'),
                TD::make('goal_amount'),
                TD::make('raise_amount'),
                TD::make('Actions')
                    ->render(function (Campaign $campaign) {
                        // dd($campaign);
                        return Group::make([
                            Button::make('')
                                ->confirm('After deleting, the task will be gone forever.')
                                ->icon('bs.trash')
                                ->method('remove', ['campaign' => $campaign->id]),
                            Link::make('')
                                ->icon('bs.pencil')
                                ->route('platform.campaign.edit', $campaign->id),
                        ]);
                    })
            ])
        ];
    }
}
