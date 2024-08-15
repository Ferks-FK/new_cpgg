<?php

namespace App\Http\Controllers\Servers;

use App\Contracts\EggRepositoryInterface;
use App\Contracts\Eloquent\ProductRepositoryInterface;
use App\Contracts\LocationRepositoryInterface;
use Illuminate\Http\Request;

class CreateServerController
{
    public function __construct(
        protected ProductRepositoryInterface $productRepositoryInterface,
        protected LocationRepositoryInterface $locationRepositoryInterface,
        protected EggRepositoryInterface $eggRepositoryInterface)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = $this->productRepositoryInterface->getActives();
        $locations = $this->locationRepositoryInterface->all(['nodes']);
        $egg_attributes = $this->eggRepositoryInterface->all(['eggs.variables']);

        $eggs = $products->pluck('eggs')
            ->filter()
            ->flatMap(fn($eggs) => collect($eggs))
            ->unique()
            ->values()
            ->map(function ($db_egg) use ($egg_attributes) {
                $matching_egg = collect($egg_attributes)->first(function ($egg) use ($db_egg) {
                    return $egg['attributes']['id'] === $db_egg['value'];
                });

                if ($matching_egg) {
                    $db_egg['variables'] = $matching_egg['attributes']['relationships']['variables']['data'];
                }

                return $db_egg;
            });

        // check if location has nodess
        $locations = collect($locations)->filter(function ($location) {
            return count($location['attributes']['relationships']['nodes']['data']) > 0;
        });

        return view('modules.servers.create', compact('eggs', 'locations', 'products'));
    }
}
