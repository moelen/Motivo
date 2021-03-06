<?php

namespace App\Http\Controllers;

use App\Entities\Todolists\Item;
use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreItemRequest;
use App\Http\Requests\Todolist\UpdateItemRequest;
use App\Jobs\Todolists\StoreItemJob;
use App\Jobs\Todolists\UpdateItemJob;
use App\Jobs\Todolists\UpdateItemOrder;
use App\Transformers\Todolists\ItemTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @param ItemTransformer $transformer
     *
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $request, TodoList $todoList, ItemTransformer $transformer): RedirectResponse
    {
        $data = $transformer->transform($request);

        $this->dispatchNow(new StoreItemJob($data, $todoList));

        return redirect()->route('todolist.show', $todoList);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $this->dispatchNow(new UpdateItemOrder($request));

        return response()->json(['success' => 'success']);
    }

    /**
     * @param TodoList $todoList
     * @param Item $item
     *
     * @return View
     */
    public function edit(TodoList $todoList, Item $item): View
    {
        return view('todolist.item.edit', compact('todoList', 'item'));
    }

    /**
     * @param UpdateItemRequest $request
     * @param TodoList $todoList
     * @param Item $item
     * @param ItemTransformer $transformer
     *
     * @return RedirectResponse
     */
    public function update(UpdateItemRequest $request, TodoList $todoList, Item $item, ItemTransformer $transformer): RedirectResponse
    {
        $data = $transformer->transform($request);

        $this->dispatchNow(new UpdateItemJob($data, $item));

        return redirect()->route('todolist.show', $todoList);
    }

    /**
     * @param TodoList $todoList
     * @param Item $item
     *
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function destroy(TodoList $todoList, Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('todolist.show', $todoList);
    }
}
