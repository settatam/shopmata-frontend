<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::where(function ($query) use ($request) {
            $query->where('is_blog', 0);
            $query->where('user_id', Auth::id());
            if ($request->search) {
                $query->where('title', 'LIKE', "%{$request->search}%");
            }
        })->paginate(50);
        $is_blog = false;
        return Inertia::render('OnlineStore/Index', compact('pages', 'is_blog'));
    }

    /**
     * Generate the slug for the .
     *
     * @return \Illuminate\Http\Response
     */
    public function generateSlug($title)
    {
        //
        $page = new Page;
        $page->title = $title;
        return response()->json(['slug' => $page->generateSlug()]);
    }

    public function editor($id = null)
    {
        return Inertia::render('OnlineStore/Editor');
    }

    public function codeEditor($id = null)
    {
        $store = Store::with('theme')->find(session()->get('store_id'));
        $layout = $store->theme->layout[count($store->theme->layout) - 1]->content;
        return Inertia::render('OnlineStore/CodeEditor', compact('layout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $is_blog = 0;
        return Inertia::render('OnlineStore/CreateNewPage', compact('is_blog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try { $data = $request->all();
            \Log::info("page  create request" . print_r($data, true));

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "required|string",
                // 'slug' => "required|string",
                // 'featured_image' => "required|string",
                // 'theme_template_id' => "nullable|numeric",
                'seo_title' => "nullable|string",
                'seo_description' => "nullable|string",
                'visibility_date' => "nullable|string",
                // 'is_visible' => "nullable|numeric",
                'excerpt' => "nullable|string",
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

            // $store = Store::find(session('store_id'));
            // dd($request->input());
            if (Page::create($data)) {
                Log::info(Auth::id() . 'Created a new page ' . session('store_id'), $data);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Page Created Successfully",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to create Page",
                    "type" => "success",
                    "message" => "We could not create the page please try again",
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

            \Log::info("Create Page Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
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
        try { $data = $request->all();
            \Log::info("page update request" . print_r($data, true));

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "required|string",
                'featured_image' => "required|string",
                'theme_template_id' => "nullable|numeric",
                'seo_title' => "nullable|string",
                'seo_description' => "nullable|string",
                'visibility_date' => "nullable|string",
                'is_visible' => "nullable|numeric",
                'excerpt' => "nullable|string",
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

            $page = Page::find($id);

            if ($page->update($data)) {
                Log::info(Auth::id() . 'Updated page ' . $id . session('store_id'), $data);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Page Successfully",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to create Page",
                    "type" => "success",
                    "message" => "We could not create the page please try again",
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

            \Log::info("Update Page Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $page = Page::find($id);
            if ($page->delete($page)) {
                Log::info(Auth::id() . 'DeletedPage ' . $id);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Page Deleted",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to Delete Page",
                    "type" => "success",
                    "message" => "We could not delete the page please try again",
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

            \Log::info("Delete Page Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }
    }
}
