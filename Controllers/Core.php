<?php

namespace Mark\Controllers;

class Core
{
    private $arguments;
    private $db;

    public function __construct($db, $arguments)
    {
        $this->arguments = $arguments;
        $this->db = $db;
    }

    private function f_get($page, $sort, $token = '')
    {
        $arr = ['list' => $this->db->selectTask(($page - 1) * 3, (int)$sort),
            'quantity' => $this->db->getNumberTasks(), 'page' => (int)$page, 'sort' => (int)$sort, 'error' => ''];
        if ($token !== '') $arr['token'] = $token;
        echo \json_encode($arr);
        exit();
    }

      private function f_status()
    {
        // Остальные параметры не поверяю, т.к. работа в ЛК
        if ($this->db->checkToken($this->arguments['token'])) {
            $par = '';
            if ($this->arguments['status'] === 'changeStatus') $par = $this->arguments['task'];
            $this->db->replaceTasks($this->arguments['number'], $this->arguments['status'], $par);
            $page = ceil($this->db->getPageNumber ($this->arguments['number'], $this->arguments['sort']) / 3) ;
            $this->f_get($page, $this->arguments['sort']);
        }
        $this->f_err();
    }

    private function f_add($user, $mail, $task)
    {
        $id = $this->db->addTask($user, $mail, $task, 'mainStatus');
        $page = ceil($this->db->getPageNumber ($id, $this->arguments['sort']) / 3) ;
        $this->f_get($page, $this->arguments['sort']);
    }


    private function f_login()
    {
        if ($this->arguments['login'] === 'admin' && $this->arguments['passw'] === '123') {
            $token = $this->db->getToken($this->arguments['login'], $this->arguments['passw']);
            $this->f_get(1, 0, $token);
        }
        $this->f_err();
    }

    private function f_out()
    {
        if ($this->db->checkToken($this->arguments['token'])) {
            $this->db->deleteToken($this->arguments['token']);
            $this->f_get(1, 0);
        }
        $this->f_err();
    }

    private function f_err()
    {
        echo \json_encode(['error' => 'repeat']);
        exit();
    }

    public function run()
    {
        $user = $this->arguments['user'] ?? '';
        $mail = $this->arguments['mail'] ?? '';
        $task = $this->arguments['task'] ?? '';
        $user = \htmlentities($user, ENT_COMPAT | ENT_HTML401, "UTF-8");
        $mail = \htmlentities($mail, ENT_COMPAT | ENT_HTML401, "UTF-8");
        $task = \htmlentities($task, ENT_COMPAT | ENT_HTML401, "UTF-8");
        switch ($this->arguments['action']) {
            case 'get':
                $this->f_get($this->arguments['page'], $this->arguments['sort']);
                break;
            case 'add':
                $this->f_add($user, $mail, $task);
                break;
            case 'sort':
                $this->f_get(1, $this->arguments['sort']);
                break;
            case 'login':
                $this->f_login();
                break;
            case 'status':
            case 'replace':
                $this->f_status();
                break;
            case 'out':
                $this->f_out();
                break;
            default:
                $this->f_err();
        }
    }
}
