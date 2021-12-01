<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class NewTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $url;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->url = route('tasks.show', ['task' => $task->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.new-task')->subject('Nova Tarefa Cadastrada');
    }
}
