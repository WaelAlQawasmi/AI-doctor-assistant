<?php
namespace App\GraphQL\Queries;

use App\Models\Disease;
use App\Models\Post;
use Closure;

class DiseasesNameSuggestions {
    public function resolve($root, array $args)
    {
        $prefix = $args['name'];

        return Disease::where('name', 'like', $prefix . '%')->get();
    }
}