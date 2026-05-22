@props(['location', 'userAgent'])

<div class="data-table">
    <p class="data-table__title">{{ __('messages.ip.table.title') }}</p>
    <table>
        <tbody>
            <tr>
                <th>{{ __('messages.ip.table.ip') }}</th>
                <th>{{ $location->ip }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.ip_numeric') }}</th>
                <th>{{ $location->ipDecimal }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.country') }}</th>
                <th>{{ $location->country }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.longitude') }}</th>
                <th>{{ $location->longitude }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.latitude') }}</th>
                <th>{{ $location->latitude }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.asn') }}</th>
                <th>{{ $location->asn }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.asn_org') }}</th>
                <th>{{ $location->asn_org }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.hostname') }}</th>
                <th>{{ $location->hostname }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.user_agent') }}</th>
                <th>{{ $userAgent }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.user_agent_comment') }}</th>
                <th>{{ Str::before($userAgent, ' ') }}</th>
            </tr>
            <tr>
                <th>{{ __('messages.ip.table.user_agent_raw') }}</th>
                <th>{{ Str::after($userAgent, ' ') }}</th>
            </tr>
        </tbody>
    </table>
</div>