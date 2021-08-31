<?php

namespace App\Http\Controllers;

use App\Services\LinkService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;

class LinkController extends Controller
{
    /**
     * @param  LinkService $service
     * @param  string $code
     * @return RedirectResponse
     */
    public function redirect(LinkService $service, string $code): RedirectResponse
    {
        try {
            $link = $service->findByCode($code);
    
            return redirect($link->url);
        } catch (ModelNotFoundException) {
            return redirect('/');
        }
    }
}
