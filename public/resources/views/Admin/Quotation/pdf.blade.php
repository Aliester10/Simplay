<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quotation Letter #{{ $quotation->quotation_number }}</title>
    <style>
        @page {
            margin: 20px 50px;
            size: A4 portrait;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            /* Add padding to create space on both sides */
        }

        .header img {
            width: 250px;
            height: auto;
            margin-top: 10px;
        }

        .title {
            text-align: right;
            flex-grow: 1;
            margin-left: 20px;
        }

        .title h1 {
            margin: 0;
            font-size: 22px;
            color: #b59123;
        }

        .title p {
            margin: 3px 0;
            font-size: 12px;
        }


        /* Footer */
        .footer {
            position: fixed;
            bottom: 50px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
        }

        .footer p {
            margin: 5px 0;
        }

        /* Main Content */
        .content {
            padding: 0 50px;
        }

        .highlighted {
            color: #b59123;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .terms,
        .notes {
            font-size: 12px;
            margin-top: 20px;
        }

        .signature {
            margin-top: 30px;
            text-align: left;
            font-size: 14px;
        }

        .signature img {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Header Image">
        <div class="title">
            <h1>QUOTATION LETTER</h1>
            <p><strong>Number:</strong> {{ $quotation->quotation_number }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($quotation->quotation_date)->format('F d, Y') }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- To Section -->
        <p><strong>To:</strong> <span
                class="highlighted">{{ $quotation->user->nama_perusahaan ?? 'Company Name' }}</span></p>
        <p>Dear {{ $quotation->recipient_contact_person }},</p>
        <p>With reference to your letter number <span class="highlighted">{{ $referenceNumber }}</span>, PT. Simplay
            Abyakta Mediatek is pleased to submit our quotation with the following terms & conditions:</p>

        <!-- Equipment Details Table -->
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name of Equipment</th>
                    <th>Merk Type</th>
                    <th>QTY</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotation->quotationProducts as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->equipment_name ?? 'N/A' }}</td>
                        <td>{{ $product->merk_type ?? 'N/A' }}</td>
                        <td>{{ $product->quantity ?? 0 }}</td>
                        <td>{{ number_format($product->unit_price, 2) }}</td>
                        <td>{{ number_format($product->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Sub Total Price</td>
                    <td>{{ number_format($quotation->subtotal_price, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5">Discount ({{ $quotation->discount ?? 0 }}%)</td>
                    <td>-{{ number_format($quotation->subtotal_price * ($quotation->discount / 100), 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5">Sub Total II (After Discount)</td>
                    <td>{{ number_format($quotation->total_after_discount, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5">PPN ({{ $quotation->ppn ?? 10 }}%)</td>
                    <td>{{ number_format($quotation->total_after_discount * ($quotation->ppn / 100), 2) }}</td>
                </tr>
                <tr>
                    <td colspan="5"><strong>Grand Total Price</strong></td>
                    <td><strong>{{ number_format($quotation->grand_total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <!-- Notes Section -->
        <div class="notes">
            <h3>Notes:</h3>
            @php
                $notes = is_array($quotation->notes) ? $quotation->notes : explode("\n", $quotation->notes);
            @endphp
            @if (!empty($notes))
                <ol>
                    @foreach ($notes as $index => $note)
                        <li>{{ $note }}</li>
                    @endforeach
                </ol>
            @else
                <p>No additional notes.</p>
            @endif

            <!-- Terms & Conditions Section -->
            <h3>Terms & Conditions:</h3>
            @php
                $terms_conditions = is_array($quotation->terms_conditions) ? $quotation->terms_conditions : explode("\n", $quotation->terms_conditions);
            @endphp
            @if (!empty($terms_conditions))
                <ol>
                    @foreach ($terms_conditions as $index => $term)
                        <li>{{ $term }}</li>
                    @endforeach
                </ol>
            @else
                <p>No specific terms and conditions.</p>
            @endif
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Kind Regards,</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <p><img src="{{ public_path('pdfquo/signature.png') }}" alt="Signature" width="150"></p>
            <p><strong>{{ $quotation->authorized_person_name ?? 'Signer Name' }}</strong></p>
            <p>{{ $quotation->authorized_person_position ?? 'Position' }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>PT. Simplay Abyakta Mediatek, Rajawali Selatan Raya Blok A No.33, Jakarta 10720</p>
        <p>Email: <a href="mailto:info@simplay.co.id">info@simplay.co.id</a>, Phone: (021) 22097542</p>
    </div>
</body>

</html>