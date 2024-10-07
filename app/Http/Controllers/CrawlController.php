<?php

namespace App\Http\Controllers;

use App\Models\CrawledData;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crawl.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //basic crawl
        // $request->validate([
        //     'url' => 'required|url',
        // ]);

        // $url = $request->input('url');
        // $content = file_get_contents($url); // Basic crawling
        // // dd($content);

        // // You might want to add more parsing logic here.

        // // Save to database
        // CrawledData::create([
        //     'url' => $url,
        //     'content' => $content,
        // ]);

        // return redirect()->back()->with('success', 'Data crawled successfully!');
        //end basic crawl


        $request->validate([
            'url' => 'required|url',
        ]);
        $url = $request->url;

        // Set up Guzzle client
        $client = new Client();

        // Send GET request to fetch HTML content
        $response = $client->get($url);

        $html = $response->getBody()->getContents();

        // Initialize DomCrawler for parsing HTML
        $crawler = new Crawler($html);
        // dd($crawler);

        // Extract data (modify CSS selector as per your requirements)
        $crawler->filter('a')->each(function (Crawler $node) {
            // Extract text or attributes
            $title = $node->text();
            $link = $node->attr('href');
            // dd($link );

            // Output data (or save to database)
            CrawledData::create([
                'title' => $title,
                'link' => $link
            ]);
        });
        return redirect()->back()->with('success', 'Data crawled and saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
