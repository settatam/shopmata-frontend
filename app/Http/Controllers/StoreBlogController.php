<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StoreBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $blogs = Page::where(function ($query) use ($request) {
            $query->where('is_blog', 1);
            $query->where('user_id', Auth::id());
            if ($request->search) {
                $query->where('title', 'LIKE', "%{$request->search}%");
            }
        })->paginate(50);
        // $blogs = Page::where('is_blog', 1)->paginate(25);
        $is_blog = true;
        return Inertia::render('OnlineStore/BlogPost', compact('blogs', 'is_blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('OnlineStore/CreateBlogPost');
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
            \Log::info("page  blog request" . print_r($data, true));

            $validator = Validator::make($data, [
                'title' => "required|string",
                'content' => "required|string",
                'slug' => "required|string",
                'featured_image' => "required|string",
                'theme_template_id' => "nullable|numeric",
                'seo_title' => "nullable|string",
                'seo_description' => "nullable|string",
                'visibility_date' => "nullable|string",
                'is_visible' => "nullable|numeric",
                'excerpt' => "nullable|string",
                'tags' => "nullable|string"
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
            $data['is_blog'] = 1;

            // add author and tags
            $tags = [];
            $tagArr = explode(",", $data['tags']);
            foreach ($tagArr as $key => $tag) {
                array_push($tags, [ 'name' => $tag ]);
            }

            // $store = Store::find(session('store_id'));
            // dd($request->input());
            if ($page = Page::create($data)) {
                Log::info(Auth::id() . 'Created a new blog ' . session('store_id'), $data);

                //create the tags
                $page->tags()->createMany($tags);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Blog Created Successfully",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to create Page",
                    "type" => "success",
                    "message" => "We could not create the blog please try again",
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

            \Log::info("Create blog Exception" . print_r($exceptionDetails, true));

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
        try {
            $data = $request->all();
            \Log::info("blog update request" . print_r($data, true));

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
                'tags' => "nullable|string"
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

            $blog = Page::find($id);

            if ($blog->update($data)) {
                Log::info(Auth::id() . 'Updated blog ' . $id . session('store_id'), $data);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Blog Updated Successfully",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to Update Blog",
                    "type" => "success",
                    "message" => "Please try again",
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

            \Log::info("Update Blog exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => "Please try Again",
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
            $blog = Page::find($id);
            if ($blog->delete($data)) {
                Log::info(Auth::id() . 'Deleted Blog ' . $id);

                $notification = [
                    "title" => "Success",
                    "type" => "success",
                    "message" => "Blog Deleted",
                ];

                return response()->json(['notification' => $notification]);
            } else {
                $notification = [
                    "title" => "Unable to Delete blog",
                    "type" => "success",
                    "message" => "We could not delete the blog please try again",
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

            \Log::info("Delete blog Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }

    }
}
