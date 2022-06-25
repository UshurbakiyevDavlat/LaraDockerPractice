<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Post;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportWpPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:jsonWpPosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import posts from jsonWpPosts api';

    /**
     * Execute the console command.
     *
     * @return Application|Response|ResponseFactory
     */
    public function handle()
    {
        $import = new ImportDataClient();

        Auth::attempt([
            'email' => 'davlat.accdev@gmail.com',
            'password' => 'dada2000'
        ]);

        try {
            $request = $import->client->request('GET', 'posts');
            $posts = json_decode($request->getBody()->getContents());

            DB::beginTransaction();
            foreach ($posts as $post) {
                Post::updateOrCreate([
                    'title' => $post->slug
                ], [
                    'title' => $post->slug,
                    'content' => $post->content->rendered,
                    'user_id' => auth()->user()->getAuthIdentifier(),
                    'image' => $post->parsely->meta->image->url,
                    'category_id' => 31
                ]);
            }
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return response('error see logs', 400);

        } catch (GuzzleException $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return response('error see logs', 400);
        }

        print('Posts were imported successfully');
        Log::info('Posts were imported successfully');
    }
}
