<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LinkRegisterRequest;
use App\Services\LinkService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class LinkController extends Controller
{
    /**
     *
     * @param  LinkRegisterRequest $request
     * @param  LinkService $service
     * @return JsonResponse
     */
    public function register(LinkRegisterRequest $request, LinkService $service): JsonResponse
    {
        $code = $service->register($request->input('url'));

        return response()->json([
            'url' => route('link.url', ['code' => $code])
        ]);
    }
}
