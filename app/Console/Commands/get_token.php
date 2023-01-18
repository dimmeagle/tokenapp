<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Console\UsersController;

class get_token extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting auth token for user';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        $username = $this->ask('Username: ');
        $password = $this->secret('Password: ');
        $checkUser = UsersController::checkUser($username, $password);
        switch ($checkUser) {
            case 0:
                echo 'User doesn\'t exist' . PHP_EOL;
                $user = UsersController::create($username, $password);
                Auth::login($user);
                echo 'User is created and authenticated' . PHP_EOL;
                break;
            case 2:
                echo 'User is authenticated successfully' . PHP_EOL;
                $user = Auth::user();
                break;
            default:
                echo 'Invalid credentials. Please try again' . PHP_EOL;
                $user = NULL;
                return false;
                break;
        }
        if ($user) {
            $token = $user->createToken('auth_token');
        }
        echo json_encode([
                'access_token' => $token,
                'token_type' => 'Bearer',]) . PHP_EOL;
        return Command::SUCCESS;
    }
}
