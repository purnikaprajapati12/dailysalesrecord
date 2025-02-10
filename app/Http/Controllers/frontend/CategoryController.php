<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function category()
    {
        $categories = Category::all();
        return view('admin.manage-category', compact('categories'));
    }
    public function create_category()
    {
        $url = url('/create-category');
        $title = "Create Category";
        $label = "Create";
        $categories = new Category();
        $data = compact('url', 'title', 'label', 'categories');
        return view('admin.create-category')->with($data);
    }

    public function store(Request $request)
    {
        $incommingFields = $request->validate([
            'name' => 'required',
        ]);

        Category::create($incommingFields);
        return redirect('manage-category')->with('success', 'Category Created.');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        if (is_null($categories)) {
            //not found
            return redirect('manage-category');
        } else {
            //found
            $title = "Update Category";
            $label = "Update";
            $url = url('/update-category') . "/" . $id;
            $data = compact('categories', 'url', 'title', 'label');
            return view('admin.create-category')->with($data);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', Rule::unique('category', 'name')],
            // Add validation rules for other fields if needed
        ]);

        // Find the product to be updated
        $categories = Category::find($id);

        // Update the product with the new data
        $categories->update([
            'name' => $request->input('name'),
            // Update other fields as needed
        ]);

        return redirect('manage-category')->with('message', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $res = Category::find($id);
        if (!is_null($res)) {
            $res->delete();
        }
        return redirect()->back()->with('message','Category deleted');
    }
}
