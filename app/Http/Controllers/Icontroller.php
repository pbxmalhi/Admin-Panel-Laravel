<?php

namespace App\Http\Controllers;

use App\Models\adminCategory;
use App\Models\adminLogin;
use App\Models\adminPage;
use App\Models\adminProduct;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Icontroller extends Controller
{

    ////////////////Login Page Controllers\\\\\\\\\\\\\\\\\\

    // Displaying Login Page
    public function index()
    {
        return view('adminPanel/index');
    }

    // Authentication on Login Page
    public function session_submit(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('userpass');
        $data = adminLogin::select('*')
            ->where('username', $username)
            ->where('password', $password)
            ->count();
        if ($data > 0) {
            session()->put('user_session', "done");
            return redirect("/pageSummary");
        } else {
            return back()->withErrors("Invalid Credentials");
        }
    }

    ///////////////// Add Page Controllers \\\\\\\\\\\\\\\\\\

    // Displaying Page Summary
    public function page()
    {
        return view('adminPanel/addpage');
    }

    // Displaying Data in Page Summary
    public function pagesummary()
    {
        $data = adminPage::all();
        return view('adminPanel/pagesummary', compact('data'));
    }

    // Displaying Page Data for editing
    public function editPage($id)
    {
        $data = adminPage::where('id', $id)->get();
        return view('adminPanel/addpage', compact('data'));
    }

    // Updating Page Data
    public function update_page(Request $request, $id = '')
    {
        $add = adminPage::find($id);
        if ($request->isMethod('post')) {
            $add->name = $request->get('name');
            $add->content = $request->get('content');
            if (!empty($request->get('status'))) {
                $add->status = 1;
            } else {
                $add->status = 0;
            }
            $add->save();
        }
        return redirect("/pageSummary");
    }

    // Adding Page Data
    public function save_page(Request $request)
    {
        $add = new adminPage;
        if ($request->isMethod('post')) {
            $add->name = $request->get('name');
            $add->content = $request->get('content');
            if (!empty($request->get('status'))) {
                $add->status = 1;
            } else {
                $add->status = 0;
            }
            $add->save();
        }
        return redirect("/pageSummary");
    }

    // Searching Pages in Page Summary
    public function search(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->get('pagename');
            $data = adminPage::where('name', 'LIKE', '%' . $name . '%')->get();
        }
        return view('adminPanel/pagesummary', compact('data'));
    }

    // Deleting Page data from the database
    public function deletePage($id)
    {
        $data = adminPage::find($id);
        $data->delete();
        return redirect("/pageSummary");
    }


    //////////////// Category Controllers\\\\\\\\\\\\\\\\\\

    // Displaying Category Data in Category Summary Page
    public function displayCategory()
    {
        $data = adminCategory::all();
        return view('adminPanel/categorysummary', compact('data'));
    }

    // Displaying Category Data for editing
    public function updateCategory($id)
    {
        $data = adminCategory::where('id', $id)->get();
        return view('adminPanel/addcategory', compact('data'));
    }

    // Displaying Add Category Page
    public function addCategoryPage()
    {
        return view('adminPanel/addcategory');
    }

    // Adding new category
    public function addCategory(Request $request)
    {
        $add = new adminCategory;
        if ($request->isMethod('post')) {
            $add->categoryname = $request->get('catname');
            $add->save();
        }
        return redirect("/categorysummary");
    }

    // Updating Data in the category
    public function updateCategorySubmit(Request $request,  $id = "")
    {
        $add = adminCategory::find($id);
        if ($request->isMethod('post')) {
            $add->categoryname = $request->get('catname');
            $add->save();
        }
        return redirect("/categorysummary");
    }

    // Searching category in Category Summary
    public function searchCat(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->get('catname');
            $data = adminCategory::where('categoryname', 'LIKE', '%' . $name . '%')->get();
        }
        return view('adminPanel/categorysummary', compact('data'));
    }

    // Deleting Category data from the database
    public function deleteCategory($id)
    {
        $data = adminCategory::find($id);
        $data->delete();
        return redirect("/categorysummary");
    }


    //////////////// Products Controllers\\\\\\\\\\\\\\\\\\

    // Displaying Category Data in Category Summary Page
    public function products()
    {
        $data = adminProduct::all();
        return view('adminPanel/productsummary', compact('data'));
    }

    // Displaying Product Data for editing
    public function productData($id)
    {
        $data = adminProduct::where('id', $id)->get();
        $data2 = adminProduct::find($id);
        $cid = $data2->category_id;
        $usedcategory = adminCategory::where('id', $cid)->get();
        $cdata = adminCategory::all();
        return view('adminPanel/addproduct', compact('data', 'cdata', 'usedcategory'));
    }

    // Add New Product Page Display and Category Display
    public function addProduct()
    {
        $cdata = adminCategory::all();
        return view('adminPanel/addproduct', compact('cdata'));
    }

    // Adding New Product
    public function saveProduct(Request $request)
    {
        $add = new adminProduct;
        if ($request->isMethod('post')) {
            $add->category_id = $request->get('category');
            $add->productname = $request->get('pname');
            $add->productdesc = $request->get('pdesc');
            $add->productprice = $request->get('pprice');
            if ($request->file('filename')) {
                $file = $request->file('filename');
                $current = uniqid(Carbon::now()->format('YmdHs'));
                $file->getClientOriginalName();
                $file->getClientOriginalExtension();
                $fullfilename = $current . "." . $file->getClientOriginalExtension();
                $destinationPath = public_path('upload');
                $file->move($destinationPath, $fullfilename);
                $add->productimage = $fullfilename;
            }
            $add->save();
        }
        return redirect("/productsummary");
    }

    // Searching category in Category Summary
    public function searchProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $name = $request->get('pname');
            $data = adminProduct::where('productname', 'LIKE', '%' . $name . '%')->get();
        }
        return view('adminPanel/productsummary', compact('data'));
    }

    // Deleting product from the database
    public function deleteProduct($id)
    {
        $data = adminProduct::find($id);
        $filename = $data->productimage;
        $data->delete();
        unlink("upload/" . $filename);
        return redirect("/productsummary");
    }

    // Updating Data in the category
    public function updateProduct(Request $request,  $id = "")
    {
        $add = adminProduct::find($id);
        $oldfilename = $add->productimage;
        if ($request->isMethod('post')) {
            $add->category_id = $request->get('category');
            $add->productname = $request->get('pname');
            $add->productdesc = $request->get('pdesc');
            $add->productprice = $request->get('pprice');
            if ($request->file('filename')) {
                $file = $request->file('filename');
                $current = uniqid(Carbon::now()->format('YmdHs'));
                $file->getClientOriginalName();
                $file->getClientOriginalExtension();
                $fullfilename = $current . "." . $file->getClientOriginalExtension();
                $destinationPath = public_path('upload');
                $file->move($destinationPath, $fullfilename);
                $add->productimage = $fullfilename;
                unlink("upload/" . $oldfilename);
            }
            $add->save();
        }
        return redirect("/productsummary");
    }


    //////////////// Change Password Controllers\\\\\\\\\\\\\\\\\\

    // Displaying Change Password Page
    public function changePass()
    {
        return view('adminPanel.changepassword');  // We can also use dot operator to return view from a folder.
    }

    // Changing password
    public function changePassSubmit(Request $request)
    {
        $username = $request->get('username');
        $oldpass = $request->get('oldpass');
        $newpass = $request->get('newpass');
        $confirmpass = $request->get('confirmpass');
        $result = adminLogin::find('where id username = ' . $username && 'password = ' . $oldpass);
        $resultId = $result->id;
        $data = adminLogin::select('*')
            ->where('username', $username)
            ->where('password', $oldpass)
            ->count();
        if ($data > 0) {
            $add = adminLogin::find($resultId);
            if ($request->isMethod('post')) {
                if ($confirmpass == $newpass) {

                    $add->password = $request->get('confirmpass');
                    $add->save();
                    return redirect("/index");
                } else {
                    return back()->withErrors("Invalid Credentials");
                }
            }
        } else {
            return back()->withErrors("Invalid Credentials");
        }
    }
}
