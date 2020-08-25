<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ContentService;

class ContentController extends Controller
{
    /**
     * Content service
     * @var App\Service\ContentService
     */
    private $contentService;

    /**
     * Constructor
     * 
     * @param App\Service\ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * Show content page
     *
     * @param string $id
     */
    public function show(string $id)
    {
        $content = $this->contentService->get($id);

        if($content && $content->active) {
            return view('web.content')->with('content', $content);
        }

        return response()->view('web.404', [], 404);
    }
}
