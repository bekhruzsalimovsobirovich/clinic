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
            $filename = time() . Str::random(4) . '.' . $extension;
            // File upload location
            $location = 'files/';
            // Upload file
            $file->move($location, $filename);
            // File path
            $filepath = url('files/' . $filename);

            $image->title = $filename;
            $image->path = $filepath;
            $image->save();
            $data[$i] = [
                'id' => $image->id,
                'path' => $filepath
            ];
        }

        return $data;
    }
}
