<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        try {

            if (! $request->hasFile('upload')) {

                return response()->json([
                    'error' => [
                        'message' => 'No file received.',
                    ],
                ], 400);
            }

            $file = $request->file('upload');

            if (! $file->isValid()) {

                return response()->json([
                    'error' => [
                        'message' => $file->getErrorMessage(),
                    ],
                ], 400);
            }

            if ($file->getSize() > 10 * 1024 * 1024) {

                return response()->json([
                    'error' => [
                        'message' => 'Image must be less than 10 MB.',
                    ],
                ], 422);
            }

            $allowed = [
                'image/jpeg',
                'image/png',
                'image/jpg',
                'image/webp',
                'image/gif',
            ];

            if (! in_array($file->getMimeType(), $allowed)) {

                return response()->json([
                    'error' => [
                        'message' => 'Invalid image type.',
                    ],
                ], 422);
            }

            $path = public_path('uploads/ckeditor');

            if (! File::exists($path)) {

                File::makeDirectory(
                    $path,
                    0755,
                    true
                );
            }

            $fileName =
                time().
                '_'.
                uniqid().
                '.'.
                $file->getClientOriginalExtension();

            $file->move(
                $path,
                $fileName
            );

            return response()->json([
                'url' => asset(
                    'uploads/ckeditor/'.$fileName
                ),
            ]);

        } catch (\Throwable $e) {

            \Log::error(
                'CKEditor Upload Error',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ], 500);
        }
    }
}
