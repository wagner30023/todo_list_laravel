<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Todo;

class ApiController extends Controller
{
    public function createTodo(Request $request)
    {
        $array = ['error' => ''];

        $rules = [
            'title' => 'required|min:3'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido ',
            'title.min' => 'O campo título deve ter no mínimo 3 caracteres.'
        ];

        $validator = Validator::make($request->all(), $rules,$feedback);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $title = $request->input('title');

        $todo = new Todo();
        $todo->title = $title;
        $todo->save();

        return $array;
    }

    public function readAllTodos()
    {
        $array = ['error' => ''];
        // $array['list'] = Todo::all();

        // pagination
        $todos = Todo::simplePaginate(3);
        $array['list'] = $todos->items(); // pega a lista real
        $array['current_page'] = $todos->currentPage();
        return $array;
    }

    public function readTodo($id)
    {
        $array = ['error' => ''];

        $todo = Todo::find($id);

        if ($todo) {
            $array['todo'] = $todo;
        } else {
            $array['error'] = 'A tarefa ' . $id . ' não existe';
        }

        return $array;
    }

    public function updateTodo(Request $request, $id)
    {
        $array = ['error' => ''];

        $rules = [
            'title' => 'required|min:3',
            'done' => 'boolean'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $array['error'] = $validator->messages();
            return $array;
        }

        $title = $request->input('title');
        $done = $request->input('done');

        // Atualizando item 
        $todo = Todo::find($id);

        if ($todo) {
            if ($title) {
                $todo->title = $title;
            }

            if ($done) {
                $todo->done = $done;
            }

            $todo->save();
        } else {
            $array['error'] = 'A tarefa ' . $id . ' não existe, logo não pode ser atualizado';
        }

        return $array;
    }

    public function deleteTodo($id)
    {
      $array = ['error' => ''];
        $todo = Todo::find($id);
        $todo->delete();
        return $array;
    }
}
