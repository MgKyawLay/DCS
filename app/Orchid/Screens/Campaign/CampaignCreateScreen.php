<?php

namespace App\Orchid\Screens\Campaign;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CampaignCreateScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Create Campaign';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * 
     * 
     */
    public function create(Request $request)
    {
        $request->validate([
            'campaign.name' => 'required|max: 255',
            'campaign.category' => 'required|max: 255',
            'campaign.contact' => 'required|max: 255',
            'campaign.description' => 'required',
            'campaign.media' => '',
            'campaign.start_date' => 'required',
            'campaign.end_date' => 'required',
            'campaign.goal' => 'required',
            'campaign.raise' => 'required',
        ]);
        $campaign = new Campaign();
        $campaign->name = $request->input('campaign.name');
        $campaign->category = $request->input('campaign.category');
        $campaign->contact = $request->input('campaign.contact');
        $campaign->description = $request->input('campaign.description');
        $campaign->media = $request->input('campaign.media');
        $campaign->start_date = $request->input('campaign.start_date');
        $campaign->end_date = $request->input('campaign.end_date');
        $campaign->goal_amount = $request->input('campaign.goal');
        $campaign->raise_amount = $request->input('campaign.raise');
        $campaign->save();

        return redirect()->route('platform.campaign');
    }
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('campaign.name')
                    ->title('Name')
                    ->placeholder('Enter Campaign Name'),

                Input::make('campaign.category')
                    ->title('Category')
                    ->placeholder('Enter Campaign Category'),

                Input::make('campaign.contact')
                    ->title('Contact')
                    ->placeholder('Enter Campaign Contact'),

                Input::make('campaign.description')
                    ->title('Description')
                    ->placeholder('Enter Campaign Description'),

                Input::make('campaign.media')
                    ->title('Media')
                    ->placeholder('Enter Campaign media'),

                DateTimer::make('campaign.start_date')
                    ->format('d-m-Y')
                    ->title('Start Date')
                    ->placeholder('Select Campaign Start Date'),

                DateTimer::make('campaign.end_date')
                    ->title('End Date')
                    ->format('d-m-Y')
                    ->placeholder('Select Campaign End Date'),

                Input::make('campaign.goal')
                    ->title('Goal Amount')
                    ->placeholder('Enter Campaign Goal Amount'),

                Input::make('campaign.raise')
                    ->title('Raise Amount')
                    ->placeholder('Enter Campaign Raise Amount'),

                Group::make([
                    Link::make('Cancel'),
                    Button::make('Create')
                    ->method('create')
                    ->class('background-color: black'),
                ])->autoWidth(),
            ])
        ];
    }
}

