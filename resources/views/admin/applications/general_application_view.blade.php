@extends('layouts.app')

@section("page_title", "Application")

<?php
if (!isset(auth()->user()->id)) {
    $area  =  "application_area";
} else {
    $area   = "page_content";
}

?>

@section($area)
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


<div class="pt-1" style="width: 100%;">
    <div class="row mt-1">
        <div class="col-12">
            <!-- show print button here -->
            <div class="mt-3">
                <button  id="print_button" onclick="window.print()" class="btn btn-primary print-btn">
                    Print Application
                </button>
                @if(!isset(auth()->user()->id))

                <button id="download-application" class="btn btn-primary print-btn">
                    Download Application
                </button>

                @endif


            </div>

            <div id="pdf-progress-overlay" style="
                position: fixed;
                inset: 0;
                background: rgba(255,255,255,0.9);
                display: none;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                flex-direction: column;
                font-family: Arial, sans-serif;
                            ">
                <div style="width:300px;">
                    <p id="progress-text" style="text-align:center;margin-bottom:8px;">
                        Preparing PDF…
                    </p>
                    <div style="width:100%;height:8px;background:#ddd;border-radius:4px;">
                        <div id="progress-bar" style="
                height:100%;
                width:0%;
                background:#0d6efd;
                border-radius:4px;
                transition: width 0.2s;
            "></div>
                    </div>
                </div>
            </div>

            <style>
                @media print {
                    .print-btn {
                        display: none !important;
                    }
                }
            </style>

            @include("admin.applications.application_details", ["application_form" => $application_form])



        </div>
    </div>
</div>

<script>
    document.getElementById('download-application').addEventListener('click', function() {
        //hide the two buttons 

        document.getElementById('print_button').style.display = 'none';
        document.getElementById('download-application').style.display = 'none';
       

        const element = document.documentElement; // FULL PAGE (html tag)

        const options = {
            margin: 0,
            filename: '{{ $application_form->surname }}.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true,
                scrollY: 0
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().set(options).from(element).save();
        

        setTimeout(() => {
              document.getElementById('print_button').style.display = 'inline-block';
        document.getElementById('download-application').style.display = 'inline-block';
       
        }, 6000);

          
    });
</script>


@endsection