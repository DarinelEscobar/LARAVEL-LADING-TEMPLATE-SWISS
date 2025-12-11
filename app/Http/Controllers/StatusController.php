<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function index(): View
    {
        $statuses = Status::with('type')->orderBy('id')->get();

        return view('statuses.index', compact('statuses'));
    }

    public function create(): View
    {
        $statusTypes = StatusType::orderBy('name')->pluck('name', 'id');

        return view('statuses.create', compact('statusTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:1'],
            'status_type_id' => ['required', 'exists:status_types,id'],
        ]);

        $status = Status::create($data);

        return redirect()->route('statuses.index')->with('status.id', $status->id);
    }

    public function show(Status $status): View
    {
        $status->load('type');

        return view('statuses.show', compact('status'));
    }

    public function edit(Status $status): View
    {
        $statusTypes = StatusType::orderBy('name')->pluck('name', 'id');

        return view('statuses.edit', compact('status', 'statusTypes'));
    }

    public function update(Request $request, Status $status): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:1'],
            'status_type_id' => ['required', 'exists:status_types,id'],
        ]);

        $status->update($data);

        return redirect()->route('statuses.index')->with('status.id', $status->id);
    }

    public function destroy(Status $status): RedirectResponse
    {
        $status->delete();

        return redirect()->route('statuses.index');
    }
}
