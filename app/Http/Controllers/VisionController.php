<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class VisionController extends Controller
{
    public function index()
    {
        return view('layouts.analyze-image');
    }
        
    public function analyzeImage(Request $request)
    {
        // Get the uploaded file from the request
        $file = $request->file('image');

        if ($file) {
            // Analyze the image
            $imagePath = $file->path();
            $labels = $this->analyze($imagePath);
                
            // Do something with the labels, e.g., return them as a response
            return response()->json($labels);
        }

        // Handle the case when no file is uploaded
        return response()->json(['error' => 'No image file uploaded.'], 400);
    }

    private function analyze($imagePath)
    { 
        // Resolve the ImageAnnotatorClient from the service container
        $imageAnnotator = app(ImageAnnotatorClient::class);

        try {


            $imageAnnotatorClient = new ImageAnnotatorClient();

            $image_path = 'data:image/jpeg;base64,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';
            $imageContent = file_get_contents($image_path);
            $response = $imageAnnotatorClient->textDetection($imageContent);
            $text = $response->getTextAnnotations();
            echo $text[0]->getDescription();
            // $imagePath = "https://www.google.com/imgres?imgurl=https%3A%2F%2Fwww.simplilearn.com%2Fice9%2Ffree_resources_article_thumb%2Fwhat_is_image_Processing.jpg&tbnid=x-vCr75bhEc-WM&vet=12ahUKEwj54veNoMaCAxUtzAIHHT-8ADsQMygHegQIARB6..i&imgrefurl=https%3A%2F%2Fwww.simplilearn.com%2Fimage-processing-article&docid=NMmM-IXyCkU2hM&w=848&h=477&q=images&ved=2ahUKEwj54veNoMaCAxUtzAIHHT-8ADsQMygHegQIARB6";
            // $content = file_get_contents($imagePath);
                
            // // Create an image instance
            // $image = new \Google\Cloud\Vision\V1\Image();
            // $image->setContent($content);
            // // dd($image);
            // // Create an image annotation request
            // $response = $imageAnnotator->annotateImage(['image' => $content], ['LABEL_DETECTION']);
          
            // // Get labels from the response
            // $labels = $response->getLabelAnnotations();

            // // Close the ImageAnnotatorClient
            // $imageAnnotator->close();

            // // Return the labels
            // return $labels;
        } catch (\Exception $e) {
            // Handle exceptions
            return ['error' => $e->getMessage()];
        }
    }
}
