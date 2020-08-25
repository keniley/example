<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContentUpdateRequest;
use App\Http\Requests\Admin\ContentCreateRequest;
use App\Http\Controllers\Controller;
use App\Interfaces\DatatableInterface;
use App\Model\Content;
use App\Events\Content\Updated;

class ContentController extends Controller
{
    /**
     * Show list of contents
     * if request wants json, we show datatable response
     *
     * @param Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {
        if($request->wantsJson()) {
            $content = new Content();
            if($content instanceof DatatableInterface) {
                $list = $content->datatable($request);
                $list['system'] = ['code' => 200, 'message' => 'OK'];
                return response()->json($list);    
            }
        }

        return view('admin.content-index');
    }

    /**
     * Show detail of content
     *
     * @param Illuminate\Http\Request $request
     * @param string $id
     */
    public function show(Request $request, string $id)
    {
        $content = Content::find($id);

        return view('admin.content-show', ['content' => $content, 'id' => $id]);    
    }

    /**
     * Show template for modal window
     */
    public function new()
    {
        return view('admin.modal.content-new');
    }

    /**
     * Store new content
     *
     * @param App\Http\Requests\Admin\ContentCreateRequest $request
     */
    public function create(ContentCreateRequest $request)
    {
        $data = $request->validated();
        $content = new Content();
        $content->title = $data['title'];
        $content->save();

        return redirect('/admin/content/'.$content->id);
    }

    /**
     * Update content
     *
     * @param App\Http\Requests\Admin\ContentUpdateRequest $request
     * @param string $id
     */
    public function update(ContentUpdateRequest $request, string $id)
    {
        $request->flashOnly([]);
        
        $content = Content::find($id);

        if($content) {
            $data = $request->validated();

            $content = $this->modify($content, $data);
            $content->save();

            event(new Updated($content, $data));
        }

        $response = [];
        $response['system'] = ['code' => 200, 'message' => 'ok'];

        return response()->json($response);
    }

    /**
     * Update logic
     *
     * @param App\Model\Content $content
     * @param array $data
     *
     * @return App\Model\Content
     */
    private function modify(Content $content, array $data): Content
    {
        if($content->system) {
            unset($data['title']);
            unset($data['active']);
            unset($data['url_static']);
            unset($data['url_slug']);
        }
        
        $content->fill($data);  

        return $content;
    }
}
