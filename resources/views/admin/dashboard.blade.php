<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body">
                <h6>Total Claims</h6>
                <h3 class="text-primary">{{ $claims_total }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-left-warning">
            <div class="card-body">
                <h6>Pending</h6>
                <h3 class="text-warning">{{ $claims_pending }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-left-success">
            <div class="card-body">
                <h6>Approved</h6>
                <h3 class="text-success">{{ $claims_approved }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-left-danger">
            <div class="card-body">
                <h6>Rejected</h6>
                <h3 class="text-danger">{{ $claims_rejected }}</h3>
            </div>
        </div>
    </div>

</div>
