<?php

namespace App\Services;

use App\Models\Link;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LinkService
{
    /**
     * @param  Hashids $hashier
     * @return void
     */
    public function __construct(
        private Hashids $hashier,
    ) {
        //
    }

    /**
     * @param  string $url
     * @return string
     */
    public function register(string $url): string
    {
        $link = Link::query()->firstOrCreate(['url' => $url]);

        return $this->hashier->encode($link->id);
    }

    /**
     * @param  string $code
     * @return Link
     * @throws ModelNotFoundException
     */
    public function findByCode(string $code): Link
    {
        return Link::query()->where('id', $this->hashier->decode($code))->firstOrFail();
    }
}
