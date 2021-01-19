<?php

declare(strict_types=1);

namespace App\Http\Search;

use App\Http\Managers\LaunchManager;
use App\Http\Managers\PadManager;
use App\Http\Managers\ProviderManager;
use App\Http\Managers\RocketManager;
use Illuminate\Support\Facades\DB;

class SearchManager
{

    /**
     * @param string $query
     * @return array|null
     */
    public function advancedSearch(string $query): ?array
    {
        $search = [];
        $results = [];

        // launches
        foreach ($this->searchLaunches($query) as $result) {
            $result->path = "/launch/" . $result->slug;
            $result->category = "launch";
            $search[] = $result;
        }

        foreach ($this->searchRockets($query) as $result) {
            $result->path = "/rocket/" . $result->slug;
            $result->category = "rocket";
            $search[] = $result;
        }

        foreach ($this->searchProviders($query) as $result) {
            $result->path = "/provider/" . $result->slug;
            $result->category = "provider";
            $search[] = $result;
        }

        foreach ($this->searchPads($query) as $result) {
            $result->path = "/pad/" . $result->slug;
            $result->category = "pad";
            $search[] = $result;
        }

        foreach ($search as $item) {
            $searchResponse = new SearchResponse();

            $searchResponse->setTitle($item->name);
            $searchResponse->setSubtitle($item->description ?? "NaN");
            $searchResponse->setPath($item->path);
            $searchResponse->setImageURL($item->imageURL ?? null);
            $searchResponse->setCategory($item->category ?? "NaN");

            $results[] = $searchResponse;
        }

        return $results;
    }

    /**
     * @param string $query
     * @return array
     */
    private function searchLaunches(string $query): array
    {
        $result = DB::table(LaunchManager::TABLE)->where("name", "LIKE", "%" . strtolower($query) . "%")->get();
        $array = [];

        foreach ($result as $item) {
            $array[] = $item;
        }

        return $array;
    }

    /**
     * @param string $query
     * @return array
     */
    private function searchRockets(string $query): array
    {
        $result = DB::table(RocketManager::TABLE)->where("name", "LIKE", "%" . strtolower($query) . "%")->get();
        $array = [];

        foreach ($result as $item) {
            $array[] = $item;
        }

        return $array;
    }

    /**
     * @param string $query
     * @return array
     */
    private function searchProviders(string $query): array
    {
        $result = DB::table(ProviderManager::TABLE)->where("name", "LIKE", "%" . strtolower($query) . "%")->get();
        $array = [];

        foreach ($result as $item) {
            $array[] = $item;
        }

        return $array;
    }

    /**
     * @param string $query
     * @return array
     */
    private function searchPads(string $query): array
    {
        $result = DB::table(PadManager::TABLE)->where("name", "LIKE", "%" . strtolower($query) . "%")->get();
        $array = [];

        foreach ($result as $item) {
            $array[] = $item;
        }

        return $array;
    }
}
