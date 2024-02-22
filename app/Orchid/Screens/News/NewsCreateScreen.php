<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class NewsCreateScreen extends Screen
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
        return 'Create News';
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

    public function createNews(Request $request)
    {
        $request->validate([
            'news.title' =>'required| max: 255',
            'news.content' =>'required',
        ]);

        $news = new News();
        $news->title = $request->input('news.title');
        $news->content = $request->input('news.content');
        $news->image_url = $request->input('news.photo');
        $news->save();

        return redirect()->route('platform.news');
    }
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('news.title')->title('News')->placeholder('Enter news title'),
                TextArea::make('news.content')->title('Content')->placeholder('Enter news content'),
                Cropper::make('news.photo')->title('Image')->placeholder('Select news photo'),
                Group::make([
                    Link::make('Cancel')
                    ->route('platform.news'),
                    Button::make('Save')
                    ->style('background-color: black; color: white')
                    ->method('createNews')
                ])->autoWidth(),
            ])
        ];
    }
}
