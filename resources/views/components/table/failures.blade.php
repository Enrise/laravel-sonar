@props(['failures'])

<table class="min-w-full divide-y divide-gray-300">

    <caption class="text-lg mb-2"><i class="em em-rotating_light" aria-role="presentation" aria-label="POLICE CARS REVOLVING LIGHT"></i> Failure Count</caption>
    <thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created at</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Ignored till</th>
        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
            <span class="sr-only">Options</span>
        </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
    @foreach($failures as $failure)
        <tr>


            <td class="whitespace-nowrap px-3 py-4 text-gray-800">{{ $failure['created_at'] }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-gray-800">{{ $failure['error_message'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

