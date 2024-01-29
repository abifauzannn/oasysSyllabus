<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GenerateController extends Controller
{
    public function generateSyllabus(Request $request)
    {
        // Check if the user is authenticated
        if (!session()->has('token.access_token')) {
            // If not authenticated, redirect to login page
            return redirect('/login')->with('error', 'Please log in to generate syllabus.');
        }

        if ($request->isMethod('post')) {
            // Form submission

            $pelajaran = $request->input('pelajaran');
            $kelas = $request->input('kelas');
            $notes = $request->input('notes');

            // Generate a unique cache key based on the input data
            $cacheKey = 'syllabus_' . md5($pelajaran . $kelas . $notes);

            // Check if the data is already in the cache
            if (Cache::has($cacheKey)) {
                $data = Cache::get($cacheKey);
            } else {
                // If not in the cache, use the authentication token for API request
                $token = session()->get('token.access_token');

                $response = Http::withToken($token)->post('https://be.brainys.oasys.id/api/syllabus/generate', [
                    'pelajaran' => $pelajaran,
                    'kelas' => $kelas,
                    'notes' => $notes
                ]);

                if ($response->successful()) {
                    // Process the API response body
                    $responseData = $response->json();

                    // Check if the 'data' key exists in the response
                    if (isset($responseData['data'])) {
                        $data = $responseData['data'];

                        // Store the data in the cache for 1 hour (you can adjust the time as needed)
                        Cache::put($cacheKey, $data, 60 * 60);
                    } else {
                        // Handle the case where the expected structure is not present in the API response
                        return redirect('/form')->with('error', 'Invalid API response format');
                    }
                } else {
                    $statusCode = $response->status();
                    // Handle error if needed
                    return redirect('/form')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
                }
            }
        } else {
            // Initial form display
            $data = null;
        }

        // Pass the $data variable to the view
        return view('syllabusPages.syllabus', compact('data'));
    }


}
