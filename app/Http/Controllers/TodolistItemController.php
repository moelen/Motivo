<?php

namespace App\Http\Controllers;

use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreItemRequest;
use App\Jobs\Todolists\StoreItemJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TodolistItemController extends Controller
{

    /**
     * @return View
     */
    public function create(): View
    {
        return view('todolist.item.create');
    }

    /**
     * @param StoreItemRequest $request
     * @param TodoList $todoList
     *
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request, TodoList $todoList): RedirectResponse
    {
        $this->dispatchNow(new StoreItemJob($request, $todoList));

        return redirect()->route('todolist.show', $todoList);
    }
}
