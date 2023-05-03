<?php

namespace App\MoonShine\Resources;

use App\Models\Category;
use MoonShine\Fields\ID;

use MoonShine\Fields\Slug;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Decorations\Block;
use MoonShine\Filters\TextFilter;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
	public static string $model = Category::class;

	public static string $title = 'Category';

	public function fields(): array
	{
		return [
            Block::make('New Category', [
                ID::make(),
                Text::make('Name', 'name'),
                Slug::make('slug')->from('name')->separator('-')->unique(),
                Textarea::make('Description', 'description')
            ])
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id','name','description'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Name')
                ->customQuery(fn(Builder $query, $value) => $query->where('name', 'LIKE', "%${value}%")),
            TextFilter::make('Description')
                ->customQuery(fn(Builder $query, $value) => $query->where('description', 'LIKE', "%${value}%")),
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
