<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class NewsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'news' => News::latest()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'News';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('create')->route('platform.news.create')
        ];
    }

    public function delete(News $news)
    {
        $news->delete();
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        // $isAdmin = empty(Auth::user()?->roles[0]);
        // dd($isAdmin);
        if (!empty(Auth::user()?->roles[0]) && Auth::user()?->roles[0]?->name == 'admin') {
            return [
                Layout::table('news', [
                    TD::make('title'),
                    TD::make('content'),
                    TD::make('image_url', 'Image')
                        ->width('100')
                        ->render(fn(News $news) => "<img src={$news->image_url} 
                    class='mw-100 d-block img-fluid rounded-1 w-100'
                    >"),
                    TD::make('Actions')->render(function (News $news) {
                        return Group::make([
                            Link::make('')
                                ->icon('bs.pencil')
                                ->route('platform.news.edit', $news->id),
                            Button::make('')
                                ->icon('bs.trash')
                                ->method('delete', ['news' => $news->id])
                        ])->autoWidth();
                    }),
                ])
            ];
        } else {
            return [
                Layout::view('NotAllowed')
            ];
        }
    }
}
