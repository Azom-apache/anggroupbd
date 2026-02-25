<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Tag;
use App\Models\Unit;
use App\Models\Brand;
use PhpOption\Option;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Enum\ProductStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Models\Subcategory;
use App\Enum\DiscountStatus;
use App\Lib\Resource\Column;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Attributevalue;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    static protected $heading = [
        'index' => 'Product',
        'create' => 'Create Product',
        'show' => 'Product Details',
        'edit' => 'Edit Product',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Product::with('category','subcategory'))->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.product',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('name_en'),
                Column::make('category.name'),
                Column::make('subcategory.name'),
                Column::make('buy_price'),
                Column::make('sale_price'),
                Column::make('discount_price'),
                Column::make('stock_quantity'),
                Column::make('point'),
                Column::make('image'),
                Column::make('status'),
            ],
            'statusMap' => ProductStatus::class,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.product.create');
        // return view('admin.resource.create', [
        //     'name'             => 'admin.product',
        //     'skipPermission'=>false,
        //     'name'   => 'admin.notice',
        //     'heading' => self::$heading,
        //     'permissionPrefix' => 'product',
        //     'fields'           => [
        //         Field::text('name_en')->label('Name English'),
        //         Field::text('name_bn')->label('Name Bangla'),
        //         Field::select('category_id')->label('Category')->options(Category::select('id', 'name')->get()),
        //         Field::select('brand_id')->label('Brand')->options(Brand::select('id', 'name')->get()),
        //         Field::select('unit_id')->label('Unit')->options(Unit::select('id', 'name')->get()),
        //         //Field::select('vendor_id')->label('Vendor')->options(Vendor::select('id', 'shop_name')->get())->visible(auth()->user()->isA(['admin'])),
        //         //Field::select('supplier_id')->label('Supplier')->options(Supplier::select('id', 'supplier_name')->get())->visible(auth()->user()->isA(['admin'])),
        //         Field::tags('tags')->label('Tags')->options(Tag::select('id', 'name')->get()),
        //         Field::select('attribute_id')->label('Attribute')->options(Attribute::select('id', 'name')->get()),
        //         Field::tags('attributevalue_id')->label('Attribute Value')->options(Attributevalue::select('id', 'attribute_value', 'attribute_id')->get(),
        //             function ($value) {
        //                 return [$value->id => Option::make($value->id, $value->name)->parent($value->attribute_id)];
        //             }
        //         )->dependOn('attribute_id'),
        //         Field::number('buy_price')->label('Buy price'),
        //         Field::number('sale_price')->label('Sale price'),
        //         Field::select('discount_type')->options(DiscountStatus::asSelectArray()),
        //         Field::number('discount')->label('Discount price'),
        //         Field::number('member_discount')->label('Member Discount'),
        //         Field::number('min_purchase_quantity')->label('Min Purchase quantity'),
        //         Field::number('stock_quantity')->label('Stock quantity'),
        //         Field::textarea('description_en')->label('Description in english')->isEditor(),
        //         Field::textarea('description_bn')->label('Description in bangla')->isEditor2(),
        //         Field::text('meta_title')->label('Meta title'),
        //         Field::text('meta_description')->label('Meta description')->isEditor3(),
        //         Field::file('image')->label('Image'),
        //         Field::select('status')->options(ProductStatus::asSelectArray()),
        //         Field::number('referral_commission')->label('Referral Commission')->value(0),
        //         Field::number('reward_point')->label('Reward Point')->value(0),
        //         Field::number('generation_commission')->label('Generation Commission')->multiple(),
               
        //     ],
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       

        $validated = $request->validate([
            'name_en'    => 'required',
            'name_bn'    => 'nullable',
            'category_id'    => 'nullable',
            'subcategory_id'    => 'nullable',
            'brand_id'    => 'nullable',
            'unit_id'    => 'nullable',
            'short_text'    => 'nullable',
            'buy_price'    => 'nullable',
            'sale_price'    => 'nullable',
            'discount_type'    => 'nullable',
            'discount_price'    => 'nullable',
            'min_purchase_quantity'    => 'nullable',
            'stock_quantity'    => 'nullable',
            'alert_quantity'    => 'nullable',
            'point'    => 'nullable',
            'code'    => 'nullable',
            'description_en'    => 'nullable',
            'description_bn'    => 'nullable',
            'attribute_id'    => 'nullable',
            'attribute_value'    => 'nullable',
            'image'    => 'nullable',
            'images'    => 'nullable',
            'created_by'    => 'nullable',
            'sister_id' => 'nullable',

     
        ]);

        $validated['created_by'] = auth()->user()->id;
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        try {
          DB::beginTransaction();
           $product=Product::create($validated);
           foreach ($request->attribute_id as $key=> $value){
            $attribute=new ProductAttribute();
            $attribute->product_id=$product->id;
            $attribute->attribute_id=$request->attribute_id[$key];
            $attribute->attribute_value=$request->attribute_value[$key];
            $attribute->save();
           }
           if (isset($request->images)){
            foreach ($request->images as $key=> $value){
                $image=new ProductImage();
                $image->product_id=$product->id;
    
                if (isset($request->images[$key]) && $file = $request->images[$key]) {
                    $extention = $file->getClientOriginalName();
                    $filename = time() . rand(0, 9999) . '.' . $extention;
                    $file->move('upload/product', $filename);
                    $image->image = $filename;
                }
                $image->save();
               }
           }
          

            DB::commit();
            return response()->report($validated,'Successfully created');
        }catch (Exception $exception){
            DB::rollBack();
            return $exception;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {
        return view('admin.resource.show', [
            'name'             => 'admin.product',
            'heading'          => [
                'index'  => 'product',
                'create' => 'Create Product',
                'show'   => 'Show Product',
            ],
            'permissionPrefix' => 'Product',
            'model'            => $product,
            'columns' => [
                'name_en',
                'name_bn',
               // Column::make('Category', $product->category->name ??''),
                // Column::make('Brand', $product->brand->name),
                // Column::make('Unit', $product->unit->name),
                'buy_price',
                'sale_price',
                'discount_type',
                'discount',
                'min_purchase_quantity',
                'stock_quantity',
                'image',
                'point',
              
            ],

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
       return view('admin.resource.edit', [
        'model'            => $product,

            'name'             => 'admin.product',
            'skipPermission'=>false,
            'name'   => 'admin.product',
            'heading' => self::$heading,
            'permissionPrefix' => 'product',
            'fields'           => [
                Field::text('name_en')->label('Product Name '),
                Field::text('name_bn')->label('Product Name Bangla'),
                Field::select('category_id')->label('Category')->options(Category::select('id', 'name')->get()),
                Field::select('subcategory_id')->label('Sub Category')->options(Subcategory::select('id', 'name')->get()),
                Field::select('brand_id')->label('Brand')->options(Brand::select('id', 'name')->get()),
                Field::select('unit_id')->label('Unit')->options(Unit::select('id', 'name')->get()),
           
                Field::select('sister_id')->label('Sister Consern')->options(Client::select('id', 'name')->get()),
                //Field::select('supplier_id')->label('Supplier')->options(Supplier::select('id', 'supplier_name')->get())->visible(auth()->user()->isA(['admin'])),
                Field::tags('tags')->label('Tags')->options(Tag::select('id', 'name')->get()),
                Field::select('attribute_id')->label('Attribute')->options(Attribute::select('id', 'name')->get()),
               
                Field::number('buy_price')->label('Buy price'),
                Field::number('sale_price')->label('Sale price'),
                Field::select('discount_type')->options(DiscountStatus::asSelectArray()),
                Field::number('discount')->label('Discount price'),
                Field::number('member_discount')->label('Member Discount'),
                Field::number('min_purchase_quantity')->label('Min Purchase quantity'),
                Field::number('stock_quantity')->label('Stock quantity'),
                Field::textarea('description_en')->label('Description in english')->isEditor(),
                Field::textarea('description_bn')->label('Description in bangla')->isEditor2(),
                Field::text('meta_title')->label('Meta title'),
                Field::text('meta_description')->label('Meta description')->isEditor3(),
                Field::file('image')->label('Image'),
                Field::select('status')->options(ProductStatus::asSelectArray()),
            
              
               
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        $validated = $request->validate([
            'name_en'    => 'nullable',
            'name_bn'    => 'nullable',
            'category_id'    => 'nullable',
            'subcategory_id'    => 'nullable',
            'brand_id'    => 'nullable',
            'unit_id'    => 'nullable',
            'short_text'    => 'nullable',
            'buy_price'    => 'nullable',
            'sale_price'    => 'nullable',
            'discount_type'    => 'nullable',
            'discount_price'    => 'nullable',
            'min_purchase_quantity'    => 'nullable',
            'stock_quantity'    => 'nullable',
            'alert_quantity'    => 'nullable',
            'point'    => 'nullable',
            'code'    => 'nullable',
            'description_en'    => 'nullable',
            'description_bn'    => 'nullable',
            'attribute_id'    => 'nullable',
            'attribute_value'    => 'nullable',
            'image'    => 'nullable',
            'images'    => 'nullable',
            'created_by'    => 'nullable',
            'sister_id' => 'nullable',

     
        ]);

        $validated['created_by'] = auth()->user()->id;
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($product->update($validated), 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product) {
        try{
            $ProductAttribute = ProductAttribute::where('product_id',$product->id)->delete();
            $ProductImage = ProductImage::where('product_id',$product->id)->delete();
            $product->delete();
            Image::delete($product, 'image');
            return response()->success('Product deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong!');
        }
        
    }
}
