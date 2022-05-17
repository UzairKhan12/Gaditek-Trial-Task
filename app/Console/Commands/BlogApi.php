<?php

namespace App\Console\Commands;

use App\Libraries\LumenWrapperClass;
use Illuminate\Console\Command;

class BlogApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blog crud api consumption';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $end_point_slug = 'blog';

    public function __construct()
    {
        $this->wrapper_class = new LumenWrapperClass();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->greetUser();

    }

    private function greetUser()
    {
        $this->info('*********************************************');
        $this->info('1. Create Blog');
        $this->info('2. Update Blog');
        $this->info('3. Get Single Blog');
        $this->info('4. Delete Blog');
        $this->info('5. Get All Blogs');
        $this->info('0. Exit');
        $this->info('*********************************************');

        $response = $this->callWrapperApis($this->ask('Enter Your input'));

        if (!$response){

            return 0;
        }

        $this->info(json_encode($response));

        $this->handle();
    }

    private function callWrapperApis($input)
    {
        $response = true;

        switch ($input) {

            case '1':

                $title = $this->ask('Enter blog title');

                $description = $this->ask('Enter blog description');

                $payload = [
                    'title' => $title,
                    'description' => $description
                ];

                $response = $this->wrapper_class->curlRequest($this->end_point_slug, '', 'POST', $payload);

                break;
            case '2':

                $id = $this->ask('Enter blog Id');

                $title = $this->ask('Enter blog title (Leave it empty to keep it unchanged)');

                $description = $this->ask('Enter blog description (Leave it empty to keep it unchanged)');

                $payload = [
                    'title' => $title,
                    'description' => $description
                ];

                $response = $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $id, 'PUT', $payload);

                break;

            case '3':

                $id = $this->ask('Enter blog Id');

                $response = $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $id, 'GET');

                break;

            case '4':

                $id = $this->ask('Enter blog Id');

                $response = $this->wrapper_class->curlRequest($this->end_point_slug, '/' . $id, 'DELETE');

                break;

            case '5':

                $response = $this->wrapper_class->curlRequest($this->end_point_slug, '', 'GET');

                break;

            case '0':

                $response = false;

                break;

            default:

                $response = 'Invalid input';
        }

        return $response;

    }

}
