<?php

namespace Modules\Article\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\Article\Events\PostViewed;

class CraftsController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Crafts';

        // module name
        $this->module_name = 'crafts';

        // directory path of the module
        $this->module_path = 'crafts';

        // module icon
        $this->module_icon = 'fas fa-file-alt';

        // module model name, path
        $this->module_model = "Modules\Article\Entities\Craft";
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = str_singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::latest()->with(['category', 'tags', 'comments'])->paginate();

        return view("article::frontend.$module_path.index",
                compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_action', 'module_name_singular'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($hashid)
    {
        $id = decode_id($hashid);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = str_singular($module_name);

        $module_action = 'Show';

        $meta_page_type = 'article';

        $$module_name_singular = $module_model::with(['category', 'tags', 'comments'])->findOrFail($id);

        event(new PostViewed($$module_name_singular));

        return view("article::frontend.$module_name.show",
        compact('module_title', 'module_name', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'meta_page_type'));
    }
}