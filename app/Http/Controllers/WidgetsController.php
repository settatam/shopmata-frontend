<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WidgetsController extends Controller
{
    //
    /**
       * @param Request $request
       * @param string $action
       * @return Widget
       * @throws ValidationException
       * @throws \Illuminate\Auth\Access\AuthorizationException
       */
      protected function validateRequest(Request $request, $action = 'view')
      {
        $data = $this->validate($request, [
          'type' => 'required|string'
        ]);

        $class = $data['type'];

        if (!Str::startsWith($class, $namespace = 'App\\Widget\\')) {
          $class = $namespace . $class;
        }

        if (!class_exists($class)) {
          dd($class);
        }

        $widget = new $class;

        return $widget;
      }

      /**
       * @param Request $request
       * @return \Illuminate\Http\JsonResponse
       * @throws ValidationException
       * @throws \Illuminate\Auth\Access\AuthorizationException
       */
      public function view(Request $request)
      {
       // try {
          return response()->json(
            $this->validateRequest($request, 'view')
              ->render($request->input())
          );
//        } catch (\Exception $e) {
//            dd($e->getMessage());
//          return response()->json([
//            'error' => [
//              'There was an unidentified error',
//            ]
//          ], 422);
//        }
      }
}
