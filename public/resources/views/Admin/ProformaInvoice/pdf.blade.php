<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaInvoice->pi_number }}</title>
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
        
        

        .invoice-info {
            text-align: right;
        }

        .invoice-info h1 {
            font-size: 24px;
            color: #b89222;
            margin-bottom: 5px;
        }

        .invoice-info p {
            margin: 3px 0;
            font-size: 10px;
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

        /* Content */
        .content {
            margin-top: 10px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 5px;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
            font-size: 10px;
        }

        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .right-align {
            text-align: right;
            font-weight: bold;
        }

        .payment-terms,
        .signature {
            margin-top: 10px;
            font-size: 10px;
        }

        .payment-terms p {
            margin: 3px 0;
        }

        .signature img {
            height: 30px;
            width: auto;
        }

        .signature p {
            margin-top: 10px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Header Image">
        <div class="invoice-info">
            <h1>PROFORMA INVOICE</h1>
            <p>Number: {{ $piNumberFormatted }}</p>
            <p>Date: {{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('F d, Y') }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Vendor Information -->
        <p class="section-title">Billed To:</p>
        <p><strong>{{ $vendorName }}</strong></p>
        <p>{{ $vendorAddress }}</p>
        <p>Phone: {{ $vendorPhone }}</p>
        
        <p>Dear {{ $vendorName }},</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Simplay Abyakta Mediatek submits the following proforma invoice:</p>
        
        <!-- Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>{{ $product['qty'] }}</td>
                        <td>{{ $product['unit'] }}</td>
                        <td>{{ number_format($product['unit_price'], 2) }}</td>
                    </tr>
                @endforeach
                <!-- Summary Rows -->
                <tr>
                    <td colspan="4" class="right-align">Sub Total</td>
                    <td>{{ number_format($proformaInvoice->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">PPN</td>
                    <td>{{ number_format($proformaInvoice->ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">Grand Total Include PPN</td>
                    <td>{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align"><strong>Down Payment (DP)</strong></td>
                    <td>{{ number_format($dpPercent, 2) }}% - Rp {{ number_format($proformaInvoice->dp, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Terms -->
        <div class="payment-terms">
            <p class="section-title">Term Payment:</p>
            <p>Please make payments to:</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <p>Phone: (021) 22097542</p>
            <p>Mobile: +62 821-69998-0001</p>
            <p>Address: Rajawali Selatan Raya Blok A No.33, Gunung Sahari Utara, Sawah Besar, Jakarta Pusat, DKI Jakarta 10720</p>
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Should you require further information, please do not hesitate to contact the undersigned.</p>
            <p>Kind Regards,</p>
            <p><strong>PT. Simplay Abyakta Mediatek</strong></p>
            <br><br>
            <img src="signature.png" alt="Signature">
            <p><strong>PT. Simplay Abyakta Mediatek</strong><br>Director</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>PT. Simplay Abyakta Mediatek, Rajawali Selatan Raya Blok A No.33, Jakarta 10720</p>
        <p>Email: <a href="mailto:info@simplay.co.id">info@simplay.co.id</a>, Phone: (021) 22097542</p>
    </div>
</body>

</html>
