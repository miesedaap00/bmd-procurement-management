<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 35px 40px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            color: #252525;
            line-height: 1.4;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        .header-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .header-left {
            width: 65%;
        }

        .header-right {
            width: 35%;
        }

        .recipient {
            margin-top: 12px;
        }

        .body-text {
            margin-top: 15px;
            margin-bottom: 12px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .product-table th {
            border: 1px solid #252525;
            padding: 6px 4px;
            text-align: center;
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .product-table td {
            border: 1px solid #252525;
            padding: 5px 4px;
            vertical-align: top;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .notes {
            margin-top: 12px;
            font-size: 9px;
        }

        .closing {
            margin-top: 25px;
        }

        .signature {
            margin-top: 35px;
        }

        .company {
            margin-top: 8px;
            font-weight: bold;
        }

        .signer {
            margin-top: 35px;
        }
    </style>
</head>

<body>

    <div class="title">
        PENAWARAN HARGA
    </div>

    <table class="header-table">

        <tr>
            <td class="header-left">
                <strong>Nomor:</strong>
                {{ $quotation->quotation_number }}
            </td>

            <td class="header-right">
                <strong>Tanggal:</strong>
                {{ $quotation->quotation_date->translatedFormat('d F Y') }}
            </td>
        </tr>

    </table>

    <div class="recipient">
        <div>Kepada Yth.</div>

        <div>
            <strong>{{ $quotation->client_name }}</strong>
        </div>

        <div>
            {{ $quotation->client_address }}
        </div>
    </div>

    <div class="body-text">
        Dengan hormat,
    </div>

    <div class="body-text">
        Bersama ini kami mengajukan penawaran harga untuk kebutuhan
        <strong>{{ $quotation->client_name }}</strong>
        sesuai spesifikasi berikut:
    </div>

    <div>
        <strong>Daftar Produk & Harga</strong>
    </div>

    <table class="product-table">

        <thead>

            <tr>

                <th width="5%">
                    NO
                </th>

                <th width="14%">
                    ITEM
                </th>

                <th width="22%">
                    SPECIFICATION
                </th>

                <th width="11%">
                    MERK
                </th>

                <th width="7%">
                    QTY
                </th>

                <th width="14%">
                    HARGA
                </th>

                <th width="14%">
                    TOTAL
                </th>

                <th width="13%">
                    NOTE
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach($quotation->items as $index => $item)

                <tr>

                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    <td>
                        {{ $item->item }}
                    </td>

                    <td>
                        {{ $item->specification ?? '-' }}
                    </td>

                    <td>
                        {{ $item->brand ?? '-' }}
                    </td>

                    <td class="center">
                        {{ number_format(
                            $item->quantity,
                            2,
                            ',',
                            '.'
                        ) }}
                    </td>

                    <td class="right">
                        {{ number_format(
                            $item->price,
                            2,
                            ',',
                            '.'
                        ) }}
                    </td>

                    <td class="right">
                        {{ number_format(
                            $item->total,
                            2,
                            ',',
                            '.'
                        ) }}
                    </td>

                    <td>
                        {{ $item->note ?? '-' }}
                    </td>

                </tr>

            @endforeach

            <tr>

                <td
                    colspan="6"
                    class="right"
                >
                    <strong>TOTAL</strong>
                </td>

                <td class="right">

                    <strong>
                        {{ number_format(
                            $quotation->items->sum('total'),
                            2,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </td>

                <td></td>

            </tr>

        </tbody>

    </table>

    <div class="notes">

        <div>
            *Harga di atas belum termasuk PPN 11%
        </div>

        <div>
            *Harga di atas merupakan harga satuan.
        </div>

        <div>
            *Harga berlaku hingga 30 hari sejak tanggal penawaran.
        </div>

        <div>
            *Waktu produksi dan pengiriman akan disesuaikan dengan kebutuhan
            {{ $quotation->client_name }}.
        </div>

        <div>
            *Pembayaran dilakukan sesuai ketentuan yang berlaku.
        </div>

    </div>

    <div class="closing">
        Demikian penawaran ini kami sampaikan.
    </div>

    <div class="closing">
        Atas perhatian dan kerja samanya kami ucapkan terima kasih.
    </div>

    <div class="signature">
        Hormat kami,
    </div>

    <div class="company">
        PT Bintang Mitra Digdaya
    </div>

    <div class="signer">
        Iksan Aditya Wahyu
    </div>

</body>

</html>