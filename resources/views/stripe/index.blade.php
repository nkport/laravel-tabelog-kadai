    <h1>Stripe Sales</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($charges as $charge)
                <tr>
                    <td>{{ $charge->id }}</td>
                    <td>{{ $charge->amount / 100 }} {{ strtoupper($charge->currency) }}</td>
                    <td>{{ ucfirst($charge->status) }}</td>
                    <td>{{ date('Y-m-d H:i:s', $charge->created) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
