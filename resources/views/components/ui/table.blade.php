@props(['headers' => []])

<div class="w-full overflow-auto rounded-md border border-border bg-card">
    <table class="w-full caption-bottom text-sm">
        <thead class="[&_tr]:border-b">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                @foreach ($headers as $header)
                    <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="[&_tr:last-child]:border-0">
            {{ $slot }}
        </tbody>
    </table>
</div>
