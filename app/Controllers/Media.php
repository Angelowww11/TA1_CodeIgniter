<?php

namespace App\Controllers;

use App\Libraries\MediaStore;

class Media extends BaseController
{
    public function show(string $filename)
    {
        if (! preg_match('/\A(?:[a-f0-9]{32}|demo-ceramic-mug|catalog-(?:ceramic-mug|canvas-tote-v2|notebook|brass-clips))\.jpg\z/i', $filename)) {
            return $this->response->setStatusCode(404);
        }

        if (MediaStore::usesDatabase()) {
            $image = MediaStore::find($filename);
            if (! $image || $image['bytes'] === '') {
                return $this->response->setStatusCode(404);
            }

            return $this->response
                ->setHeader('Content-Type', $image['mime_type'])
                ->setHeader('Cache-Control', 'public, max-age=86400, stale-while-revalidate=604800')
                ->setBody($image['bytes']);
        }

        foreach (['products', 'avatars'] as $folder) {
            $path = FCPATH . 'uploads/' . $folder . '/' . $filename;
            if (is_file($path)) {
                return $this->response
                    ->setHeader('Content-Type', 'image/jpeg')
                    ->setHeader('Cache-Control', 'public, max-age=86400')
                    ->setBody(file_get_contents($path));
            }
        }

        return $this->response->setStatusCode(404);
    }
}
