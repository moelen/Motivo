<?php

namespace App\Http\Controllers;

use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreTodolistRequest;
use App\Jobs\Todolists\LoadTodolistsJob;
use App\Jobs\Todolists\StoreTodolistJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TodolistController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        $todolists = $this->dispatchNow(new LoadTodolistsJob());

        return view('todolist.index', compact('todolists'));
    }

    /**
     * @param TodoList $todolist
     *
     * @return View
     */
    public function show(TodoList $todolist): View
    {
        return view('todolist.show', compact('todolist'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('todolist.create');
    }

    /**
     * @param StoreTodolistRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTodolistRequest $request): RedirectResponse
    {
        $this->dispatchNow(new StoreTodolistJob($request));

        return redirect()->route('todolist.index');
    }

    /**
     * @param TodoList $todolist
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(TodoList $todolist): RedirectResponse
    {
        $todolist->delete();

        return redirect()->route('todolist.index');
    }
}
