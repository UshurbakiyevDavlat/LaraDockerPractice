<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class PostImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        try {
            DB::beginTransaction();
            foreach ($collection as $item) {
                Post::updateOrCreate([
                    'title' => $item[0]
                ], [
                    'title' => $item[0],
                    'content' => $item[1],
                    'user_id' => $item[2],
                    'image' => $item[3],
                    'category_id' => $item[4]
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            dd('error see logs');
        }
    }
}
