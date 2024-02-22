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

class NewsEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(int $id): iterable
    {
        return [
            'news' => News::findOrFail($id),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit News';
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

    public function updateNews(int $id, Request $request)
    {
        
        $request->validate([
            'news.title' => 'required| max: 255',
            'news.content' => 'required',
        ]);

        $news = News::findOrFail($id);
        $news->title = $request->input('news.title');
        $news->content = $request->input('news.content');
        $news->image_url = $request->input('news.image_url');
        $news->save();

        return redirect()->route('platform.news');
    }
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('news.title')->title('News')->placeholder('Enter news title'),
                TextArea::make('news.content')->title('Content')->placeholder('Enter news content'),
                Cropper::make('news.image_url')->title('Image')
                    ->placeholder('Select news photo')
                ,
                Group::make([
                    Link::make('Cancel')
                        ->route('platform.news'),
                    Button::make('Save')
                        ->style('background-color: black; color: white')
                        ->method('updateNews')
                ])->autoWidth(),
            ])
        ];
    }
}
