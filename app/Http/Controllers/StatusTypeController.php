<?php

namespace App\Http\Controllers;

use App\Models\StatusType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatusTypeController extends Controller
{
    public function index(): View
    {
        $statusTypes = StatusType::orderBy('id')->get();

        return view('status_types.index', compact('statusTypes'));
    }

    public function create(): View
    {
        return view('status_types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $statusType = StatusType::create($data);

        return redirect()->route('status-types.index')->with('status_type.id', $statusType->id);
    }

    public function show(StatusType $status_type): View
    {
        return view('status_types.show', ['statusType' => $status_type]);
    }

    public function edit(StatusType $status_type): View
    {
        return view('status_types.edit', ['statusType' => $status_type]);
    }

    public function update(Request $request, StatusType $status_type): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $status_type->update($data);

        return redirect()->route('status-types.index')->with('status_type.id', $status_type->id);
    }

    public function destroy(StatusType $status_type): RedirectResponse
    {
        $status_type->delete();

        return redirect()->route('status-types.index');
    }
}
