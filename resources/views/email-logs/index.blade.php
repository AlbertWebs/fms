@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold text-white">Email Logs</h1>
            <p class="mt-1 text-sm text-gray-300">Track all email activities and their status</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filters -->
        <div class="bg-white rounded-lg border border-indigo-200/50 shadow-sm p-4">
            <form method="GET" action="{{ route('admin.email-logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <x-text-input name="recipient_email" placeholder="Recipient Email" value="{{ request('recipient_email') }}" class="w-full" />
                </div>
                <div>
                    <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="sent" {{ request('status') === 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div>
                    <x-text-input name="mail_class" placeholder="Mail Class" value="{{ request('mail_class') }}" class="w-full" />
                </div>
                <div>
                    <x-text-input name="date_from" type="date" value="{{ request('date_from') }}" class="w-full" />
                </div>
                <div>
                    <x-text-input name="date_to" type="date" value="{{ request('date_to') }}" class="w-full" />
                </div>
                <div class="sm:col-span-2 lg:col-span-5">
                    <x-primary-button type="submit" class="w-full sm:w-auto">Filter</x-primary-button>
                    @if(request()->hasAny(['status', 'recipient_email', 'mail_class', 'date_from', 'date_to']))
                        <a href="{{ route('admin.email-logs.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mail Class</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sent At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($emailLogs as $log)
                            <tr class="hover:bg-indigo-50/30 transition-colors border-b border-gray-100/50 {{ $loop->even ? 'bg-gray-50/30' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->recipient_email }}</div>
                                    @if($log->recipient_name)
                                        <div class="text-xs text-gray-500">{{ $log->recipient_name }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->subject }}">{{ $log->subject }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-500">{{ class_basename($log->mail_class) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->status === 'sent')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700 border border-green-200">
                                            Sent
                                        </span>
                                    @elseif($log->status === 'failed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700 border border-red-200">
                                            Failed
                                        </span>
                                        @if($log->error_message)
                                            <div class="mt-1 text-xs text-red-600 max-w-xs truncate" title="{{ $log->error_message }}">
                                                {{ Str::limit($log->error_message, 50) }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 border border-yellow-200">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->sent_at)
                                        <div class="text-sm text-gray-900">{{ $log->sent_at->format('M d, Y H:i') }}</div>
                                    @else
                                        <div class="text-sm text-gray-400">-</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $log->created_at->format('M d, Y H:i') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No email logs found</h3>
                                    <p class="mt-1 text-sm text-gray-300">Email activities will appear here as emails are sent.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($emailLogs->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $emailLogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
