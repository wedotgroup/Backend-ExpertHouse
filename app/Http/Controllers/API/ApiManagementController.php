<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\CategoryRequestMail;
use App\Mail\ContactMail;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\HeaderFooter;
use App\Models\InsightPages;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApiManagementController extends Controller
{
    public function settingdata()
    {
        try {
            $header = HeaderFooter::select('logo', 'whatsapp_no', 'phone_no', 'whatsappIcon', 'location', 'phoneIcon', 'email')->latest()->first();

            if (! $header) {
                return response()->json([
                    'message' => 'Header data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'Header data here',
                'data' => $header,
                'status' => true,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getBrands()
    {
        try {
            $data = Brand::select('images')->latest()->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for branding images',
                'data' => json_decode($data),
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getBanner()
    {
        try {
            $data = Banner::select('video_url', 'heading', 'first_button', 'second_button')->latest()->first();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for banner data',
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function getCategory()
    {
        try {
            $data = Category::select('id', 'category_name', 'slug')->latest()->get();
            if (! $data) {
                return response()->json([
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'message' => 'List for category data',
                'data' => $data,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function contactstore(Request $request)
    {
        try {

            $data = Contact::create([

                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'select_services' => $request->select_services,
                'enquiry' => $request->enquiry,
                'country_code'=>$request->country_code,

            ]);

            if (! $data) {

                return response()->json([
                    'message' => 'Something went wrong',
                    'data' => null,
                    'status' => false,
                ], 200);
            }
            Mail::to('officewedotgroup@gmail.com')->send(new ContactMail($data));
            return response()->json([
                'message' => 'Thanks for you connect with me',
                'data' => $data,
                'status' => true,
            ]);
        } catch (\Exception $error) {

            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function latestBlog()
    {
        try {
            $data = InsightPages::with(['category'])->limit(2)->latest()->get();

            if ($data) {
                return response()->json([
                    'message' => 'Latest Insight page',
                    'data' => $data,
                    'status' => true,
                ], 200);
            }

            return response()->json([
                'message' => 'Data not found',
                'data' => null,

            ], 404);
        } catch (\Exseption $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => null,
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function allBlogs()
    {
        try {
            $datas = InsightPages::with(['category'])->latest()->get();

            if (! $datas) {
                return response()->json([
                    'message' => 'Data not found',
                    'status' => false,
                    'data' => null,
                ]);
            }

            return response()->json([
                'message' => 'Insight datas',
                'data' => $datas,
                'status' => true,
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'status' => false,
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function relateCate($id)
    {
        try {

            if ($id) {
                $datas = InsightPages::where('cat_id', $id)->get();

                return response()->json([
                    'message' => 'Inside List Here',
                    'status' => true,
                    'data' => $datas,
                ]);
            }

            return response()->json([
                'message' => 'Insight data not found',
                'status' => false,
                'data' => null,
            ], 404);
        } catch (\Exseption $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $error->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function insightDetails($slug)
    {
        try {
            $data = InsightPages::with(['category'])->where('slug',$slug)->first();
            if ($data) {
                return response()->json([
                    'message' => 'Insight details here',
                    'data' => $data,
                    'status' => true,
                ], 200);
            }

            return response()->json([
                'message' => 'Not fond data',
                'status' => false,
                'data' => null,
            ], 404);
        } catch (\Exseption $error) {
            return response()->json([
                'message' => 'Something went wrong',
                'data' => null,
                'status' => false,
            ]);
        }
    }

    public function getServicedata()
    {
        try {

            $data = Service::with('serviceCat:id,name')
                ->select('id', 'heading', 'serviceCat_id','slug')
                ->get();

            return response()->json([
                'message' => 'Service data here',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

   public function singleService($slug)
{
    try {

        $data = Service::where('slug',$slug)->first();
        return response()->json([
            'message' => 'Service data here',
            'data' => $data,
        ], 200);

    } catch (\Exception $e) {

        return response()->json([
            'message' => 'Something went wrong',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function getFourService()
    {
        try {
            $data = Service::latest()->limit(4)->get();
            return response()->json([
                "message" => "Service four data here",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }

      public function getSixService()
    {
        try {
            $data = Service::with(['serviceCat'])->limit(6)->get();
            return response()->json([
                "message" => "Service six data here",
                "data" => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function CategoryEmail(Request $request){
        try{
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "phone"=>$request->phone
        ];

        $emaildata = Mail::to("officewedotgroup@gmail.com")->send(new CategoryRequestMail($data));
         return response()->json([
            "message"=>"Email Send SeccussFull",
            "data"=>$emaildata
        ],200);
        }catch(\Exception $e){
            return response()->json([
                "message"=>"Something went wrong",
                "error"=>$e->getMessage()
            ],500);
        }

    }

}
