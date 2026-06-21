<?php

namespace Webkul\Shop\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Local\LocalFilesystemAdapter;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'parent_id'    => $this->parent_id,
            'name'         => $this->name,
            'slug'         => $this->slug,
            'status'       => $this->status,
            'position'     => $this->position,
            'display_mode' => $this->display_mode,
            'description'  => $this->description,
            'logo'         => $this->when($this->logo_path, fn () => $this->resolveImageUrls($this->logo_path)),
            'banner'       => $this->when($this->banner_path, fn () => $this->resolveImageUrls($this->banner_path)),
            'meta'         => [
                'title'       => $this->meta_title,
                'keywords'    => $this->meta_keywords,
                'description' => $this->meta_description,
            ],
            'translations' => $this->translations,
            'additional'   => $this->additional,
        ];
    }

    /**
     * Resolve image URLs based on the current storage driver.
     * For cloud storage (DO Spaces / S3) the original URL is used for all sizes
     * since local image-cache resizing is not available.
     */
    private function resolveImageUrls(string $path): array
    {
        if (Storage::getAdapter() instanceof LocalFilesystemAdapter) {
            return [
                'small_image_url'    => url('cache/small/'.$path),
                'medium_image_url'   => url('cache/medium/'.$path),
                'large_image_url'    => url('cache/large/'.$path),
                'original_image_url' => url('cache/original/'.$path),
            ];
        }

        $url = Storage::url($path);

        return [
            'small_image_url'    => $url,
            'medium_image_url'   => $url,
            'large_image_url'    => $url,
            'original_image_url' => $url,
        ];
    }
}
