<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Models\Category;
use App\Models\Product;

class ProductService
{

  /**
   * Получаем товар
   *
   * @param int $id
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getProduct($id)
  {
    return Product::with('categories')->find($id);
  }

  /**
   * Получаем товары
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getProducts()
  {
    return Product::with('categories')->orderBy('product_id')->get();
  }

  /**
   * Получаем категории
   *
   * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
   * @return \Illuminate\Support\Collection
   */
  public function getCategories()
  {
    return Category::orderBy('category_id')->get();
  }

  /**
   * Сохраняем фото и возвращаем названия
   *
   * @param $files array
   * @param $name string
   * @return boolean
   */
  public function storeImage($files, $name)
  {
    $path = [];

    foreach ($files as $key => $file) {
      $new_name = $key > 0 ? $name . '_' . ($key + 1) : $name;
      if (!is_string($file)) {
        $temp = Storage::putFile('public/images/items', $file);

        $this->resizeImage($temp, $new_name, 'original');
        $this->resizeImage($temp, $new_name, 'small', null, 120);
        $this->resizeImage($temp, $new_name, 'thumb', 78, 78);
        $resultPath = $this->resizeImage($temp, $new_name, '', null, 380);

        Storage::delete($temp);
        array_push($path, $resultPath);
      }
    }

    return implode(';', $path);
  }

  /**
   * Изменяем фото и возвращаем названия
   *
   * @param $product_id int
   * @param $files array
   * @param $newImagePaths array
   * @param $name string
   * @return boolean
   */
  public function updateImage($product_id, $files, $newImagePaths, $name)
  {
    $newImagePaths = $newImagePaths ?: [];
    $currentImages = collect(explode(';', Product::find($product_id)->image_path));
    $imagesForRemove = $currentImages->filter(function ($item) use ($newImagePaths) {
      return !in_array($item, $newImagePaths ?: []);
    });

    $imagesForRemove->each(function ($item) {
      $name = substr($item, 0, strrpos($item, '.'));
      $extension = substr($item, strrpos($item, '.') + 1);

      Storage::delete('public' . $item);
      Storage::delete('public' . $name . '.webp');
      Storage::delete('public' . $name . '-original.' . $extension);
      Storage::delete('public' . $name . '-original.webp');
      Storage::delete('public' . $name . '-small.' . $extension);
      Storage::delete('public' . $name . '-small.webp');
      Storage::delete('public' . $name . '-thumb.' . $extension);
      Storage::delete('public' . $name . '-thumb.webp');
    });


    function choiceImageName($name, $newImagePaths)
    {
      static $count = 0;

      $newName = $count > 0 ? $name . '_' . ($count + 1) : $name;

      $newImagePaths = collect($newImagePaths)->map(function ($item) {
        return substr($item, 0, strrpos($item, '.'));
      })->toArray();

      if (in_array("/images/items/$newName", $newImagePaths)) {
        $count++;
        return choiceImageName($name, $newImagePaths);
      } else {
        return $newName;
      }
    }

//    return $name;
//    return choiceImageName($name, $newImagePaths);
    if ($files) {
      foreach ($files as $key => $file) {
        $newName = choiceImageName($name, $newImagePaths);

        if (!is_string($file)) {
          $temp = Storage::putFile('public/images/items', $file);

          $this->resizeImage($temp, $newName, 'original');
          $this->resizeImage($temp, $newName, 'small', null, 120);
          $this->resizeImage($temp, $newName, 'thumb', 78, 78);
          $resultPath = $this->resizeImage($temp, $newName, '', null, 380);

          Storage::delete($temp);
          array_push($newImagePaths, $resultPath);
        }
      }
    }

    return implode(';', $newImagePaths);
  }

  /**
   * Изменяем фото и возвращаем названия
   *
   * @param $product_id int

   * @return boolean
   */
  public function deleteImage($product_id)
  {
    $product = Product::where('product_id', $product_id)->get()->toArray();
    $image_paths = explode(';',$product[0]['image_path'] ?? '');

    collect($image_paths)->each(function ($item) {
      $name = substr($item, 0, strrpos($item, '.'));
      $extension = substr($item, strrpos($item, '.') + 1);

      Storage::delete('public' . $item);
      Storage::delete('public' . $name . '.webp');
      Storage::delete('public' . $name . '-original.' . $extension);
      Storage::delete('public' . $name . '-original.webp');
      Storage::delete('public' . $name . '-small.' . $extension);
      Storage::delete('public' . $name . '-small.webp');
      Storage::delete('public' . $name . '-thumb.' . $extension);
      Storage::delete('public' . $name . '-thumb.webp');
    });

    return $image_paths;
  }

  /**
   * Обрезаем фотографии и добавляем формат-webp
   *
   * @param $img string
   * @param $name string
   * @param $salt string
   * @param $width int
   * @param $height int
   *
   * @return string
   */
  public function resizeImage($img, $name, $salt = '', $width = null, $height = null)
  {
    $img = Image::make(Storage::path($img));
    $extension = $img->extension;
    $salt = $salt ? '-' . $salt : '';
    $path = Storage::path("public/images/items/$name$salt.");

    if ($width || $height) {
      $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
      });
    }

    $img->save($path . $extension);

    $img = $extension == 'png'
      ? imagecreatefrompng($path . $extension)
      : imagecreatefromjpeg($path . $extension);
    imagewebp($img, $path . 'webp', 100);

    return "/images/items/$name.$extension";
  }
}
