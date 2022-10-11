@props(['transactions'])

{{-- @dd($transactions) --}}

<table class="min-w-full divide-y divide-gray-300">
    <thead class="bg-gray-50">
        <tr>
            <th><span class="sr-only">Status icon</span></th>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Time</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Transaction</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                <span class="sr-only">Options</span>
            </th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach($transactions as $transaction)
        <tr>
            <td class="pl-2">
               @if($transaction['is_failed'])
                    <div class="w-3 h-3 rounded-full bg-red-500"><span class="sr-only">This transaction has failed</span></div>
               @elseif($transaction['finished'])
                    <div class="w-3 h-3 rounded-full bg-green-500"><span class="sr-only">This transaction is finished</span></div>
                @else
                    <div class="w-3 h-3 rounded-full bg-blue-500"><span class="sr-only">This transaction has started</span></div>
                @endif
            </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-800 sm:pl-6">{{ $transaction['started'] }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-gray-800">{{ $transaction['class'] }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                @if($transaction['is_failed'])
                    <x-sonar.badge.error text="failed" />
                @elseif($transaction['finished'])
                    <x-sonar.badge.success text="done" />
                @else
                    <x-sonar.badge.info text="started" />
                @endif
            </td>
            <td x-data="{ menuOpen: false }" class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                <button x-on:click="menuOpen = !menuOpen">
                    <i class="bi bi-three-dots"></i><span class="sr-only">open menu</span>
                </button>
                <div x-show="menuOpen" class="absolute z-10 w-48 -mt-1 right-0 shadow rounded bg-white flex flex-col text-lg overflow-hidden">
                    <form action="post" class="flex flex-col">
                        <button class="w-full py-2 px-3 text-left hover:bg-gray-100" type="submit" value="create-ticket"><span class="w-4 mr-2">✍️</span> Create ticket</button>
                        <button class="w-full py-2 px-3 text-left hover:bg-gray-100" type="submit" value="resolve"><span class="w-4 mr-2">🧑‍🚒</span> Resolve</button>
                        <button class="w-full py-2 px-3 text-left hover:bg-gray-100" type="submit" value="ignore"><span class="w-4 mr-2">🫣</span> Ignore</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
