@extends('partials.dashboard.master')
@section('content')
    <div class="d-flex justify-content-center gap-2">
        <button type="submit" class="btn btn-primary " onclick="exportpdf()">
            <div class="d-flex">
                <span class="menu-icon">
                    <i class="fa fa-file"></i>
                </span>
                <span class="indicator-label">{{ __('PDF') }}</span>
            </div>


            <!-- begin :: Indicator -->
            <span class="indicator-progress">{{ __('Please wait ...') }}
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
            <!-- end   :: Indicator -->

        </button>
        <a href="{{ route('dashboard.finance-approvals.index') }}" class="btn btn-info" style="margin-left: 10px;">
            <div class="d-flex">

                <span class="indicator-label">{{ __('Finance approvals') }}</span>
            </div>


            <!-- begin :: Indicator -->
            <span class="indicator-progress">{{ __('Please wait ...') }}
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
            <!-- end   :: Indicator -->

        </a>
    </div>

    <div class="quotation-container">
        <div id="pdf_export">
            <div class="space">
                <div class="d-flex align-items-center mb-5" style="font-weight: bold;">
                    <img alt="Logo" src="{{ asset('dashboard-assets/media/logos/logo-2.svg') }}" class="h-30px"
                        dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}" />
                    <span style="border-left: 3px solid black; height: 30px; margin: 0 10px;"
                        dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}"></span>
                    <h1 dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">{{ __('Finance approvals Orders') }}</h1>
                </div>

                <div class="quotation-details d-flex" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                    <div class="col-6">
                        <p><strong>{{ __('Client name') }} : </strong>{{ $financeApproval->order->name }}</p>
                        <p><strong>{{ __('Client phone') }} : </strong>{{ $financeApproval->order->phone }}@if (app()->isLocale('ar'))
                                + &#x200F;
                            @else
                                + &#x200E;
                            @endif
                        </p>
                        <p><strong>{{ __('city') }} : </strong>{{ $financeApproval->order->city->name }}</p>

                        <p><strong>{{ __('Date') }} : </strong> {{ $financeApproval->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p><strong>{{ __('Car name') }} : </strong>{{ $financeApproval->order->car->name }}</p>
                        <p><strong>{{ __('Car color') }} : </strong>{{ $financeApproval->order->car->color->name }}</p>

                        <p><strong>{{ __('Order number') }} : </strong>{{ $financeApproval->id }}</p>
                        <p><strong>{{ __('Time') }}: </strong> {{ $financeApproval->created_at->format('H:i A') }} </p>
                    </div>


                </div>
                <hr>
                <table class="price-table" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                    <tr dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                        <th style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">#</th>
                        <th style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('Description') }}
                        </th>
                        <th style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('Value') }} </th>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">1</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('approval amount') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->approval_amount . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">2</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ __('tax discount') . ' ' . '(' . settings()->getSettings('maintenance_mode') == 1 ? settings()->getSettings('tax') : 0 . '%)' }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->tax_discount . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">3</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('plate no cost') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->plate_no_cost . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">4</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ __('discount amount') . ' ' . '(' . $financeApproval->discount_percent . '%)' }}</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->discount_amount . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">5</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('insurance cost') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->insurance_cost . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">6</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ __('cashback amount') . ' ' . '(' . $financeApproval->cashback_percent . '%)' }} </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->cashback_amount . ' ' . __('SAR') }}</td>
                    </tr>


                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">7</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('delivery cost') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->delivery_cost . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">8</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('Main car cost') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->Main_car_cost . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">9</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('commission') }}</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->commission . ' ' . __('SAR') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">10</td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">{{ __('extra details') }}
                        </td>
                        <td style="text-align: {{ app()->isLocale('ar') ? 'right' : 'left' }}">
                            {{ $financeApproval->extra_details ?? 0 . ' ' . __('SAR') }}</td>
                    </tr>
                    <!-- Add more rows for additional items -->
                </table>
                <div class="total" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                    <h3><strong>{{ __('Profit') . ' ' . ' : ' . ' ' }}</strong>{{ $financeApproval->profit ?? 0 . ' ' . __('SAR') }}
                    </h3>
                </div>
                <hr>
                <div class="quotation-details d-flex" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
                    <div class="col-6">
                        <p><strong>{{ __('Delegate') }} : </strong>{{ $financeApproval->delegate->name }}</p>
                        <p><strong>{{ __('Delegate phone') }} : </strong>{{ $financeApproval->delegate->phone }}
                            @if (app()->isLocale('ar'))
                                + &#x200F;
                            @else
                                + &#x200E;
                            @endif
                        </p>

                    </div>
                    <div class="col-6">
                        <p><strong>{{ __('Commission') }} : </strong>{{ $financeApproval->commission }}</p>
                        <p><strong>{{ __('Bank') }} : </strong>{{ $financeApproval->delegate->bank->name }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <style>
        .quotation-container {
            max-width: 650px;
            /* max-height: 600px; */
            margin: 10px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .space {
            width: 90%;
            margin: auto;
        }

        h1 {
            text-align: center !important;
            color: #000000;
        }

        p {
            color: #000000;
            font-size: 14px
        }

        .quotation-details {
            margin-bottom: 20px;
        }

        .price-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .price-table th,
        .price-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;

            /* Adjust text alignment for RTL */
        }

        .price-table th {}

        .total {
            text-align: left;
            /* Adjust text alignment for RTL */
        }



        /* Apply the font to the content element */
        #pdf_export {
            color: black;
            font-family: 'Cairo', sans-serif;

        }
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-alpha1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        let pdfexport = document.getElementById('pdf_export');

        function exportpdf() {
            document.fonts.ready.then(function() {
                domtoimage.toPng(pdfexport)
                    .then(function(dataUrl) {

                        var pdf = new window.jspdf.jsPDF('p', 'mm', 'a4');
                        // Calculate the center of the page


                        var contentWidth = 210; // Width of the content (A4 size: 210mm x 297mm)
                        var contentHeight = 297; // Height of the content (A4 size: 210mm x 297mm)

                        var xPos = 0;
                        var yPos = 0;

                        var fontUrl =
                            'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap';
                        var fontContentBase64 = "BASE64_CONTENT_OF_CAIRO_REGULAR_FONT";

                        pdf.addFileToVFS("Cairo-Regular.ttf", fontContentBase64);
                        pdf.addFont("Cairo-Regular.ttf", "Cairo", "normal");
                        pdf.setFont("Cairo");
                        // Add the image to the calculated position
                        pdf.addImage(dataUrl, 'PNG', xPos, yPos, contentWidth, contentHeight);

                        pdf.save('code-car.pdf');

                    }).then(function() {
                        setTimeout(() => {
                            successAlert(
                                `${
                                        __("File Downloaded") +
                                        " " +
                                        __("successfully !")
                                    } `
                            ).then(function() {});
                        }, 1000);

                    })
                    .catch(function(error) {
                        console.error('Error capturing screenshot:', error);
                    });
            });
        }
    </script>
    {{-- <script>
        document.fonts.ready.then(function() {
            html2canvas(pdfexport).then(function(canvas) {
                document.body.appendChild(canvas);
                // const imgData = canvas.toDataURL('image/webp');
                //     // console.log(imgData);
                //     // Create a PDF using jsPDF
                // const pdf = new window.jspdf.jsPDF({
                //     orientation: 'p', // 'p' for portrait, 'l' for landscape
                //     unit: 'mm',
                //     format: 'a4',
                // });
                // pdf.addImage(imgData, 'webp', 0, 0, pdf.internal.pageSize.width, pdf.internal.pageSize.height);

                //     // Save the PDF
                // pdf.save('codecar.pdf');
            });
        })
    </script> --}}
@endsection
