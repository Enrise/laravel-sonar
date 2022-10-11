

<table class="min-w-full divide-y divide-gray-300">

    <caption class="text-lg mb-2"><i class="em em-rotating_light" aria-role="presentation" aria-label="POLICE CARS REVOLVING LIGHT"></i> Failure Count</caption>
    <thead class="bg-gray-50">
    <tr>
        <th><span class="sr-only">Status icon</span></th>
        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Transactions</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Failures</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ignored till</th>
        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
            <span class="sr-only">Options</span>
        </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
    @foreach($failures as $failure)
        <tr>
                <td class="pl-2">
                    @if($failure['status'] === 'failed')
                        <div class="w-3 h-3  "><span class="sr-only">This transaction has {{ $failure['status'] }}</span></div>
                    @elseif($failure['status'] === 'done')
                        <div class="w-3 h-3  "><span class="sr-only">This transaction is {{ $failure['status'] }}</span></div>
                    @elseif($failure['status'] === 'started')
                        <div class="w-3 h-3 "><span class="sr-only">This transaction has {{ $failure['status'] }}</span></div>
                    @endif
                </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-800 sm:pl-6">{{ $failure['name'] }}</td>

            <td class="whitespace-nowrap px-3 py-4 text-gray-800">
                @if($failure['failed'] > 0)
                    <i class="em em-fire" aria-role="presentation" aria-label="FIRE"></i> {{ $failure['failed'] }}
                @endif
            </td>

            <td class="whitespace-nowrap px-3 py-4 text-gray-800">{{ $failure['created_at'] }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"></td>

            <td x-data="{ menuOpen: false }" class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                <button x-on:click="menuOpen = !menuOpen">
                    <i class="bi bi-three-dots"></i><span class="sr-only">open menu</span>
                </button>
                <form x-show="menuOpen" class="absolute z-10 mt-1 right-0 shadow rounded bg-white p-3 flex flex-col">
                    <a href="url"><i class="em em-memo" aria-role="presentation" aria-label="MEMO"></i> Create ticket</a>
                    <a href="url"><i class="em em-female-firefighter" aria-role="presentation" aria-label=""></i> Resolve </a>
                    <a href="url"><i class="em em-see_no_evil" aria-role="presentation" aria-label="SEE-NO-EVIL MONKEY"></i> Ignore </a>

                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

