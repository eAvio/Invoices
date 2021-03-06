<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{!! $invoice->name !!}</title>
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        div {
            font-family: DejaVu Sans;
            font-size: 10px;
            font-weight: normal;
        }

        h4 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        #services {
            margin: 0;
        }

        h2 {
            font-size: 16px;
            font-weight: bold;
            position: relative;
        }

        h5 {
            padding: 0;
            margin-bottom: 8px;
            opacity: 0.8;
        }

        th,
        td {
            font-family: DejaVu Sans;
            font-size: 10px;
        }

        .panel {
            margin-bottom: 0;
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .panel-default {
            border-color: #ddd;
        }

        .panel-body {
            padding: 15px;
        }

        table {
            width: 100%;
            max-width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;
        }

        thead {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        .well {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #f5f5f5;
            border: 1px solid #e3e3e3;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
        }

        .header {
            position: absolute;
            top: -50px;
            left: -45px;
            width: 820px;
            height: 150px;
        }

        .header-img {
            width: 100%;
            height: 100%;
        }

        .header-img {
            width: 100%;
            height: 100%;
        }

        .header4 {
            margin-top: 10px;
        }

        .footer {
            position: absolute;
            bottom: -45px;
            left: -45px;
            height: 100px;
            width: 820px;
            margin-top: 0;
        }

        .footer-img {
            width: 100%;
            height: 100%;
        }

        #vat {
            float: right;
            top: -15px;
            position: absolute;
            border: 1px solid lightgrey;
            padding: 5px;
            border-radius: 5px;
            opacity: 0.8;
            width: 125px;
            text-align: center;
        }

        #vat_number {
            position: absolute;
            right: 12px;
            /* left: 200px; */
            font-size: 8px;
            opacity: 0.8;
            padding: 5px;
            margin: 0;
        }

        #invoice-title {
            font-weight: normal;
        }
    </style>
    @if($invoice->duplicate_header)
    <style>
        @page {
            margin-top: 200px;
        }

        header {
            top: -150px;
            position: fixed;
        }
    </style>
    @endif
</head>

<body>
    <header>
        <div class="header"><img class="header-img" src="{{ $invoice->logo }}"></img></div>
    </header>
    <main>
        <div style="clear:both; position:relative;">
            <div style="position: relative; top: -30px; left:0pt; width:250pt;">
                <h4 class="header4">{{__('invoice.customer_details')}}</h4>
                <div class="panel panel-default">
                    <div id="customer-details" class="panel-body">
                        {!! $invoice->customer_details->count() == 0 ? '<i>No customer details</i><br />' : '' !!}
                        {!! nl2br(e($invoice->customer_details->get('address'))) !!}

                        @if($invoice->customer_details->get('vat_payer') == 1)
                        <p id="vat">{{__('invoice.is_taxable')}} <b>{{__('invoice.no')}}</b></p>
                        @elseif($invoice->customer_details->get('vat_payer') == 0)
                        <p id="vat">{{__('invoice.is_taxable')}} <b>{{__('invoice.yes')}}</b></p>
                        <p id="vat_number">{{__('invoice.tax_number')}} {{ $invoice->tax_number }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div style="text-align: right; margin-left: 300pt; right: 10px; position: absolute; top: 0px;">
                <b>{{__('invoice.date_issued')}} </b>{{ $invoice->date->isoFormat('DD.MM.YYYY') }}<br />
                @if ($invoice->due_date)
                <b>{{__('invoice.due_date')}} </b>{{ $invoice->due_date->isoFormat('DD.MM.YYYY') }}<br />
                @endif
                @if ($invoice->date_of_service)
                <b>{{__('invoice.date_of_service')}} </b>{{ $invoice->date_of_service->isoFormat('DD.MM.YYYY') }}<br />
                @endif
                <br />
            </div>
        </div>
        <h2 id="invoice-title">{!! $invoice->name !!}</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('invoice.item_name')}}</th>
                    <th>{{__('invoice.amount')}}</th>
                    <th>{{__('invoice.unit')}}</th>
                    <th>{{__('invoice.price')}}</th>
                    <th>{{__('invoice.discount')}}</th>
                    <th>{{__('invoice.vat')}}</th>
                    <th>{{__('invoice.total_with_vat')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->items as $key => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->get('name') }}</td>
                    <td>{{ $item->get('ammount') }}</td>
                    <td>{{ $item->get('unit') }}</td>
                    <td>{{ $invoice->priceFormatted($key) }} {{ $invoice->formatCurrency()->symbol }}</td>
                    <td>{{ $invoice->discountValue($key) }}%</td>
                    <td>{{ $item->get('vat') }}%</td>
                    <td>{{ $item->get('totalPrice') }} {{ $invoice->formatCurrency()->symbol }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="clear:both; position: relative; margin-bottom: 50px;">
            @if($invoice->notes)
            <div style="position:absolute; left:0pt; width:250pt; page-break-inside: avoid;">
                <h4>{{__('invoice.notes')}}</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! nl2br(e($invoice->notes)) !!}
                    </div>
                </div>
            </div>
            @endif
            <div style="margin-left: 300pt; page-break-inside: avoid;">
                <h4>{{__('invoice.total_table_title')}}</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><b>{{__('invoice.subtotal')}}</b></td>
                            <td>{{ $invoice->noVatPriceFormatted() }} {{ $invoice->formatCurrency()->symbol }}</td>
                        </tr>
                        @for($i = 0; $i < count($invoice->vats[0]); $i++)
                            <tr>
                                <td>
                                    <b>
                                        VAT {{ $i + 1 . ': ' . $invoice->getVat($i) }}%
                                    </b>
                                </td>
                                <td>
                                    {{ $invoice->getVatValue($i) }} {{ $invoice->formatCurrency()->symbol }}
                                </td>
                            </tr>
                            @endfor
                            <tr>
                                <td>
                                    <b>{{__('invoice.total')}}</b>
                                </td>
                                <td>
                                    <b>{{ $invoice->subTotalPriceFormatted() }} {{ $invoice->formatCurrency()->symbol }}</b>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @if ($invoice->footnote)
        <div class="well">
            {!! nl2br(e($invoice->footnote)) !!}
        </div>
        @endif

        @if ($invoice->footer_logo)
        <div class="footer"><img class='footer-img' src="{{ $invoice->footer_logo }}"></img></div>
        @endif

    </main>

    <!-- Page count -->
    <script type="text/php">
        if (isset($pdf) && $GLOBALS['with_pagination']) {
                $pageText = "{PAGE_NUM} of {PAGE_COUNT}";
                $pdf->page_text(($pdf->get_width()/2) - (strlen($pageText) / 2), $pdf->get_height()-20, $pageText, $fontMetrics->get_font("DejaVu Sans, Arial, Helvetica, sans-serif", "normal"), 7, array(0,0,0));
            }
        </script>
</body>

</html>