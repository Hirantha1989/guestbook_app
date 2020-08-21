<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Comment;
use Illuminate\Support\Facades\DB;

class CommentModeration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:moderation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moderate comments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $comments = Comment::Where('status', 'NEW')
            ->get();
        foreach ($comments as $comment) {
            if (strpos($comment->message, 'baddd') !== false) {
                DB::table('comments')
                    ->where('id', $comment->id)
                    ->update(['status' => 'REJECTED']);
            } else {
                DB::table('comments')
                    ->where('id', $comment->id)
                    ->update(['status' => 'ACCEPTED']);
            }
        }
    }
}
