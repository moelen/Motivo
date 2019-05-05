<?php

namespace App\Http\Controllers;

use App\Entities\Todolists\TodoList;
use App\Http\Requests\Todolist\StoreItemRequest;
use App\Jobs\Todolists\StoreItemJob;
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
}
