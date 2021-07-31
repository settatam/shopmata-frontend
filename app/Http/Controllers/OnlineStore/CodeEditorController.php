<?php

namespace App\Http\Controllers\OnlineStore;

use Inertia\Inertia;
use App\Models\Store;
use App\Models\ThemeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\OpenEditorPage;
use Illuminate\Support\Facades\Log;

class CodeEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        // $store = Store::with('theme')->find(session()->get('store_id'));
        $files = Themefile::distinct('title')->get(['title', 'type_id', 'type', 'content', 'id']);
        $theme_files = [];

        $layout_files = [];
        $template_files = [];
        $asset_files = [];
        $layout = '';

        foreach ($files as $file) {
            $theme_files[$file->type_id][] = 
                ['title' => $file['title'], 
                 'content' => $file['content'],
                 'type' => $file['type'], 
                 'id' => $file->id
             ];
        }

        $open_files = OpenEditorPage::with('theme_file')->orderBy('id', 'asc')->get();

        for($i=0; $i<sizeof($open_files); $i++) {
            $open_files[$i]->content = $open_files[$i]->theme_file->content;
            $open_files[$i]->name = $open_files[$i]->theme_file->title;
            $open_files[$i]->edited_content = $open_files[$i]->theme_file->content;
        }

        count($theme_files) === 0 ? $theme_files = (object)[] : "";
        // count($open_files) === 0 ? $open_files = (object)[] : "";
        // $layout = $store->theme->layout[count($store->theme->layout)-1]->content;

        return Inertia::render('OnlineStore/CodeEditor', compact('theme_files', 'open_files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "nullable|string",
                'type' => "nullable|string",
                'asset_url' => 'nullable|string',
                'type_id' => "required|numeric",
                'theme_id' => "nullable|numeric",
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            $data['store_id'] = session('store_id');
            $data['user_id'] = Auth::id();

            if (ThemeFile::create($data)) {
                \Log::info(Auth::id() . 'Created a theme File ' . session('store_id'), $data);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Theme Created",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to Update Theme",
                    "type" => "success",
                    "message" => "We could Not Create this Theme Please Try Again",
                ];

                return response()->json(['notification' => $notification], 400);
            }

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Create Theme Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "Please try Again",
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $theme_file = ThemeFile::find($id);
        if(null !== $theme_file) {
            
            $data = [
                'store_id'=>session()->get('store_id'),
                'user_id'=>Auth::id(),
                'theme_file_id'=>$id
            ];

            $open_file = OpenEditorPage::firstOrNew($data);

            if($open_file->save($data)) {
                $open_file->load('theme_file');
                $open_file->content = $open_file->theme_file->content;
                $open_file->name = $open_file->theme_file->title;
                $open_file->edited_content = $open_file->theme_file->content;
                Log::info(Auth::id() . ' opened a new page', $data);
                return response()->json($open_file);
            }else{
                Log::error(Auth::id() . ' could not open a new page', $data);
                return response()->json('Could not process request', 422);
            }

        }else{
            Log::error(Auth::id() . ' tried to open a non existent file' . $id);
            return response()->json('Could not process request', 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "required|string",
                'type' => "nullable|string",
            ]);

            if ($validator->fails()) {
                $notification = [
                    "title" => "Validation Errors",
                    "type" => "failed",
                    "message" => "Request Failed Validation",
                    "validationErrors" => $validator->errors(),
                ];
                return response()->json(['notification' => $notification], 400);
            }

            $storeId = session('store_id');

            $theme = ThemeFile::find($id);

            if ($theme === null || $theme->store_id !== $storeId) {
                $notification = [
                    "title" => "Failed to Update Theme",
                    "type" => "success",
                    "message" => "Invalid Theme File",
                ];

                return response()->json(['notification' => $notification], 400);
            }

            unset($data['id']);

            if ($theme->update($data)) {
                $theme->uploadAsset();

                \Log::info(Auth::id() . 'Updated a theme File ' . session('store_id'), $data);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Theme Updated",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to Update Theme",
                    "type" => "success",
                    "message" => "We could Not Update this Theme Please Try Again",
                ];

                return response()->json(['notification' => $notification], 400);
            }
        

        // } catch (\Exception $e) {
        //     $exceptionDetails = [
        //         "message" => $e->getMessage(),
        //         'file' => basename($e->getFile()),
        //         'line' => $e->getLine(),
        //         'type' => class_basename($e),
        //     ];

        //     \Log::info("Update Theme Exception" . print_r($exceptionDetails, true));

        //     $notification = [
        //         "title" => "An Exception Occurred",
        //         "type" => "failed",
        //         "message" => "Please try Again",
        //     ];

        //     return response()->json(['notification' => $notification], 500);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
