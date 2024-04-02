<?php

namespace App\Domain\Files\Actions;

use App\Domain\Files\Models\File;
use App\Domain\Files\DTO\StoreFileDTO;
use Illuminate\Support\Str;

class StoreFileAction
{
    public function execute(StoreFileDTO $dto)
    {
        $data = array();
        for ($i = 0; $i < count($dto->getTitle()); $i++) {
            $image = new File();
            $file = $dto->getTitle()[$i];
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . Str::random(6) . '.' . $extension;
            // Upload file
            $file->storeAs('public/files/files', $filename);
            // File path
            $filepath = url('storage/files/files/' . $filename);

            $image->title = $filename;
            $image->path = $filepath;
            $image->save();
            $data[$i] = [
                'id' => $image->id,
                'title' => $image->title,
                'path' => $filepath
            ];
        }

        return $data;
    }
}
