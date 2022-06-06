<?php

namespace App\Http\Controllers\OnlineStore;

use App\Models\ThemeFileVersion;
use Inertia\Inertia;
use App\Models\Store;
use App\Models\ThemeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\OpenEditorPage;
use Illuminate\Support\Facades\Log;
use App\Models\Theme;
use Illuminate\Support\Str;
use App\Traits\FileUploader;
use Illuminate\Support\Facades\Storage;
use App\Models\StoreTheme;

class CodeEditorController extends Controller
{
    use FileUploader;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $store = Store::with('theme')->find(session()->get('store_id'));

        $theme_id = $request->theme_id;
        $theme_files = [];
        $theme = Theme::with(['files' => function($query) use ($store, $request){
            $query->where('store_id', $store->id);
        }])->find($theme_id);

        $filesGroup = $theme->files->groupBy('type');
        $files = $filesGroup->all();

        foreach(ThemeFile::fileTypes() as $type) {
            if(!array_key_exists($type, $files)) $files[$type] = [];
        }

        $open_files = OpenEditorPage::forStore($store);

        count($theme_files) === 0 ? $theme_files = (object)[] : "";
        // count($open_files) === 0 ? $open_files = (object)[] : "";
        // $layout = $store->theme->layout[count($store->theme->layout)-1]->content;

        return Inertia::render('OnlineStore/CodeEditor', compact('theme_files', 'open_files', 'theme', 'files', 'theme_id'));
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
        // try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "nullable|string",
                'type' => "nullable|string",
                'asset_url' => 'nullable|string',
//                'type_id' => "required|numeric",
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

            $data['type_id'] = ThemeFile::getFileTypeID($data['type']);
            $data['store_id'] = session()->get('store_id');
            $data['user_id'] = Auth::id();

            if ($theme = ThemeFile::create($data)) {
                \Log::info(Auth::id() . 'Created a theme File ' . session('store_id'), $data);

                //TODO -- Make this dry

                OpenEditorPage::where('store_id', session('store_id'))->where('user_id', Auth::id())->update(['is_open'=>0]);

                $data = [
                    'store_id'=>session()->get('store_id'),
                    'user_id'=>Auth::id(),
                    'theme_file_id'=>$theme->id,
                    'is_open'=>1
                ];

                $open_file = OpenEditorPage::firstOrNew($data);
                $theme_files = ThemeFile::getForStore();

                if($open_file->save($data)) {
                    $open_file->load('theme_file');
                    $open_file->content = $open_file->theme_file->content;
                    $open_file->title = $open_file->theme_file->title;
                    $open_file->name = $open_file->title;
                    $open_file->edited_content = $open_file->theme_file->content;
                    Log::info(Auth::id() . ' opened a new page', $data);
                    return response()->json([
                                                'open_files'=>$open_file,
                                                'theme_files'=>$theme_files
                                            ]);
                }else{
                    Log::error(Auth::id() . ' could not open a new page', $data);
                    return response()->json('Could not process request', 422);
                }

            } else {
                $notification = [
                    "title" => "Unable to Update Theme",
                    "type" => "success",
                    "message" => "We could Not Create this Theme Please Try Again",
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

        //     \Log::info("Create Theme Exception" . print_r($exceptionDetails, true));

        //     $notification = [
        //         "title" => "An Exception Occurred",
        //         "type" => "failed",
        //         "message" => "Please try Again",
        //     ];

        //     return response()->json(['notification' => $notification], 500);
        // }
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
                'theme_file_id'=>$id,
                'is_open'=>1
            ];

            OpenEditorPage::where('store_id', session('store_id'))->where('user_id', Auth::id())->update(['is_open'=>0]);

            $open_file = OpenEditorPage::firstOrNew($data);

            if($open_file->save($data)) {
                $open_file->load('theme_file');
                $open_file->content = $open_file->theme_file->content;
                $open_file->name = $open_file->theme_file->title;
                $open_file->title = $open_file->theme_file->title;
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

    public function uploader(Request $request) {

        $file = $request->file('files');
        $mimeType = $file->getMimeType();
        $fileName = $file->getClientOriginalName();

        $store = Store::find(session()->get('store_id'));

        $imageMimes = ThemeFIle::getImageMimes();
        if(in_array($mimeType, $imageMimes)) {
            //File is an image
           $image = $this->uploadImageToCloud($store, $file, $fileName);
           $data = [
               'theme_id' => $request->theme_id,
               'type' => ThemeFile::TYPE_ASSET,
               'image_url' => $image['url'],
               'title' => $fileName,
               'store_id' => session()->get('store_id')
           ];
           $themeFile = ThemeFile::create(
               $data
           );

           Log::Info(Auth::id() . ' created a new asset', $data);

        }else{
            $extension = '';
            if(Str::contains($fileName, [
                'css.twig',
                'js.twig'
            ])) {
                //Conversion should take place
                $fileContent = $file->getContent();
                $filename = Str::replace($fileName, '.twig');

            }

            Storage::disk('DO')->put($store->slug . '/' . $fileName, $file->getContent(), 'public');
            $data = [
                'theme_id' => $request->theme_id,
                'type' => ThemeFile::TYPE_ASSET,
                'title' => $fileName,
                'content' => $file->getContent(),
                'store_id' => session()->get('store_id')
           ];
            $themeFile = ThemeFile::create(
                $data
            );

            ThemeFileVersion::create(
                [
                    'theme_file_id' => $themeFile->id,
                    'user_id' => Auth::id(),
                    'content' => $file->getContent()
                ]
            );

            Log::Info(Auth::id() . ' created a new asset', $data);
        }

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

            $theme = ThemeFile::find($data['theme_file_id']);

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
