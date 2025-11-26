@extends('public.layouts.app')

@section('content')

<div class="container py-5">

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $form->title ?? $form->name }}</h4>
        </div>

        <div class="card-body">

            {{-- Progress Bar --}}
            <div class="progress mb-4">
                <div class="progress-bar bg-success" id="progressBar" 
                     style="width: 33%">
                    Step <span id="stepText">1</span> of 3
                </div>
            </div>

            {{-- MULTISTEP FORM --}}
            <form id="multiStepForm"
                  action="{{ route('public.form.submit',$form->slug) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- STEP 1 --}}
                <div class="step-page" id="step1">
                    <h5 class="mb-3">Step 1: Applicant Information</h5>

                    @foreach($fields->where('step_number',1) as $field)
                        @include('public.wizard_field')
                    @endforeach

                    <button type="button" class="btn btn-primary nextBtn float-end">
                        Next →
                    </button>

                    <div class="clearfix"></div>
                </div>

                {{-- STEP 2 --}}
                <div class="step-page d-none" id="step2">
                    <h5 class="mb-3">Step 2: Claim Details</h5>

                    @foreach($fields->where('step_number',2) as $field)
                        @include('public.wizard_field')
                    @endforeach

                    <button type="button" class="btn btn-secondary prevBtn">← Back</button>
                    <button type="button" class="btn btn-primary nextBtn float-end">Next →</button>
                    
                    <div class="clearfix"></div>
                </div>

                {{-- STEP 3 --}}
                <div class="step-page d-none" id="step3">
                    <h5 class="mb-3">Step 3: Upload Documents</h5>

                    @foreach($fields->where('step_number',3) as $field)
                        @include('public.wizard_field')
                    @endforeach

                    <button type="button" class="btn btn-secondary prevBtn">← Back</button>

                    <button class="btn btn-success float-end">
                        Submit Claim ✔
                    </button>

                    <div class="clearfix"></div>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- WIZARD SCRIPT --}}
<script>
let currentStep = 1;

function showStep(step) {
    document.querySelectorAll(".step-page").forEach(s => s.classList.add('d-none'));
    document.getElementById("step"+step).classList.remove('d-none');

    document.getElementById("progressBar").style.width = (step*33)+"%";
    document.getElementById("stepText").innerHTML = step;
}

document.querySelectorAll(".nextBtn").forEach(btn=>{
    btn.addEventListener("click", ()=> {
        currentStep++;
        showStep(currentStep);
    });
});

document.querySelectorAll(".prevBtn").forEach(btn=>{
    btn.addEventListener("click", ()=> {
        currentStep--;
        showStep(currentStep);
    });
});
</script>

@endsection
