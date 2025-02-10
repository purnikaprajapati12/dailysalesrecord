<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Validation\Rule;


class ItemController extends Controller
{
    public function create_item()
    {
        $url = url('/create-item');
        $title = "Create item";
        $label = "Create";
        $categories = Category::all();
        $items = new item();
        $data = compact('url', 'title', 'label', 'categories', 'items');
        return view('admin.create-item')->with($data);
        // $items = Item::all();
        // return view('admin.create-item', compact('categories'));
    }
    public function item(Request $request)
    {
        $categoryId = $request->get('category_id') ?? 'all';
        if($categoryId != 'all'){
            $items = Item::where('category_id', $categoryId)->get();
        }else{
            $items = Item::all();
        }
        // Fetch all categories for the dropdown

        $categories = Category::all();
        return view('admin.manage-item', compact('items','categories', 'categoryId'));
    }
    
    public function search(Request $request){

        $categoryId = $request->get('category_id');

        // $items=Item::where('category_id'== $categoryId);

        dd($categoryId);

        $items = Item::when($categoryId, function($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })->get();

        // dd($items);

        // Fetch all categories for the dropdown
        $categories = Category::all();

        return view('admin.manage-item', compact('items', 'categories'));
    }

    public function store(Request $request)
    {
        $incommingFields = $request->validate([
            'name' => ['required', Rule::unique('item', 'name')],
            'category_id' => 'required',
            'price' => 'required'
        ]);

        Item::create($incommingFields);

        return redirect('manage-item')->with('success', 'created successfully');
    }
    public function edit($id)
    {
        $categories = Category::all();
        $items = Item::find($id);
        if (is_null($items)) {
            //not found
            return redirect('manage-item');
        } else {
            //found
            $title = "Update item";
            $label = "Update";
            $url = url('/update-item') . "/" . $id;
            $data = compact('items', 'url', 'title', 'label', 'categories');
            return view('admin.create-item')->with($data);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required'
            // Add validation rules for other fields if needed
        ]);

        // Find the product to be updated
        $items = Item::find($id);

        // Update the product with the new data
        $items->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            // Update other fields as needed
        ]);

        return redirect('manage-item')->with('message', 'item updated successfully!');
    }
    public function delete($id)
    {
        $res = Item::find($id);
        if (!is_null($res)) {
            $res->delete();
        }
        return redirect()->back()->with('message', 'Item deleted');
    }
}
