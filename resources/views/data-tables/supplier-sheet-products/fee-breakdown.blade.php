<table>
    <tbody>
    <tr>
        <td>{{ __('Fba Fees:') }}</td>
        <td>{{ format_amount($row->fba_fees ?? 0, 'USD') }}</td>
    </tr>
    <tr>
        <td>{{ __('Ref Fees:') }}</td>
        <td>{{ format_amount($row->referral_fee ?? 0, 'USD') }} ({{ format_percent($row->referral_fee_pct ?? 0, 100) }})</td>
    </tr>
    <tr>
        <td>{{ __('Storage Fees:') }}</td>
        <td>{{ format_amount($row->storage_fee ?? 0, 'USD') }}</td>
    </tr>
    <tr>
        <td>{{ __('Inbound Placement Fees:') }}</td>
        <td>{{ format_amount($row->inbound_placement_fee ?? 0, 'USD') }}</td>
    </tr>
    </tbody>
</table>
