<?php
//app\Http\Controllers\ProductController.php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
 
class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $products = Product::all();
        $query = Product::query();
        if (request()->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%")
                ->orWhere('description', 'like', "%" . $request->search . "%");
        }
        $products = $query->latest()->paginate(3);
 
        return view("product.index", compact("products"));
    }
 
    public function create()
    {
        return view("product.create");
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "status" => "required",
            "image" => "nullable|image|mimes:jpg,png",
        ]);
 
        if ($request->hasFile("image")) { //php artisan storage:link
            $validated["image"] = $request->file("image")->store("products", "public");
        }
        Product::create($validated);
 
        return redirect()->route("products.index")->with("success", "product added successfully");
    }
 
    public function show($id)
    {
        $product = Product::find($id);
        return view("product.show", compact("product"));
    }
 
    public function edit($id)
    {
        $product = Product::find($id);
        return view("product.edit", compact("product"));
    }
 
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "status" => "required",
            "image" => "nullable|image|mimes:jpg,png",
        ]);
 
        if ($request->hasFile("image")) {
            if ($request->image && Storage::disk("public")->exists($request->image)) {
                Storage::disk("public")->delete($request->image);
            }
            $validated["image"] = $request->file("image")->store("products", "public");
        }
 
        Product::find($id)->update($validated);
 
        return redirect()->route("products.index")->with("success", "product updated successfully!");
    }
 
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route("products.index")->with("success", "product deleted successfully!");
    }
 
    public function trashedProducts(Request $request)
    {
        $query = Product::query()->onlyTrashed();
        $products = $query->paginate(3);
        return view("product.deleted-products", compact("products"));
    }
 
    public function showTrashed($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        return view("product.show", compact("product"));
    }
 
    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route("products.index")->with("success", "product restored successfully");
    }
 
    public function destroyProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->forceDelete();
 
        return redirect()->route("products.index")->with("success", "product was force deleted successfully!");
    }
}