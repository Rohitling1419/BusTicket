@extends('frontend.Master')
@section('content')

    <style>
        body {
            
            font-family: Arial, sans-serif;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            border-bottom: 2px solid #000;
            display: inline-block;
            margin-bottom: 20px;
        }
        .filter-btn {
            background-color: #e9ecef;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            margin-right: 10px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .filter-btn:hover, .filter-btn.active {
            background-color: #ced4da;
        }
        .bus-card {
            background-color: #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .journey-line {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 15px 0;
        }
        .dotted-line {
            flex-grow: 1;
            border-top: 2px dotted #000;
            margin: 0 15px;
            position: relative;
        }
        .journey-time {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #e9ecef;
            padding: 0 10px;
        }
        .view-seats-btn {
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
        }
        .section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .price-section {
            border-left: 2px solid #6c757d;
            padding-left: 20px;
        }
    </style>

    <div class="container py-4">
        
        
        <div class="row" style="margin-top: 3rem;">
            <div class="col-md-4">
                <div class="section-title">Starting to Destination</div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="From" aria-label="From">
                    <span class="input-group-text">to</span>
                    <input type="text" class="form-control" placeholder="To" aria-label="To">
                </div>
                
                <div class="section-title">Departure Time</div>
                <div>
                    <button class="filter-btn">Before 10 AM</button>
                    <button class="filter-btn">10 Am - 5 PM</button>
                    <button class="filter-btn">5 PM - 11 PM</button>
                </div>
                
                <div class="section-title">Bus Type</div>
                <div>
                    <button class="filter-btn">AC</button>
                    <button class="filter-btn">Non AC</button>
                    <button class="filter-btn">Sofa</button>
                </div>
            </div>
            
            <div class="col-md-8">
                <!-- Bus Card 1 -->
                <div class="bus-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Hero Bus</h5>
                            <p class="text-muted mb-2">Sofa Seater</p>
                            
                            <div class="journey-line">
                                <div>
                                    <div class="fw-bold">08:00 Am</div>
                                    <div>Kathmandu</div>
                                </div>
                                
                                <div class="dotted-line">
                                    <div class="journey-time">7 Hours</div>
                                </div>
                                
                                <div>
                                    <div class="fw-bold">03:00 Pm</div>
                                    <div>Pokhara</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 price-section">
                            <div>
                                <div>Per Seat</div>
                                <div class="fw-bold">NPR 1300</div>
                            </div>
                            
                            <div class="mt-3">
                                <div class="fw-bold">20 Seats Available</div>
                            </div>
                            
                            <div class="mt-3">
                                <button class="view-seats-btn">View Seats</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bus Card 2 -->
                <div class="bus-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Mountain Express</h5>
                            <p class="text-muted mb-2">Deluxe</p>
                            
                            <div class="journey-line">
                                <div>
                                    <div class="fw-bold">09:30 Am</div>
                                    <div>Kathmandu</div>
                                </div>
                                
                                <div class="dotted-line">
                                    <div class="journey-time">6.5 Hours</div>
                                </div>
                                
                                <div>
                                    <div class="fw-bold">04:00 Pm</div>
                                    <div>Pokhara</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 price-section">
                            <div>
                                <div>Per Seat</div>
                                <div class="fw-bold">NPR 1500</div>
                            </div>
                            
                            <div class="mt-3">
                                <div class="fw-bold">15 Seats Available</div>
                            </div>
                            
                            <div class="mt-3">
                                <button class="view-seats-btn">View Seats</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bus Card 3 -->
                <div class="bus-card">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>Tourist Special</h5>
                            <p class="text-muted mb-2">AC Tourist</p>
                            
                            <div class="journey-line">
                                <div>
                                    <div class="fw-bold">11:00 Am</div>
                                    <div>Kathmandu</div>
                                </div>
                                
                                <div class="dotted-line">
                                    <div class="journey-time">7 Hours</div>
                                </div>
                                
                                <div>
                                    <div class="fw-bold">06:00 Pm</div>
                                    <div>Pokhara</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 price-section">
                            <div>
                                <div>Per Seat</div>
                                <div class="fw-bold">NPR 1800</div>
                            </div>
                            
                            <div class="mt-3">
                                <div class="fw-bold">25 Seats Available</div>
                            </div>
                            
                            <div class="mt-3">
                                <button class="view-seats-btn">View Seats</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


@endsection