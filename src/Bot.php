<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use src\User;
require "src/User.php";
class Bot
{
    const string TOKEN = "7279583274:AAFi8wAbq7WtquAV-ECXTdi6j7kMwC5XXts";
    const string API   = "https://api.telegram.org/bot" . self::TOKEN . "/";
    public Client $http;
    private PDO   $pdo;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::API]);
        $this->pdo  = DB::connect();
    }

    public function handleStartCommand(int $chatId): void
    {
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'    => 'Assalomu Alaykuum......',
            ]
        ]);
    }

    public function handleAddCommand(int $chatId): void
    {

        $user = new User();
        $user->setStatus((int)$chatId);

        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'    => 'biror malumot kiriting ',
            ]
        ]);
    }
    public function handleDeleteCommand(int $chatId): void
    {
        $user = new User();
        $user->setStatus((int)$chatId, 'delete');

        $tasks = $this->getUserAllTasks((int)$chatId);

        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'         => "Please, chouse your task:\n\n" . $this->prepareTexts($tasks),
                'reply_markup' => $this->prepareButtons($tasks)
            ]
        ]);
    }
    public function addTask(int $chatId, string $text): void
    {
        $user = new User();
        $userId = $user->getUserInfo((int)$chatId)->id;

        $task = new Task();
        $task->add($text, $userId);

        $commands = null;
        $stmt   = $this->pdo->prepare("UPDATE USERID SET commands=:commands WHERE chat_id = :chatId");
        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':commands', $commands, PDO::PARAM_NULL);
        $stmt->execute();

        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'    => 'Task added successfully',
            ]
        ]);
    }

    public function getUserAllTasks(int $chatId)
    {
        $query = "SELECT * FROM todo_app WHERE user_id = (SELECT id FROM USERID WHERE chat_id = :chatId LIMIT 1)";
        $stmt  = $this->pdo->prepare($query);
        $stmt->bindParam(':chatId', $chatId);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->prepareTasks($tasks);
    }
    public function getAllTasks(int $chatId): void
    {

        $tasks = $this->getUserAllTasks($chatId);
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id'      => $chatId,
                'text'         => $this->prepareTexts($tasks),
                'reply_markup' => $this->prepareButtons(
                    $tasks,
                    [['text' => 'Delete', 'callback_data' => 'delete_task']]
                )
            ]
        ]);
    }

    private function prepareTasks(array $tasks): array
    {
        $result = [];
        foreach ($tasks as $task) {
            $result[] = [
                'task_id' => $task['id'],
                'text'    => $task['text'],
                'status'  => $task['status']
            ];
        }

        return $result;
    }

    private function prepareTexts(array $tasks): string
    {
        $text    = '';
        $counter = 1;
        for ($task = 0; $task < count($tasks); $task++) {
            $status = $tasks[$task]['status'] === 0 ? '🟩' : '✅';
            $text   .= $status . " " . $counter + $task . ". {$tasks[$task]['text']}\n";
        }

        return $text;
    }

    private function prepareButtons(array $tasks, array $additional_buttons = []): false|string
    {
        $buttons = ['inline_keyboard' => []];
        foreach ($tasks as $index => $task) {
            $buttons['inline_keyboard'][] = [['text' => ++$index, 'callback_data' => $task['task_id']]];
        }

        $additional_buttons ? $buttons['inline_keyboard'][] = $additional_buttons : '';
        return json_encode($buttons);
    }

    public function handleInlineButton(int $chatId, int $data): void
    {
        $task = new Task();

        $currentTask = $task->getTask($data);

        if ($currentTask->status === 0) {
            $task->complete($data);
            $text = 'Task completed';
        } else {
            $task->uncompleted($data);
            $text = 'Task uncompleted';
        }

        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'    => $text,
            ]
        ]);

        $this->getAllTasks($chatId);
    }

    public function handleDeleteTask(int $chatId, int $data): void
    {
        $task = new Task();
        $task->delete($data);
        $this->http->post('sendMessage', [
            'form_params' => [
                'chat_id' => $chatId,
                'text'    => 'Deleted task',
            ]
        ]);
        $this->getAllTasks($chatId);
    }
}
