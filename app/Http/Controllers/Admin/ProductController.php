<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\Admin\ProductService;
use App\Http\Requests\Admin\ProductStore;
use App\Http\Requests\Admin\ProductUpdate;
use App\Models\Product;

class ProductController extends Controller
{
  protected $productService;

  public function __construct(ProductService $productService)
  {
    $this->productService = $productService;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
//    dd($this->productService->getProducts()->toArray());
    return view('admin/product')->with([
      'products' => $this->productService->getProducts(),
      'categories' => $this->productService->getCategories()
    ]);
  }

  public function categories()
  {
    return $this->productService->getCategories();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin/product-create')->with([
      'products' => $this->productService->getProducts(),
      'categories' => $this->productService->getCategories()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param ProductStore $request
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   */
  public function store(ProductStore $request)
  {
    $slug = TransliterationHelper($request->input('name') . "-" . $request->input('article'));

    $product = new Product;
    $product->name = $request->input('name');
    $product->slug = $slug;
    $product->category_id = $request->input('categories')[0];
    $product->manufacturer = $request->input('manufacturer');
    $product->article = $request->input('article');
    $product->meta_keywords = $request->input('meta_keywords');
    $product->meta_description = $request->input('meta_description');
    $product->meta_title = $request->input('meta_title');
    $product->available = $request->input('available');
    $product->weight = $request->input('weight');
    $product->price = $request->input('price');
    $product->dimension = $request->input('dimension');
    $product->comment = $request->input('comment');
    $product->material = $request->input('material');
    $product->technic = $request->input('technic');
    $product->description = $request->input('description');
    $product->video = $request->input('video');
    $product->image_path = $this->productService->storeImage($request->file('files'), $slug);
    $product->similar_product_id = $request->input('similar_product') ? implode(';', $request->input('similar_product')) : '';

    $product->save();
    $product->categories()->attach($request->input('categories'));

    return $this->productService->getProducts();
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   */
  public function show($id)
  {
    return $this->productService->getProduct($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return view('admin/product-edit')->with([
      'data' => collect([
        'products' => $this->productService->getProducts(),
        'product' => $this->productService->getProduct($id),
        'categories' => $this->productService->getCategories()
      ])
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param ProductUpdate $request
   * @return object
   */
  public function update(ProductUpdate $request)
  {
    $id = $request->input('id');
    $files = $request->file('files');
    $newImagePaths = $request->input('currentFiles');
    $slug = TransliterationHelper($request->input('name') . "-" . $request->input('article'));

    $product = Product::find($id);
    $product->update([
      'name' => $request->input('name'),
      'slug' => $slug,
      'category_id' => $request->input('categories')[0],
      'manufacturer' => $request->input('manufacturer'),
      'article' => $request->input('article'),
      'meta_keywords' => $request->input('meta_keywords'),
      'meta_description' => $request->input('meta_description'),
      'meta_title' => $request->input('meta_title'),
      'available' => $request->input('available'),
      'weight' => $request->input('weight') ?? '',
      'price' => $request->input('price'),
      'dimension' => $request->input('dimension') ?? '',
      'comment' => $request->input('comment') ?? '',
      'material' => $request->input('material'),
      'technic' => $request->input('technic'),
      'description' => $request->input('description'),
      'video' => $request->input('video'),
      'image_path' => $this->productService->updateImage($id, $files, $newImagePaths, $slug),
      'similar_product_id' => $request->input('similar_product') ? implode(';', $request->input('similar_product')) : '',
    ]);

    $product->categories()->sync($request->input('categories'));

    return $this->productService->getProduct($id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   */
  public function destroy($id)
  {
    Product::destroy($id);
    return $this->productService->getProducts();
  }
}
