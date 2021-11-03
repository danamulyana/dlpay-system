<table>
    <thead>
        <tr style="background-color: black; color: white;">
            <th>No</th>
            <th>Transaction ID</th>
            <th>Transfer Type</th>
            <th>Credited Account</th>
            <th>Receiver Name</th>
            <th>Amount</th>
            <th>NIP</th>
            <th>Remark</th>
            <th>Beneficiary</th>
            <th>email</th>
            <th>address</th>
            <th>Receiver Swift Code</th>
            <th>Receiver Cust Type</th>
            <th>Receiver Cust Residence</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $key => $invoice)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $invoice->Transaction_id }}</td>
                <td>BCA</td>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
	  			
