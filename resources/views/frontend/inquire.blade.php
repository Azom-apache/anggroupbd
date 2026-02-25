<x-frontend-layout title="Mission">
    <div class="sk__animated-header sk__header-y-m dark-shade-7-bg dark-shade-5-border sk__parallax-background-section sk__parallax-fixer-ignore-height"
        style="opacity: 1; transform: translate(0px, 0px);">
        <style>
            .header-section {
                background-color: #6b21a8;
                color: white;
                text-align: center;
                padding: 20px 0;
                font-size: 2rem;
                font-weight: bold;
            }

            .sk__header-y-m,
            .sk__header-t-m {
                padding-top: 100px !important;
            }
        </style>
        <div class="header-section">
            Capability
        </div>
    </div>
    <br>
    <div class="container mx-auto py-16 px-8">
        <div class="vc_col-sm-12 wpb_column vc_column_container">
            <div class="wpb_wrapper">

                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        {!! \App\Models\ConfigDictionary::get('inquire') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
